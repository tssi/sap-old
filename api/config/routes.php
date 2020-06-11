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
	Router::connect("/check",array("controller"=>'users',"action" => "check","[method]" => "POST"));
	Router::connect("/recovery_request",array("controller"=>'users',"action" => "recovery_request","[method]" => "POST"));
	Router::connect("/verify_request",array("controller"=>'users',"action" => "verify_request","[method]" => "POST"));	
	Router::connect("/email_registration",array("controller"=>'users',"action" => "email_registration","[method]" => "POST"));
	Router::connect("/verify_account",array("controller"=>'users',"action" => "verify_account","[method]" => "POST"));
	Router::connect("/email",array("controller"=>'users',"action" => "email","[method]" => "GET"));
	Router::connect("/test_email",array("controller"=>'users',"action" => "test_email","[method]" => "GET"));
	
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	App::import('Lib', 'Api.SlugRoute');
	//Custom API Routing
	Configure::write('Api.MASTER_ROUTES','educ_levels|system_defaults|modules');
	App::import('Vendor', 'Api.routes');

