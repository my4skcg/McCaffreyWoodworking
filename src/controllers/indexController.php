<?php

namespace Controllers;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class indexController implements ControllerProviderInterface {

	function __construct() {
	}

	public function connect(Application $app) {

var_dump('In indexController connect');
		//@note $app['controllers_factory'] is a factory that returns a new instance of ControllerCollection when used.
		//@see http://silex.sensiolabs.org/doc/organizing_controllers.html
		$controllers = $app['controllers_factory'];

		// Bind sub-routes
		$controllers->get('/', array($this, 'home'));

		return $controllers;

	}

	public function home(Application $app) {
	var_dump('In indexController home');
		//$output = '<p> McCaffrey Woodworking Home page!</p>';
		$output = file_get_contents(SITEPATH."web/home.php");
		return $output;
	}

}