<?php

namespace Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class indexController implements ControllerProviderInterface {

	function __construct() {
	}

	public function connect(Application $app) {

		//@note $app['controllers_factory'] is a factory that returns a new instance of ControllerCollection when used.
		//@see http://silex.sensiolabs.org/doc/organizing_controllers.html
		$controllers = $app['controllers_factory'];

		// Bind sub-routes
		$controllers->get('/', array($this, 'home'));

		return $controllers;

	}

	public function home(Application $app) {
		//$output = '<p> McCaffrey Woodworking Home page!</p>';
		//$output = file_get_contents(SITEPATH."web/home.php");
		//return $output;
		return $app->redirect($app['request']->getBaseUrl() . '/home.php');
		//return $app['twig']->render(SITEPATH.'web/home.php');
	}

}