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
use OCP\IGroupManager;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Controller;
use OCA\DomiSingers\Db\MemberMapper;


class PageController extends Controller {


	private $userId;
	private $isAdmin;
	private $membermapper;

	public function __construct($appName, IRequest $request, IGroupManager $groupManager, MemberMapper $membermapper, $userId) {
		parent::__construct($appName, $request);
		$this->userId = $userId;
		$this->isAdmin = $groupManager->isAdmin($userId);
		$this->membermapper = $membermapper;
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
		$params = ['user' => $this->userId, 'isAdmin' => $this->isAdmin];
		return new TemplateResponse($this->appName, 'main', $params);  // templates/main.php
	}

	/**
	 * Show the profile page for a member
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
     * @param int $id
	 */
	public function profile($id) {
		$member = $this->membermapper->findMember($id);
		$isCurrentUser = $member->getOcUid() == $this->userId;

		$isPrivilegedToEdit = $this->isAdmin || $isCurrentUser;
		$params = ['user' => $this->userId, 'isAdmin' => $this->isAdmin, 'isPrivilegedToEdit' => $isPrivilegedToEdit];
		return new TemplateResponse($this->appName, 'profile', $params);
	}

	/**
	 * Simply method that posts back the payload of the request
	 * @NoAdminRequired
	 */
	public function doEcho($echo) {
		return new DataResponse(['echo' => $echo]);
	}
}
