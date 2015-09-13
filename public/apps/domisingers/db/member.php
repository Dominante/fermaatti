<?php
namespace OCA\DomiSingers\Db;

use OCP\AppFramework\Db\Entity;


class Member extends Entity {

    protected $personId;
    protected $etunimi;
    protected $sukunimi;
    protected $sukunimi2;
    protected $sukunimi3;
    protected $lempinimi;
    protected $puhelin1;
    protected $puhelin2;
    protected $katuosoite;
    protected $postinumero;
    protected $kunta;
    protected $email;
    protected $stemma;
    protected $liittynyt;
    protected $lopettanut;
    protected $taukoja;
    protected $tietosuoja;
    
    public function __construct() {
        $this->addType('personId', 'integer');
        $this->addType('stemma', 'integer');
        $this->addType('taukoja', 'integer');
        $this->addType('tietosuoja', 'integer');
    }
    
    /**
     * Set the fields of this entity equal to the modified one 
     * and mark them updated accordingly
     */
    public function updateFields($modifiedMember) {
        foreach($get_object_vars($this) as $attr => $val) {
            if ($this->$attr != $modifiedMember->$attr) {
                $this->setter($attr, [$val]);
            }
        }
    }
}