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
		$emailChanged = array_key_exists('email', $member->getUpdatedFields());
		$sql = $this->memberMapper->update($member);
		
		if ($emailChanged) {
			// Disable email notifications for now
			//$this->notifyEmailChanged($member);
		}
		
		$responsibilities = $originalProfile->responsibilities;
		$modifiedResponsibilities = $modifiedProfile->responsibilities;
		
		// A compare function for array_udiff, must return negative, 0, or positive
		$compareFunc = function($resp1, $resp2) {
			$kausiComp = $resp1->getKausi() - $resp2->getKausi();
			if ($kausiComp != 0) return $kausiComp;
			return $resp1->getViskaaliusId() - $resp2->getViskaaliusId();
		};
		
		$newResps = array_udiff($modifiedResponsibilities, $responsibilities, $compareFunc);
		$deletedResps = array_udiff($responsibilities, $modifiedResponsibilities, $compareFunc);
		array_map(array($this->responsibilityMapper, 'insert'), $newResps);
		array_map(array($this->responsibilityMapper, 'delete'), $deletedResps);
		
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
		foreach($responsibilities as $resp) {
			$this->responsibilityMapper->delete($resp);
		}
	}
	
	protected function notifyEmailChanged($member) {
		$etunimi = $member->getEtunimi();
		$sukunimi = $member->getSukunimi();
		$email = $member->getEmail();
		

		$body ="Hyvä Dominanten sihteeri,

Tämä on automaattisesti generoitu ilmoitus.
Dominanten jäsen

$etunimi $sukunimi

vaihtoi omaksi sähköpostiosoitteekseen: 

$email

terveisin,
Dominanten jäsensivut";
		
		$mailer = \OC::$server->getMailer();
		$message = $mailer->createMessage();
		$message->setSubject("Käyttäjän sähköpostiosoite muuttui Dominanten Jäsensivuilla");
		$message->setFrom(array("dominante@dominante.fi" => 'Dominanten jäsensivut'));
		$message->setTo(array("dominante-siht@dominante.fi" => 'Dominanten sihteeri'));
		$message->setPlainBody($body);
		$mailer->send($message);
	}
}

