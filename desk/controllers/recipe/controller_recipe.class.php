<?php

class recipe extends controller {

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
        $this->view->render('recipe/recipe', true, true, $this->module);
    }

    function newRecipe() {
        $login_model = $this->loadModel('grn');
        $this->view->users = $login_model->getUsers();
        $this->view->render('recipe/add_recipe', true, true, $this->module);
    }

}

?>