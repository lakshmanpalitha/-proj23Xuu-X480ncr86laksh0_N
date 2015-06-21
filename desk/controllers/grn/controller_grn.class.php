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
        $this->view->grns = $login_model->getAllGrn();
        $this->view->render('grn/grn', true, true, $this->module);
    }

    function newGrn() {
        $login_model = $this->loadModel('grn');
        $login_model_item = $this->loadModel('item');
        $login_model_vendor = $this->loadModel('vendor');
        $this->view->items = $login_model_item->getAllActiveItem();
        $this->view->vendors = $login_model_vendor->getAllActiveVendors();
        $this->view->render('grn/add_grn', true, true, $this->module);
    }

    function addNewGrn() {

        $valid = true;
        $data = array();
        $grn = array();
        $login_model = $this->loadModel('grn');
        if (!$grn_inv_id = $this->read->get("grn_inv_id", "POST", 'NUMERIC', 50, false))
            $valid = false;
        if (!$grn_vendor = $this->read->get("grn_vendor", "POST", 'NUMERIC', 6, true))
            $valid = false;
        if (!$grn_inc_date = $this->read->get("grn_inv_date", "POST", '', '', true))
            $valid = false;
        if (!$grn_title = $this->read->get("grn_title", "POST", '', 250, true))
            $valid = false;
        if (!$grn_remark = $this->read->get("grn_remark", "POST", '', 1500, false))
            $valid = false;
        if (!$grn_items = $this->read->get("items", "POST", '', '', true))
            $valid = false;
        $item_array = (array) json_decode($grn_items);
        if ($valid) {
            if (!empty($item_array)) {
                array_push($grn, $grn_inv_id);
                array_push($grn, $grn_vendor);
                array_push($grn, $grn_inc_date);
                array_push($grn, $grn_title);
                array_push($grn, $grn_remark);
                array_push($grn, $item_array);
                $res = $login_model->saveNewGrn($grn);
                if ($res) {
                    $data = array('success' => true, 'data' => '', 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            } else {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_GRN_ITEMS);
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

}

?>