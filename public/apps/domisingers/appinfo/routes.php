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

/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\DomiSingers\Controller\PageController->index()
 *
 */

return [
	'routes' => [
		['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
		['name' => 'page#profile', 'url' => '/profile/display/{id}', 'verb' => 'GET'],
		['name' => 'page#do_echo', 'url' => '/echo', 'verb' => 'POST'],
		['name' => 'memberlist#list_all', 'url' => '/list/all', 'verb' => 'GET'],
		['name' => 'memberprofile#show', 'url' => '/profile/show/{id}', 'verb' => 'GET'],
		['name' => 'memberprofile#update', 'url' => '/profile/update', 'verb' => 'POST'],
		['name' => 'memberprofile#create', 'url' => '/profile/create', 'verb' => 'POST'],
		['name' => 'memberprofile#delete', 'url' => '/profile/delete/{id}', 'verb' => 'DELETE'],
		['name' => 'memberprofile#listExistingResponsibilities', 'url' => '/profile/responsibilitychoices', 'verb' => 'GET'],
	]
];