<?php
/**
 * Services Controller.  Contains all Chapter 7 examples.
 *
 * @author <Your Name Here>, <Your Email Address>
 * @package Beginning_Zend_Framework
 */
class ServicesController extends Zend_Controller_Action
{

   public function indexAction(){}

   /**
    * Display all the artists in the system.
    */
   public function getartistsAction()
    {
        try
        {
	        require_once "services/WebServices.php";
            $server = new Zend_Rest_Server();
            $server->setClass('WebServices');
            $server->handle(array('method' => 'getArtists'));
        }
        catch (Exception $e)
        {
	        print_r($e->getMessage());
	        exit;
        }
	    //Suppress the view
	    $this->_helper->viewRenderer->setNoRender();
     }
}
