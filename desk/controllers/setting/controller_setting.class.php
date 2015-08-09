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
        if (!$cat_id = $this->read->get("cat_id", "POST", '', '', false))
            $valid = false;
        $cat_id = (is_bool($cat_id) ? '' : ($cat_id));

        if ($valid) {
            array_push($cat, $cat_name);
            array_push($cat, 'A');
            if ($cat_id) {
                $res = $login_model->editCategory($cat, base64_decode($cat_id));
            } else {
                $res = $login_model->saveNewCategory($cat);
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

    function addNewSubCategory() {
        $valid = true;
        $data = array();
        $sub_cat = array();
        $login_model = $this->loadModel('setting');

        if (!$cat_name = $this->read->get("cat", "POST", 'NUMERIC', 6, true))
            $valid = false;
        if (!$sub_cat_name = $this->read->get("sub_cat_name", "POST", 'NUMERIC', 250, true))
            $valid = false;
        if (!$sub_cat_id = $this->read->get("sub_cat_id", "POST", '', '', false))
            $valid = false;
        $sub_cat_id = (is_bool($sub_cat_id) ? '' : ($sub_cat_id));
        if ($valid) {
            array_push($sub_cat, $cat_name);
            array_push($sub_cat, $sub_cat_name);
            array_push($sub_cat, 'A');
            if ($sub_cat_id) {
                $res = $login_model->editSubCategory($sub_cat, base64_decode($sub_cat_id));
            } else {
                $res = $login_model->saveNewSubCategory($sub_cat);
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

    function jsonGetSubCatByCat() {
        $data = array();
        $valid = true;
        if (!$cat = $this->read->get("cat", "POST", 'NUMERIC', 6, true)) {
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

    function jsonCatStatus($cat_id = null, $stsus = null) {
        $data = '';
        if ($cat_id && ($stsus == 'D' OR $stsus == 'A' OR $stsus == 'I')) {
            $login_model = $this->loadModel('setting');
            $count = $login_model->checkCatUsed($cat_id);
            if ($count == 0 OR $stsus == 'A' OR $stsus == 'I' ) {
                $item = $login_model->modifyCatStatus($cat_id, $stsus);
                if ($item) {
                    $data = array('success' => true, 'data' => $item, 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            } else {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_FAILED_DELETE_CAT);
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_INVALID_CATEGORY);
        }
        echo json_encode($data);
    }

    function jsonSubCatStatus($sub_cat_id = null, $stsus = null) {
        $data = '';
        if ($sub_cat_id && ($stsus == 'D' OR $stsus == 'A' OR $stsus == 'I')) {
            $login_model = $this->loadModel('setting');
            $count = $login_model->checkSubCatUsed($sub_cat_id);
            if ($count == 0 OR $stsus == 'A' OR $stsus == 'I' ) {
                $item = $login_model->modifySubCatStatus($sub_cat_id, $stsus);
                if ($item) {
                    $data = array('success' => true, 'data' => $item, 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            } else {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_FAILED_DELETE_SUBCAT);
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_INVALID_SUBCATEGORY);
        }
        echo json_encode($data);
    }

}

?>