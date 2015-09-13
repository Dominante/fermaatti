<?php

namespace OCA\DomiSingers\Db;

use OCP\IDBConnection;
use OCP\AppFramework\Db\Mapper;

class MemberMapper extends Mapper {

    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'jasen');
    }

    public function findMember($personId) {
        $sql = 'SELECT * FROM jasen WHERE person_id = ' . $personId;
        return $this->findEntity($sql);
    }
}

