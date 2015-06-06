<?php

class user extends controller {

    function __construct($module) {
        //auth::handleLogin();
        parent::__construct($module);
    }

    function index() {

        $this->view->render('user/user', true, true, $this->module);
    }

}

?>