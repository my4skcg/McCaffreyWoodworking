<?php

define('SITEPATH', realpath(dirname(__FILE__) . '/..') . '/');

// Require the app and run it
//require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'app.php';
require_once  SITEPATH . 'app' . DIRECTORY_SEPARATOR . 'app.php';
$app->run();

