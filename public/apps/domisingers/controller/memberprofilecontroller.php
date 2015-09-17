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

namespace OCA\DomiSingers\Controller;

use OCP\IRequest;

use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

use OCA\DomiSingers\Db\MemberProfileService;

class MemberProfileController extends Controller {


	private $userId;
	private $service;

	public function __construct($AppName, IRequest $request, MemberProfileService $service, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->service = $service;
	}

	
	/**
     * @NoAdminRequired
     *
     * @param int $id
     */
	public function show($id) {
        return new DataResponse($this->service->find($id));
	}
	
	/**
     * @NoAdminRequired
     *
     * @param string $etunimi
     * @param string $sukunimi
     * @param int $stemma
     * @param string $liittynyt
     */
	public function create($etunimi, $sukunimi, $stemma, $liittynyt) {
        return new DataResponse($this->service->create($etunimi, $sukunimi, $stemma, $liittynyt));
    }
	
    /**
     * @NoAdminRequired
     *
     * @param $profile
     */
	
	public function update($profile) {
        return new DataResponse($this->service->update($profile));
    }
    
    /**
     * @NoAdminRequired
     *
     * @param int $id
     */
	public function delete($id) {
        return new DataResponse($this->service->delete($id));
	}
    
    
    /**
     * @NoAdminRequired
     *
     */
    
    public function listExistingResponsibilities() {
        return new DataResponse($this->service->listExistingResponsibilities());
    }
    

}