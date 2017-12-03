<?php
// bootstrap.php
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
define('ROOTPATH', str_replace('config'.DIRECTORY_SEPARATOR.SELF, '', __FILE__));
define('DATADIR', ROOTPATH."data".DIRECTORY_SEPARATOR);

require_once ROOTPATH."vendor/autoload.php";
