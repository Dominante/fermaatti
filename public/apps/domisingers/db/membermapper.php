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
use OCP\AppFramework\Db\Entity;
use OCP\AppFramework\Db\Mapper;

class MemberMapper extends Mapper {

    public function __construct(IDBConnection $db) {
        parent::__construct($db, '');
        $this->tableName = 'jasen';
    }

    public function findMember($personId) {
        $sql = 'SELECT * FROM ' . $this->tableName . ' WHERE person_id = ' . $personId;
        return $this->findEntity($sql);
    }
    
    public function update(Entity $entity){
		// if entity wasn't changed it makes no sense to run a db query
		$properties = $entity->getUpdatedFields();
		if(count($properties) === 0) {
			return $entity;
		}

		$assignments = [];
		$params = [];

		// build the fields
		foreach($properties as $property => $updated) {

			$column = $entity->propertyToColumn($property);
			$assignments[] = '`' . $column . '` = ?';
			$getter = 'get' . ucfirst($property);
			$params[] = $entity->$getter();
		}

		$sql = 'UPDATE ' . $this->tableName . ' SET ' .
				implode(', ', $assignments) . ' WHERE `person_id` = ?';
		$params[] = $entity->getPersonId();

		$stmt = $this->execute($sql, $params);
		$stmt->closeCursor();

		return $entity;
	}
	
    public function delete(Entity $entity) {
		$sql = 'DELETE FROM `' . $this->tableName . '` WHERE `person_id` = ?';
		$stmt = $this->execute($sql, [$entity->getPersonId()]);
		$stmt->closeCursor();
		return $entity;
	}
	
	public function insert(Entity $member) {
        // Find the next person_id in  the range < 9000
        $sql = 'SELECT max(person_id) as person_id FROM ' . $this->tableName .
            ' where person_id < 9000';
        $stmt = $this->execute($sql);
        $maxId = intval($stmt->fetch()['person_id']);
        
        $member->setPersonId($maxId + 1);
        return Mapper::insert($member);
    }
		
}

