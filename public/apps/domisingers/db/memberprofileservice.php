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

use OCA\DomiSingers\Db\MemberMapper;
use OCA\DomiSingers\Db\ResponsibilityMapper;
use OCA\DomiSingers\Db\MemberProfile;

class MemberProfileService {

    protected $db;
    protected $memberMapper;
    protected $responsibilityMapper;
    
    
    public function __construct(IDBConnection $db, \OCP\ILogger $logger, MemberMapper $memberMapper, ResponsibilityMapper $responsibilityMapper) {
        $this->db = $db;
        $this->memberMapper = $memberMapper;        
        $this->responsibilityMapper = $responsibilityMapper;
        $this->logger = $logger;
    }

    public function find($personId) {
        $member = $this->memberMapper->findMember($personId);
        $responsibilities = $this->responsibilityMapper->findResponsibilities($personId);
        $responsibilityNames = $this->getResponsibilityNames();
        return new MemberProfile($member, $responsibilities, $responsibilityNames);
    }
    
    protected function getResponsibilityNames() {
        $sql = 'SELECT * FROM viskaalius';
        $query = $this->db->prepare($sql);
        $query->execute();
        $result = [];
        while ($row = $query->fetch()) {
            $result[$row['viskaalius_id']] = $row['viskaalius'];
        }
        $query->closeCursor();
        return $result;
    }
    
    public function listExistingResponsibilities() {
        return array_values($this->getResponsibilityNames());
    }
    
    public function update($data) {
        $personId = intval($data['personId']);
        $originalProfile = $this->find($personId);
        $modifiedProfile = MemberProfile::fromJson($data, $this->getResponsibilityNames());
        
        $member = $originalProfile->member;
        $member->updateFields($modifiedProfile->member);
        $sql = $this->memberMapper->update($member);
        
        $responsibilities = $originalProfile->responsibilities;
        $modifiedResponsibilities = $modifiedProfile->responsibilities;
        foreach($modifiedResponsibilities as $modified) {
            $new = true;
            foreach($responsibilities as $old) {
                if ($old->isEqual($modified)) {
                    $new = false;
                    break;
                }
            }
            if ($new) {
                $this->responsibilityMapper->insert($modified);
            }
        }
        foreach($responsibilities as $old) {
            $removed = true;
            foreach($modifiedResponsibilities as $modified) {
                if ($old->isEqual($modified)) {
                    $removed = false;
                    break;
                }
            }
            if ($removed) {
                $this->responsibilityMapper->delete($old);
            }
        }
        return $modifiedProfile;
    }
    
    public function create($etunimi, $sukunimi, $stemma, $liittynyt) {
        $member = new Member();
        $member->setEtunimi($etunimi);
        $member->setSukunimi($sukunimi);
        $member->setStemma($stemma);
        $member->setLiittynyt($liittynyt);
        $this->memberMapper->insert($member);
        
        $profile = new MemberProfile($member, [], []);
        return $profile;
    }
    
    public function delete($personId) {
        $member = $this->memberMapper->findMember($personId);
        $this->memberMapper->delete($member);
        
        $responsibilities = $this->responsibilityMapper->findResponsibilities($personId);
        foreach($responsibilities as $r) {
            $this->responsibilityMapper->delete($r);
        }
    }
}

