<?php
namespace OCA\DomiSingers\Db;

use OCP\AppFramework\Db\Entity;

class Responsibility extends Entity {

    protected $viskaalitId = null;
    protected $personId;
    protected $viskaaliusId;
    protected $kausi;
    
    public function __construct() {
        $this->addType('viskaalitId', 'integer');
        $this->addType('personId', 'integer');
        $this->addType('viskaaliusId', 'integer');
    }
    
    public function isEqual($other) {
        return $this->personId == $other->personId &&
            $this->viskaalius == $other->viskaaliusId &&
            $this->kausi == $other->kausi;
    }
}