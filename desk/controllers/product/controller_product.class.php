<?php

class product extends controller {

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
        $this->view->render('product/product', true, true, $this->module);
    }

    function newProduct() {
        $login_model = $this->loadModel('grn');
        $this->view->users = $login_model->getUsers();
        $this->view->render('product/add_product', true, true, $this->module);
    }

}

?>