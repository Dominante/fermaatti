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

use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;

use OCA\DomiSingers\Db\MemberSummaryMapper;

class MemberlistController extends Controller {


	private $userId;
	private $mapper;

	public function __construct($AppName, IRequest $request, MemberSummaryMapper $mapper, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->mapper = $mapper;
	}

	public function listall() {
            return new DataResponse($this->mapper->findAll());
	}


}