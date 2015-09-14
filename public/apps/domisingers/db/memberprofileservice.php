<?php

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
    
    
    public function __construct(IDBConnection $db, MemberMapper $memberMapper, ResponsibilityMapper $responsibilityMapper) {
        $this->db = $db;
        $this->memberMapper = $memberMapper;        
        $this->responsibilityMapper = $responsibilityMapper;
    }

    public function show($personId) {
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
    
    protected function update($json) {
        $originalProfile = $this->findProfile($json['id']);
        $modifiedProfile = MemberProfile::fromJson($json, $this->getResponsibilityNames);
        
        $member = $originalProfile->member;
        $member->updateFields($modifiedProfile->member);
        $memberMapper->update($member);
        
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
                $this->responsibilityMapper->remove(old);
            }
        }
    }
    
    protected function create($json) {
        $profile = MemberProfile::fromJson($json, $this->getResponsibilityNames);
        $this->memberMapper->insert($profile->member);
        foreach ($profile->responsibilities as $r) {
            $this->responsibilityMapper->insert($r);
        }
    }
    
    protected function delete($personId) {
        $member = $memberMapper->findMember($personId);
        $memberMapper->delete($member);
        
        $responsibilities = $responsibilities->findResponsibilities($personId);
        foreach($responsibilities as $r) {
            $responsibilityMapper->delete($r);
        }
    }
}

