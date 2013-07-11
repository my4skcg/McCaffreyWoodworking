<?php

// Bootstrap
require SITEPATH . '/app/bootstrap.php';

$app->error(function (\Exception $e, $code) {
	if ($code == 404) {
		return '404 - Not Found! // ' . $e->getMessage();
	} else {
		return 'Shenanigans! Something went horribly wrong // ' . $e->getMessage();
	}
});
// Catch faulty requests (think 404) - @see http://silex.sensiolabs.org/doc/usage.html#error-handlers
/*
$app->error(function (\Exception $e, $code) use ($app) {
	if ($code == 404) {
		return $app['twig']->render('errors/404.twig', array('error' => $e->getMessage()));
	} else {
		return 'Shenanigans! Something went horribly wrong // ' . $e->getMessage();
	}
});
*/

// Basic Routing
$home = $app->get('/', function(Silex\Application $app) {
	var_dump ('In app.php');
	//return 'McCaffrey Woodworking home page';
	return $app->redirect($app['request']->getBaseUrl() . '/index');
});

$app->mount('/index', new Controllers\indexController());

