<?php

class vendor extends controller {

    function __construct($module) {
        //auth::handleLogin();
        parent::__construct($module);
    }

    function index() {

        $this->view->render('vendor/vendor', true, true, $this->module);
    }

}

?>