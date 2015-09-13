<?php

namespace OCA\DomiSingers\Db;

use OCP\IDBConnection;
use OCP\AppFramework\Db\Mapper;

class ResponsibilityMapper extends Mapper {

    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'jasen');
    }

    public function findResponsibilities($personId=null) {
        $sql = 'SELECT * FROM viskaaliudet';
        if ($personId != null) {
            $sql .= ' WHERE person_id = ' . $personId;
        }
        return $this->findEntities($sql);
    }
}

