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

use OCA\DomiSingers\Db\MemberProfileHandler;

class MemberProfileController extends Controller {


	private $userId;
	private $handler;

	public function __construct($AppName, IRequest $request, MemberProfileHandler $handler, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->handler = $handler;
	}

	public function show($id) {
            return new DataResponse($this->handler->show($id));
	}


}