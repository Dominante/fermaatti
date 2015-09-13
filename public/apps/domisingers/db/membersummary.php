<?php
namespace OCA\Domisingers\Db;

use OCP\AppFramework\Db\Entity;

use JsonSerializable;

class MemberSummary extends Entity implements JsonSerializable {

    protected $personId;
    protected $etunimi;
    protected $sukunimi;
    protected $puhelin1;
    protected $email;
    protected $stemma;
    protected $lopettanut;
    
    protected $vastuut = [];

    public function __construct() {
        // add types in constructor
        $this->addType('personId', 'integer');
        $this->addType('stemma', 'integer');
    }
    
    public function jsonSerialize() {
        return [
            'personId' => $this->personId,
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