<?php

class role extends controller {

    function __construct($module) {
        //auth::handleLogin();
        parent::__construct($module);
    }

    function index() {
        $login_model = $this->loadModel('role');
        $this->view->sys_doc_types = $login_model->getDocumentTypes();
        $this->view->render('role/role', true, true, $this->module);
    }

}

?>