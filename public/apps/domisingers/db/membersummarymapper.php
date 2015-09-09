<?php

namespace OCA\Domisingers\Db;

use OCP\IDBConnection;
use OCP\AppFramework\Db\Mapper;

use ArrayIterator;

class MemberSummaryMapper extends Mapper {

    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'jasen');
    }


    public function findAll($limit=null, $offset=null) {
        $columns = ['person_id', 'etunimi', 'sukunimi', 'puhelin1', 'email', 'stemma', 'lopettanut'];
        $sql = 'SELECT '.implode(',', $columns).' FROM `jasen` ORDER BY person_id';
        $entities = $this->findEntities($sql);
        
        $sql = 'SELECT person_id, viskaalius 
            FROM `viskaaliudet` 
            LEFT JOIN viskaalius 
            ON viskaaliudet.viskaalius_id = viskaalius.viskaalius_id
            WHERE kausi='.date('Y').'
            GROUP BY person_id';
        $stmt = $this->execute($sql);
        
        $row = $stmt->fetch();
        $personId = intval($row['person_id']);
        foreach ($entities as $member) {
            while ($row && ($member->personId >= $personId)) {
                if ($member->personId == $personId) {
                    $member->vastuut[] = $row['viskaalius'];
                }
                $row = $stmt->fetch();
                $personId = intval($row['person_id']);
            }
        }
        return $entities;
    }
}

