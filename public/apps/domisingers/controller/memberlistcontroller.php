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

use OCA\DomiSingers\Db\MemberSummaryService;

class MemberlistController extends Controller {


	private $userId;
	private $service;

	public function __construct($AppName, IRequest $request, MemberSummaryService $service, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->service = $service;
	}

	public function listAll() {
            return new DataResponse($this->service->findAll());
	}


}