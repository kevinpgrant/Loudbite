<?php
/**
 * Index.php file.
 *
 */
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)).PATH_SEPARATOR.realpath(APPLICATION_PATH . '/models'));


/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);


/** Routing Info **/
$FrontController = Zend_Controller_Front::getInstance();

$plugin = new Zend_Controller_Plugin_ErrorHandler();
$plugin->setErrorHandler(array("controller" => 'ApplicationError',
"action" => 'index'));
$FrontController->registerPlugin($plugin);


$Router = $FrontController->getRouter();

$Router->addRoute("artiststore",
                  new Zend_Controller_Router_Route(
                      "artist/store",
                      array
                      ("controller" => "artist",
                       "action"     => "artistaffiliatecontent"
                      )));

$Router->addRoute("artistprofile",
			new Zend_Controller_Router_Route(
			"artist/profile/:artistname",
			array(
			// "artistname" => "The Smiths",
			"controller" => "artist",
			"action" => "profile")));

$Router->addRoute("artistlistall",
                  new Zend_Controller_Router_Route(
                      "artist/list-all-artists",
                      array
                      ("controller" => "artist",
                       "action"     => "list"
                      )));

$Router->addRoute("testclientws",
                  new Zend_Controller_Router_Route(
                      "test/clientws",
                      array
                      ("controller" => "testws",
                       "action"     => "clientws"
                      )));






try
{
    $application->bootstrap()
            ->run();
}
catch (Exception $e)
{
    echo '<pre style="border: 1px dashed silver;">';
    echo $e->getMessage() . '<br />';
    echo '</pre>';
}
