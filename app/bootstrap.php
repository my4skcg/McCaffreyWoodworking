<?php

// Require Composer Autoloader
require_once SITEPATH . 'vendor/autoload.php';

// Setup Logger
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('mww');
$log->pushHandler(new StreamHandler(SITEPATH.'logs/mww.log'));

// add records to the log
$log->addWarning('Foo');
$log->addError('Bar');

// Create new Silex App
$app = new Silex\Application();

// App Configuration
$app['debug'] = true;

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => SITEPATH.'/logs/monolog.log',
));
//$app['monolog']->addDebug('Testing the Monolog logging.');

/*
// Use Twig — @note: Be sure to install Twig via Composer first!
$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => SITEPATH . 'app/views'
));

// Use Doctrine — @note: Be sure to install Doctrine via Composer first!
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
	'db.options' => array(
	'dbname'     => 'McCaffreyWoodworking'
	,	'user'     => 'mwwadmin'
	,	'password' => 'mwwadmin'
	)
));
*/