<?php
define('DEBUG',true);
$CONFIG = array (
  'instanceid' => 'ock4xi9fsk9t',
  'dbtype' => 'mysql',
  'dbhost' => 'localhost',
  'dbname' => 'skotchbox',
  'dbuser' => 'root',
  'dbpassword' => 'root',
  'passwordsalt' => '6blnPnnjeEBdwKhckX+nE+Lwr+onf3',
  'secret' => 'WGCzfQX0xPRTo0gfwqiqmFw44cPFU1iHisukMaYluJHTu3SD',
  'trusted_domains' => array(
    0 => 'fermaatti.dominante.fi'
  ),
  'datadirectory' => '/var/wwwhome/jasensivut-dev/data',
  'overwrite.cli.url' => 'http://fermaatti.dominante.fi/jasensivut-dev',
  'version' => '8.1.0.8',
  'dbtableprefix' => 'oc_',
  'logtimezone' => 'UTC',
  'installed' => true,
  'memcache.local' => '\\OC\\Memcache\\Redis',
  'loglevel' => 0,
  'default_language' => 'fi'
);
