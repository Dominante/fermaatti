<?php
/**
 * ownCloud - domisingers
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Atte Keinänen / Dominante <atte.keinanen@gmail.com>
 * @copyright Atte Keinänen / Dominante 2015
 */

namespace OCA\DomiSingers\Controller;

use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;


use OCA\DomiSingers\Db\MemberSummaryMapper;

class PageController extends Controller {


	private $userId;
	private $summaryMapper;

	public function __construct($AppName, IRequest $request, MemberSummaryMapper $mapper, $UserId){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->summaryMapper = $mapper;
	}

	/**
	 * CAUTION: the @Stuff turns off security checks; for this page no admin is
	 *          required and no CSRF check. If you don't know what CSRF is, read
	 *          it up in the docs or you might create a security hole. This is
	 *          basically the only required method to add this exemption, don't
	 *          add it to any other method if you don't exactly know what it does
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function index() {
                $members = $this->summaryMapper->findAll();
		$params = ['user' => $this->userId, 'members' => $members];
		return new TemplateResponse('domisingers', 'main', $params);  // templates/main.php
	}

	/**
	 * Simply method that posts back the payload of the request
	 * @NoAdminRequired
	 */
	public function doEcho($echo) {
		return new DataResponse(['echo' => $echo]);
	}


}