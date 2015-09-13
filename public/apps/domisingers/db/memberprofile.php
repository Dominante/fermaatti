<?php
namespace OCA\DomiSingers\Db;

use OCP\AppFramework\Db\Entity;

use JsonSerializable;

class MemberProfile implements JsonSerializable {

    public $member;
    public $responsibilities = [];
    protected $responsibilityNames = [];
    protected $breaks = [];
    
    public function __construct($member, $responsibilities, $responsibilityNames) {
        $this->member = $member;
        $this->responsibilities = $responsibilities;
        $this->responsibilityNames = $responsibilityNames;
    }
    
    protected function getResponsibilityArray() {
        $arr = [];
        foreach($this->responsibilities as $r) {
            $responsibilityName = $this->responsibilityNames[$r->getViskaaliusId()];
            $arr[] = ['viskaalius' => $responsibilityName, 'kausi' => $r->getKausi()];
        }
        return $arr;
    }
    
    
    public function updateFromJson($json, $responsibilityNames) {
        $responsibilityKey = array_flip($responsibilityNames);
    
        $memberParams = [];
        foreach ($json as $k => $v) {
            if ($k != 'vastuut' && $k != 'vastuuNimet') {
                $memberParams[$k] = $v;
            }
        }
        $member = Member::fromParams(memberParams);
        
        $responsibilities = [];
        foreach ($json['vastuut'] as $responsibilityName => $kausi) {
            $respId = $responsibilityKey[$responsibilityName];
            $params = [
                'personId' => $json->$member->getPersonId(),
                'viskaaliusId' => $respId,
                'kausi' => $kausi
            ];                
            $responsibilities[] = Responsibility.fromParams($params);
        }
            
        return new static($member, $responsibilities, $responsibilityNames);
    }
    
    public function JsonSerialize() {
        return [
            'personId' => $this->member->getPersonId(),
            'etunimi' => $this->member->getEtunimi(),
            'sukunimi' => $this->member->getSukunimi(),
            'sukunimi2' => $this->member->getSukunimi2(),
            'sukunimi3' => $this->member->getSukunimi3(),
            'lempinimi' => $this->member->getLempinimi(),
            'puhelin1' => $this->member->getPuhelin1(),
            'puhelin2' => $this->member->getPuhelin2(),
            'katuosoite' => $this->member->getKatuosoite(),
            'postinumero' => $this->member->getPostinumero(),
            'kunta' => $this->member->getKunta(),
            'email' => $this->member->getEmail(),
            'stemma' => $this->member->getStemma(),
            'liittynyt' => $this->member->getLiittynyt(),
            'lopettanut' => $this->member->getLopettanut(),
            'taukoja' => $this->member->getTaukoja(),
            'tietosuoja' => $this->member->getTietosuoja(),
            'vastuut' => $this->getResponsibilityArray()
        ];
    }
    
}