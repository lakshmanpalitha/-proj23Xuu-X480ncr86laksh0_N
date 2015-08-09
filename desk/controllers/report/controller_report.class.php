<?php

class report extends controller {

    function __construct($module) {
        auth::handleLogin();
        parent::__construct($module);
    }

    /**
     * Display the company dashbord sccreen
     */
    function stock() {
        $login_model = $this->loadModel('report');
        $items = $login_model->itemStockCount();
        $this->view->items = $items;
        $this->view->render('report/stock', true, true, $this->module);
    }

}

?>