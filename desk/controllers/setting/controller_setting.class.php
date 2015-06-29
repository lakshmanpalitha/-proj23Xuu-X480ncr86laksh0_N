<?php

class setting extends controller {

    function __construct($module) {
        auth::handleLogin();
        parent::__construct($module);
    }

    function index() {
        $login_model = $this->loadModel('setting');
        $this->view->cat = $login_model->getAllCat();
        $this->view->sub_cat = $login_model->getAllSubCat();
        $this->view->render('setting/setting', true, true, $this->module);
    }

    function addNewCategory() {
        $valid = true;
        $data = array();
        $cat = array();
        $login_model = $this->loadModel('setting');

        if (!$cat_name = $this->read->get("cat_name", "POST", 'NUMERIC', 250, true))
            $valid = false;
        if (!$cat_status = $this->read->get("cat_status", "POST", 'STRING', 1, true))
            $valid = false;
        if ($valid) {
            array_push($cat, $cat_name);
            array_push($cat, $cat_status);
            $res = $login_model->saveNewCategory($cat);
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

    function addNewSubCategory() {
        $valid = true;
        $data = array();
        $sub_cat = array();
        $login_model = $this->loadModel('setting');

        if (!$cat_name = $this->read->get("cat", "POST", 'NUMERIC', 6, true))
            $valid = false;
        if (!$sub_cat_name = $this->read->get("sub_cat_name", "POST", 'NUMERIC', 250, true))
            $valid = false;
        if (!$sub_cat_status = $this->read->get("sub_cat_status", "POST", 'STRING', 1, true))
            $valid = false;
        if ($valid) {
            array_push($sub_cat, $cat_name);
            array_push($sub_cat, $sub_cat_name);
            array_push($sub_cat, $sub_cat_status);
            $res = $login_model->saveNewSubCategory($sub_cat);
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

    function jsonGetSubCatByCat() {
        $data = array();
        $valid=true;
        if (!$cat = $this->read->get("cat", "POST", 'NUMERIC', 6, true)){
            $valid = false;
        }
        if ($valid) {
            $login_model = $this->loadModel('setting');
            $data = array('success' => true, 'data' => $login_model->getSubCatById($cat), 'error' => '');
        } else {
            $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
        }
        echo json_encode($data);
    }

}

?>