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

namespace OCA\DomiSingers\Db;

use OCP\IDBConnection;
use OCP\AppFramework\Db\Mapper;
use OCP\AppFramework\Db\Entity;

class ResponsibilityMapper extends Mapper {

    public function __construct(IDBConnection $db) {
        parent::__construct($db, '');
        $this->tableName = 'viskaaliudet';
    }

    public function findResponsibilities($personId=null) {
        $sql = 'SELECT * FROM ' . $this->tableName;
        if ($personId != null) {
            $sql .= ' WHERE person_id = ' . $personId;
        }
        return $this->findEntities($sql);
    }
    
    public function delete(Entity $entity) {
		$sql = 'DELETE FROM `' . $this->tableName . '` WHERE `viskaalit_id` = ?';
		$stmt = $this->execute($sql, [$entity->getViskaalitId()]);
		$stmt->closeCursor();
		return $entity;
	}
}

