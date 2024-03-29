<?php

use Symfony\Component\Dotenv\Dotenv;

$dir = dirname(__DIR__, 1);
require_once $dir . '/vendor/autoload.php';
$dotenv = new Dotenv();
$dotenv->load($dir . '/.env');

session_start();