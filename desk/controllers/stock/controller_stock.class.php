<?php

class stock extends controller {

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
        $this->view->render('stock/stock', true, true, $this->module);
    }

    function item() {
        $login_model = $this->loadModel('grn');
        $this->view->users = $login_model->getUsers();
        $this->view->render('stock/item', true, true, $this->module);
    }

}

?>