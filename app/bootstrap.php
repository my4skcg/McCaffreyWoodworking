<?php

// Require Composer Autoloader
require_once SITEPATH . 'vendor/autoload.php';

// Setup Logger
use Monolog\Logger;
use Silex\Application\MonologTrait;

// Create new Silex App
$app = new Silex\Application();

// App Configuration
$app['debug'] = true;

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => SITEPATH.'/logs/monolog.log',
    'monolog.level' => Logger::WARNING
));

$app['monolog']->addDebug('using addDebug to Testing the Monolog logging.');
$app['monolog']->addWarning('Foo');
$app['monolog']->addError('Bar');
//$app->log('using trait');

// Use Twig — @note: Be sure to install Twig via Composer first!
$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => SITEPATH . 'src/views'
));

// Use Doctrine — @note: Be sure to install Doctrine via Composer first!
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
	'db.options' => array(
	'dbname'     => 'McCaffreyWoodworking'
	,	'user'     => 'mwwadmin'
	,	'password' => 'mwwadmin'
	)
));
