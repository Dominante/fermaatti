<?php
/**
 * 2012 Frank Karlitschek frank@owncloud.org
 * This file is licensed under the Affero General Public License version 3 or later.
 * See the COPYING-README file.
 */
OCP\JSON::checkAppEnabled('domisingers');
OCP\User::checkAdminUser();
OCP\JSON::callCheck();

OCP\Config::setAppValue('domisingers', 'json_path', $_POST['pathToDomiSingersJson']);
OC_JSON::success(array("data" => array( "message" => "Polku tallennettu.")));