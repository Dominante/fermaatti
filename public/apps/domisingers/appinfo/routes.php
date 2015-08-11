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

/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\DomiSingers\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */

// NOTE: Atte Keinänen 9.8.15
// Quirky deprecated procedural copy-paste from External Sites module :D

/** @var $this \OCP\Route\IRouter */
$this->create('domisingers_ajax_setsites', 'ajax/setjsonpath.php')
  ->actionInclude('domisingers/ajax/setjsonpath.php');

return [
    'routes' => [
	   ['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
	   ['name' => 'page#do_echo', 'url' => '/echo', 'verb' => 'POST'],
     ['name' => 'page#do_echo', 'url' => '/echo', 'verb' => 'POST'],
    ]
];