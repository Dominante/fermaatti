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
  'trusted_domains' => 
  array (
    0 => '192.168.33.10',
    1 => 'fermaatti'
  ),
  'datadirectory' => '/var/www/data',
  'overwrite.cli.url' => 'http://192.168.33.10',
  'version' => '8.1.0.8',
  'dbtableprefix' => 'oc_',
  'logtimezone' => 'UTC',
  'installed' => true,
  'memcache.local' => '\\OC\\Memcache\\Redis',
  'default_language' => 'fi',
);
