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

    function viewGrn($grn_id) {
        if (!empty($grn_id)) {
            $login_model = $this->loadModel('grn');
            $login_model_item = $this->loadModel('item');
            $login_model_vendor = $this->loadModel('vendor');
            $this->view->items = $login_model_item->getAllActiveItem();
            $this->view->vendors = $login_model_vendor->getAllActiveVendors();
            $this->view->grn = $login_model->getSelectGrn(base64_decode($grn_id));
            $this->view->grn_items = $login_model->getItemsSelectedGrn(base64_decode($grn_id));
            $this->view->history = $login_model->history(base64_decode($grn_id));
            $this->view->render('grn/view_grn', true, true, $this->module);
        } else {
            header('Location: ' . MOD_ADMIN_URL . "grn");
        }
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
        if (!$grn_title = $this->read->get("grn_title", "POST", '', 250, false))
            $valid = false;
        if (!$grn_remark = $this->read->get("grn_remark", "POST", '', 1500, false))
            $valid = false;
        if (!$grn_items = $this->read->get("items", "POST", '', '', true))
            $valid = false;
        if (!$old_grn_id = $this->read->get("old_grn_id", "POST", '', '', false))
            $valid = false;

        $old_grn_id = (is_bool($old_grn_id) ? '' : ($old_grn_id));
        $grn_title = (is_bool($grn_title) ? '' : ($grn_title));

        $item_array = (array) json_decode($grn_items);
        if ($valid) {
            if (!empty($item_array)) {
                array_push($grn, is_bool($grn_inv_id) ? '' : $grn_inv_id);
                array_push($grn, $grn_vendor);
                array_push($grn, $grn_inc_date);
                array_push($grn, $grn_title);
                array_push($grn, is_bool($grn_remark) ? '' : $grn_remark);
                array_push($grn, $item_array);
                if ($old_grn_id) {
                    $status = $login_model->getSelectGrn($old_grn_id);
                    if ($status->GRN_MODE == 'S' OR $status->GRN_MODE == 'P') {//Status save  or submit 
                        $res = $login_model->modifyGrn($old_grn_id, $grn);
                    } else {
                        $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_GRN_UPDATE_FAILED);
                        exit(json_encode($data));
                    }
                } else {
                    $res = $login_model->saveNewGrn($grn);
                }
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

    function jsonItem($item_code = null) {
        $data = '';
        if ($item_code) {
            $login_model = $this->loadModel('grn');
            $item = $login_model->getItemsSelectedGrn(null, $item_code);
            if ($item) {
                $data = array('success' => true, 'data' => $item, 'error' => '');
            } else {
                $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        }
        echo json_encode($data);
    }

    function jsonStatus($grn_id = null, $stsus = null) {
        $data = '';
        if ($grn_id && ($stsus == 'D' OR $stsus == 'A' OR $stsus == 'I')) {
            $login_model = $this->loadModel('grn');
            $grn = $login_model->getSelectGrn($grn_id);
            if ($grn->GRN_MODE == 'A' && $stsus == 'D') {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_GRN_DELETE_FAILED);
            } else {
                $item = $login_model->modifyStatus($grn_id, $stsus);
                if ($item) {
                    $data = array('success' => true, 'data' => $item, 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_EMPTY_GRN_ID);
        }
        echo json_encode($data);
    }

    function jsonMode($grn_id = null, $stsus = null) {
        $data = '';
        $login_model = $this->loadModel('grn');
        $mode = $login_model->getSelectGrn($grn_id);
        if ($mode->GRN_MODE == 'A' && $stsus == 'P') {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_INVALID_ACTION);
        } else {
            if ($grn_id && ($stsus == 'P' OR $stsus == 'A')) {
                $item = $login_model->modifyMode($grn_id, $stsus);
                if ($item) {
                    $data = array('success' => true, 'data' => $item, 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_ITEM_GRN_MODIFY_MODE_FAILED);
                }
            } else {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_EMPTY_GRN_ID);
            }
        }

        echo json_encode($data);
    }

}

?>