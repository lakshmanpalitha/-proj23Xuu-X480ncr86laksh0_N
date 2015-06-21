<?php

class vendor extends controller {

    function __construct($module) {
        //auth::handleLogin();
        parent::__construct($module);
    }

    function index() {

        $login_model = $this->loadModel('vendor');
        $this->view->vendors = $login_model->getAllVendors();
        $this->view->render('vendor/vendor', true, true, $this->module);
    }

    function addNewVendor() {
        $valid = true;
        $data = array();
        $vendor = array();
        $login_model = $this->loadModel('vendor');

        if (!$vendor_name = $this->read->get("vendor_name", "POST", 'STRING', 250, true))
            $valid = false;
        if (!$vendor_email = $this->read->get("vendor_email", "POST", 'EMAIL', 150, true))
            $valid = false;
        if (!$vendor_address = $this->read->get("vendor_address", "POST", '', 250, true))
            $valid = false;
        if (!$vendor_cno = $this->read->get("vendor_cno", "POST", '', 10, true))
            $valid = false;
        if (!$vendor_typ = $this->read->get("vendor_typ", "POST", 'STRING', 1, true))
            $valid = false;
        if (!$status = $this->read->get("status", "POST", 'STRING', 1, true))
            $valid = false;
        if (!$vendor_remark = $this->read->get("vendor_remark", "POST", '', 1500, false))
            $valid = false;
        if ($valid) {
            array_push($vendor, $vendor_name);
            array_push($vendor, $vendor_email);
            array_push($vendor, $vendor_address);
            array_push($vendor, $vendor_cno);
            array_push($vendor, $vendor_typ);
            array_push($vendor, $status);
            array_push($vendor, $vendor_remark);
            $res = $login_model->saveNewVendor($vendor);
            if ($res) {
                $data = array('success' => true, 'data' => '', 'error' => '');
            } else {
                $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_REQUIRED_FIELDS);
        }

        echo json_encode($data);
    }

}

?>