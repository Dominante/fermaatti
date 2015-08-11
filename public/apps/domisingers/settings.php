<?php

OCP\User::checkAdminUser();
OCP\JSON::checkAppEnabled('domisingers');
OCP\Util::addscript( "domisingers", "admin" );
$tmpl = new OCP\Template( 'domisingers', 'settings');
return $tmpl->fetchPage();