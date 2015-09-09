<?php
namespace OCA\Domisingers\Db;

use OCP\AppFramework\Db\Entity;

use JsonSerializable;

class MemberSummary extends Entity implements JsonSerializable {

    public $personId;
    public $etunimi;
    public $sukunimi;
    public $puhelin1;
    public $email;
    public $stemma;
    public $lopettanut;
    
    public $vastuut = [];

    public function __construct() {
        // add types in constructor
        $this->addType('personId', 'integer');
        $this->addType('stemma', 'integer');
    }
    
    public function jsonSerialize() {
        return [
            'id' => $this->personId,
            'etunimi' => $this->etunimi,
            'sukunimi' => $this->sukunimi,
            'puhelin' => $this->puhelin1,
            'email' => $this->email,
            'stemma' => $this->stemma,
            'lopettanut' => $this->lopettanut,
            'vastuut' => $this->vastuut
        ];
    }
}