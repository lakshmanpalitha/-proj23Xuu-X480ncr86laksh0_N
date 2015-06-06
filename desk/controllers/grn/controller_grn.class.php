<?php

class grn extends controller {

    function __construct($module) {
        auth::handleLogin();
        parent::__construct($module);
    }

    /**
     * Display the company dashbord sccreen
     */
    function index() {
        $login_model = $this->loadModel('grn');
        $this->view->users = $login_model->getUsers();
        $this->view->render('grn/grn', true, true, $this->module);
    }

    function newGrn() {
        $login_model = $this->loadModel('grn');
        $this->view->users = $login_model->getUsers();
        $this->view->render('grn/add_grn', true, true, $this->module);
    }

}

?>