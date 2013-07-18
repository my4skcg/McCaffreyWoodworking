<?php

// Bootstrap
require SITEPATH . '/app/bootstrap.php';

	/*
	$app->error(function (\Exception $e, $code) {
		if ($code == 404) {
			return '404 - Not Found! // ' . $e->getMessage();
		} else {
			return 'Shenanigans! Something went horribly wrong // ' . $e->getMessage();
		}
	});
	*/
	// Catch faulty requests (think 404) - @see http://silex.sensiolabs.org/doc/usage.html#error-handlers
	$app->error(function (\Exception $e, $code) use ($app) {
		if ($code == 404) {
			return $app['twig']->render('errors/404.twig', array('error' => $e->getMessage()));
		} else {
			return 'Shenanigans! Something went horribly wrong // ' . $e->getMessage();
		}
	});

// Define routes for our static pages
$pages = array(
	'/' => 'home',
	'/about' => 'about'
);
foreach ($pages as $route => $view) {
	$app->get($route, function () use ($app, $view) {
		return $app['twig']->render($view . '.twig');
	})->bind($view);
}

// Basic Routing
/*
$home = $app->get('/', function(Silex\Application $app) {
	//return 'McCaffrey Woodworking home page';
	return $app->redirect($app['request']->getBaseUrl() . '/index');
});

$app->mount('/index', new Controllers\indexController());
*/

// Use UrlGenerator Service Provider - @note: Be sure to install "symfony/twig-bridge" via Composer if you want to use the `url` & `path` functions in Twig
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

