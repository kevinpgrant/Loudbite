<?php

class ErrorController extends Zend_Controller_Action
{

    public function errorAction()
    {
        print_r(debug_backtrace());
    }

}

