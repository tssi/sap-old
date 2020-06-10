<?php
/**
 * Routes Configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	Router::connect(
		"/check",
		array("controller"=>'users',"action" => "check","[method]" => "GET")
	);
	Router::connect(
			"/send_verification",
			array("controller"=>'users',"action" => "send_verification","[method]" => "GET")
		);
	Router::connect(
			"/email",
			array("controller"=>'users',"action" => "email","[method]" => "GET")
		);
	Router::connect(
			"/verify_token",
			array("controller"=>'users',"action" => "verify_token","[method]" => "POST")
		);
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	App::import('Lib', 'Api.SlugRoute');
	//Custom API Routing
	Configure::write('Api.MASTER_ROUTES','educ_levels|system_defaults|modules');
	App::import('Vendor', 'Api.routes');

