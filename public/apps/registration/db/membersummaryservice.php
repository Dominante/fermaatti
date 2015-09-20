<?php
/**
 * ownCloud - domisingers
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Tuukka Verho / Dominante <tuukka.verho@aalto.fi>
 * @copyright Tuukka Verho / Dominante 2015
 */

namespace OCA\Registration\Db;

use OCP\IDBConnection;

class MemberSummaryService {
    protected $db;

    public function __construct(IDBConnection $db) {
        $this->db = $db;
    }


    public function findAll($limit=null, $offset=null) {
        $members = [];
        // Get list of members from the database
        $columns = ['person_id', 'etunimi', 'sukunimi', 'puhelin1', 'email', 'stemma', 'lopettanut'];
        $sql = 'SELECT '.implode(',', $columns).' FROM jasen';
        $query = $this->db->prepare($sql);
        $result = $query->execute();

        while($row = $query->fetch()) {
            $personId = intval($row['person_id']);
            $member = [];
            $member['personId'] = $personId;
            $member['etunimi'] = $row['etunimi'];
            $member['sukunimi'] = $row['sukunimi'];
            $member['puhelin'] = $row['puhelin1'];
            $member['email'] = $row['email'];
            $member['stemma'] = intval($row['stemma']);
            $member['lopettanut'] = $row['lopettanut'];
            $member['vastuut'] = [];
            $members[$personId] = $member;
        }

        // Get current responsibilities from the database
        $sql = 'SELECT person_id, viskaalius
            FROM viskaalius
            LEFT JOIN viskaaliudet
            ON viskaaliudet.viskaalius_id = viskaalius.viskaalius_id
            WHERE kausi='.date('Y');
        $query = $this->db->prepare($sql);
        $result = $query->execute();

        while($row = $query->fetch()) {
            $personId = intval($row['person_id']);
            $members[$personId]['vastuut'][] = $row['viskaalius'];
        }

        $query->closeCursor();
        return array_values($members);
    }
}

