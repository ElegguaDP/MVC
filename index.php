<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
require_once 'config.php';
require_once 'source/Site.php';
require_once 'source/Database.php';
require_once 'source/Route.php';
session_start();
Route::init();
