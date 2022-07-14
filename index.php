<?php
require_once __DIR__ . "/vendor/autoload.php";

use Core\Config\Config;
use Core\BuilderConstructor;

$config = Config::getConfig();
$exec = new BuilderConstructor($config);
