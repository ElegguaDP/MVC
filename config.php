<?php

/*
 * configuration file
 */
define('DIRSEP', DIRECTORY_SEPARATOR);

$path = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP;

define('PATH', $path);

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "developer");
define("DB_NAME", "adminpanel");
define("DB_CHARSET", "UTF8");

define("DEFAULT_CONTROLLER", 'User');
define("DEFAULT_ACTION", 'Index');
define("DEFAULT_TEMPLATE", 'main_template.php');
