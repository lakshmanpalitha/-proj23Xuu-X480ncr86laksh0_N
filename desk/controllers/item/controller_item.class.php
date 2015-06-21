<?php

class item extends controller {

    function __construct($module) {
        auth::handleLogin();
        parent::__construct($module);
    }

    /**
     * Display the company dashbord sccreen
     */
    function index() {
        $login_model = $this->loadModel('item');
        $this->view->items = $login_model->getAllItem();
        $this->view->render('item/item', true, true, $this->module);
    }

    function newItem() {
        $login_model = $this->loadModel('item');
        $login_model_setting = $this->loadModel('setting');
        $this->view->cat = $login_model_setting->getAllActiveCat();
        $this->view->unit = $login_model->getAllActiveUnit();
        $this->view->render('item/add_item', true, true, $this->module);
    }

    function addNewItem() {

        $valid = true;
        $data = array();
        $item = array();
        $login_model = $this->loadModel('item');

        if (!$item_code = $this->read->get("itm_code", "POST", 'NUMERIC', 50, false))
            $valid = false;
        if (!$item_name = $this->read->get("item_name", "POST", 'NUMERIC', 250, true))
            $valid = false;
        if (!$item_status = $this->read->get("item_status", "POST", 'STRING', 1, true))
            $valid = false;
        if (!$item_cat = $this->read->get("item_cat", "POST", 'NUMERIC', 6, true))
            $valid = false;
        if (!$item_sub_cat = $this->read->get("item_sub_cat", "POST", 'NUMERIC', 6, true))
            $valid = false;
        if (!$item_stock_unit = $this->read->get("item_stock_unit", "POST", 'NUMERIC', 6, true))
            $valid = false;
        if (!$item_ratio = $this->read->get("item_ratio", "POST", 'DOUBLE', '', true))
            $valid = false;
        if (!$item_issue_unit = $this->read->get("issue_unit", "POST", 'NUMERIC', 6, true))
            $valid = false;
        if (!$item_ord_lvl = $this->read->get("item_ord_lvl", "POST", 'DOUBLE', '', true))
            $valid = false;
        if (!$item_n_ord_lvl = $this->read->get("item_n_ord_lvl", "POST", 'DOUBLE', '', true))
            $valid = false;
        if (!$item_loc = $this->read->get("item_loc", "POST", 'NUMERIC', 20, true))
            $valid = false;
        if (!$item_remark = $this->read->get("item_remark", "POST", '', 1500, true))
            $valid = false;
        if ($valid) {
            array_push($item, $item_code);
            array_push($item, $item_name);
            array_push($item, $item_cat);
            array_push($item, $item_sub_cat);
            array_push($item, $item_stock_unit);
            array_push($item, $item_ratio);
            array_push($item, $item_issue_unit);
            array_push($item, $item_ord_lvl);
            array_push($item, $item_n_ord_lvl);
            array_push($item, $item_loc);
            array_push($item, $item_remark);
            array_push($item, $item_status);

            $res = $login_model->saveNewItem($item);
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

    function jsonGetItemStockUnit() {
        $data = array();
        $valid = true;
        if (!$itemId = $this->read->get("item_id", "POST", 'NUMERIC', 6, true)) {
            $valid = false;
        }
        if ($valid) {
            $login_model = $this->loadModel('item');
            $data = array('success' => true, 'data' => $login_model->getItemStockUnit($itemId), 'error' => '');
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

}

?>