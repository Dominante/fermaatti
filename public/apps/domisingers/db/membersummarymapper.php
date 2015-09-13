<?php

namespace OCA\Domisingers\Db;

use OCP\IDBConnection;
use OCP\AppFramework\Db\Mapper;

class MemberSummaryMapper extends Mapper {

    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'jasen');
    }


    public function findAll($limit=null, $offset=null) {
        // Get list of members from the database
        $columns = ['person_id', 'etunimi', 'sukunimi', 'puhelin1', 'email', 'stemma', 'lopettanut'];
        $sql = 'SELECT '.implode(',', $columns).' FROM `jasen` ORDER BY person_id';
        $entities = $this->findEntities($sql);
        
        // Get responsibilities from the database
        $sql = 'SELECT person_id, viskaalius 
            FROM viskaalius 
            LEFT JOIN viskaaliudet 
            ON viskaaliudet.viskaalius_id = viskaalius.viskaalius_id
            WHERE kausi='.date('Y').'
            ORDER BY person_id';
        $stmt = $this->execute($sql);
        
        // Add responsibilities to member objects
        $row = $stmt->fetch();
        $personId = intval($row['person_id']);
        foreach ($entities as $member) {
            while ($row && ($member->getPersonId() >= $personId)) {
                if ($member->getPersonId() == $personId) {
                    $member->getVastuut[] = $row['viskaalius'];
                }
                $row = $stmt->fetch();
                $personId = intval($row['person_id']);
            }
        }
        $stmt->closeCursor();
        return $entities;
    }
}

