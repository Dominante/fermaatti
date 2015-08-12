<?php
/* Ympäristömuuttujat tulevat Apachen configista
 * (/etc/apache2/sites-available/...)
 */
define('DEBUG',true);
$CONFIG = array (
  'instanceid' => 'ock4xi9fsk9t',
  'dbtype' => 'mysql',
  'dbhost' => 'localhost',
  'dbname' => getenv('DBNAME'),
  'dbuser' => getenv('DBUSER'),
  'dbpassword' => getenv('DBPASSWORD'),
  'passwordsalt' => '6blnPnnjeEBdwKhckX+nE+Lwr+onf3',
  'secret' => 'WGCzfQX0xPRTo0gfwqiqmFw44cPFU1iHisukMaYluJHTu3SD',
  'trusted_domains' => array(
    0 => 'fermaatti.dominante.fi'
  ),
  'datadirectory' => '/var/wwwhome/jasensivut-kehitys/data',
  'overwrite.cli.url' => 'http://fermaatti.dominante.fi/jasensivut-kehitys',
  'version' => '8.1.0.8',
  'dbtableprefix' => 'oc_',
  'logtimezone' => 'UTC',
  'installed' => true,
  //'memcache.local' => '\\OC\\Memcache\\Redis',
  'loglevel' => 0,
  'default_language' => 'fi_FI'
);
