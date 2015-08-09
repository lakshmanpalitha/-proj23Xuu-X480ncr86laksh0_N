<?php

class batch extends controller {

    function __construct($module) {
        auth::handleLogin();
        parent::__construct($module);
    }

    /**
     * Display the company dashbord sccreen
     */
    function index() {
        $login_model = $this->loadModel('batch');
        $this->view->batchs = $login_model->getAllBatch();
        $this->view->render('batch/batch', true, true, $this->module);
    }

    function newBatch() {
        $login_model = $this->loadModel('batch');
        $login_model_item = $this->loadModel('item');
        $login_model_product = $this->loadModel('product');
        $this->view->items = $login_model_item->getAllActiveItem();
        $this->view->products = $login_model_product->getAllActiveProduct();
        $this->view->render('batch/add_batch', true, true, $this->module);
    }

    function viewBatch($batch_id) {
        if (!empty($batch_id)) {
            $login_model = $this->loadModel('batch');
            $login_model_item = $this->loadModel('item');
            $login_model_product = $this->loadModel('product');
            $this->view->items = $login_model_item->getAllActiveItem();
            $this->view->products = $login_model_product->getAllActiveProduct();
            $this->view->batch = $login_model->getSelectBatch(base64_decode($batch_id));
            $this->view->batch_mats = $login_model->getSelectBatchMaterel(base64_decode($batch_id));
            $this->view->history = $login_model->history(base64_decode($batch_id));
            $this->view->render('batch/view_batch', true, true, $this->module);
        } else {
            header('Location: ' . MOD_ADMIN_URL . "batch");
        }
    }

    function addNewBatch() {

        $valid = true;
        $data = array();
        $batch = array();
        $login_model = $this->loadModel('batch');
        if (!$batch_code = $this->read->get("batch_code", "POST", 'NUMERIC', 50, true))
            $valid = false;
        if (!$batch_name = $this->read->get("batch_name", "POST", 'NUMERIC', 250, true))
            $valid = false;
        if (!$batch_product = $this->read->get("batch_product", "POST", 'NUMERIC', 6, true))
            $valid = false;
        if (!$batch_qty = $this->read->get("batch_qty", "POST", 'DOUBLE', '', true))
            $valid = false;
        if (!$batch_remark = $this->read->get("batch_remark", "POST", '', 1500, false))
            $valid = false;
        if (!$batch_items = $this->read->get("items", "POST", '', '', false))
            $valid = false;
        if (!$old_batch_id = $this->read->get("old_batch_id", "POST", '', '', false))
            $valid = false;
        if (!$batch_exp_date = $this->read->get("exp_date", "POST", '', '', true))
            $valid = false;
        $old_batch_id = (is_bool($old_batch_id) ? '' : ($old_batch_id));

        $item_array = (array) json_decode($batch_items);
        if ($valid) {
            array_push($batch, $batch_code);
            array_push($batch, 'A');
            array_push($batch, $batch_name);
            array_push($batch, $batch_product);
            array_push($batch, $batch_qty);
            array_push($batch, is_bool($batch_remark) ? '' : $batch_remark);
            array_push($batch, $item_array);
            array_push($batch, $batch_exp_date);
            if ($old_batch_id) {
                $status = $login_model->getSelectBatch($old_batch_id);
                if ($status->BATCH_MODE == 'S' OR $status->BATCH_MODE == 'P') {//Status save  or submit 
                    $res = $login_model->modifyBatch($old_batch_id, $batch);
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_BATCH_UPDATE_FAILED);
                    exit(json_encode($data));
                }
            } else {
                $res = $login_model->saveNewBatch($batch);
            }
            if ($res) {
                $data = array('success' => true, 'data' => '', 'error' => '');
            } else {
                $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

    function jsonStatus($batch_id = null, $stsus = null) {
        $data = '';
        if ($batch_id && ($stsus == 'D' OR $stsus == 'A' OR $stsus == 'I')) {
            $login_model = $this->loadModel('batch');
            $mode = $login_model->getSelectBatch($batch_id);
            if ($mode->BATCH_MODE == 'A' && $stsus == 'D') {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_BATCH_DELETE_FAILED);
            } else {
                $item = $login_model->modifyStatus($batch_id, $stsus);
                if ($item) {
                    $data = array('success' => true, 'data' => $item, 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_EMPTY_BATCH_ID);
        }
        echo json_encode($data);
    }

    function jsonMode($batch_id = null, $stsus = null) {
        $data = '';
        $login_model = $this->loadModel('batch');
        $mode = $login_model->getSelectBatch($batch_id);
        if ($mode->BATCH_MODE == 'A' && $stsus == 'P') {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_INVALID_ACTION);
        } else {
            if ($batch_id && ($stsus == 'P' OR $stsus == 'A')) {
                $item = $login_model->modifyMode($batch_id, $stsus);
                if ($item) {
                    $data = array('success' => true, 'data' => $item, 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_ITEM_BATCH_MODIFY_MODE_FAILED);
                }
            } else {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_EMPTY_BATCH_ID);
            }
        }

        echo json_encode($data);
    }

}

?>