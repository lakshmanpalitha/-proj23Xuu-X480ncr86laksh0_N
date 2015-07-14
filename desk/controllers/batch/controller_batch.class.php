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
        if (!$batch_status = $this->read->get("batch_status", "POST", 'STRING', 1, true))
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
        $item_array = (array) json_decode($batch_items);
        if ($valid) {
            array_push($batch, $batch_code);
            array_push($batch, $batch_status);
            array_push($batch, $batch_name);
            array_push($batch, $batch_product);
            array_push($batch, $batch_qty);
            array_push($batch, $batch_remark);
            array_push($batch, $item_array);
            $res = $login_model->saveNewBatch($batch);
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

}

?>