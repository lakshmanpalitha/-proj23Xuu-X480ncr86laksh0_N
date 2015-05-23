<?php

class home extends controller {

    function __construct($module) {
        auth::handleLogin();
        parent::__construct($module);
    }

    /**
     * Display the company dashbord sccreen
     */
    function index() {
       
        $this->view->render('home/home', true, true, $this->module);
    }

}

?>