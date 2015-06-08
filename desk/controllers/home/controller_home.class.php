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
        $login_model = $this->loadModel('home');
        $login_model->selectUserModule();
        $this->view->render('home/home', true, true, $this->module);
    }

}

?>