<?php

class role extends controller {

    function __construct($module) {
        auth::handleLogin();
        parent::__construct($module);
    }

    function index() {
        $login_model = $this->loadModel('role');
        $this->view->role = $login_model->getAllRole();
        $this->view->sys_doc_types = $login_model->getDocumentTypes();
        $this->view->render('role/role', true, true, $this->module);
    }

    function addNewRole() {
        $valid = true;
        $data = array();
        $login_model = $this->loadModel('role');

        if (!$role_name = $this->read->get("role-name", "POST", 'STRING', 250, true))
            $valid = false;
        if (!$role_id = $this->read->get("role_id", "POST", '', 20, false))
            $valid = false;
        $role_id = (is_bool($role_id) ? '' : ($role_id));
        if ($valid) {
            $doc_types = isset($_POST['role-doc-typ']) ? $_POST['role-doc-typ'] : null;
            $doc_types_privileges = isset($_POST['role-doc-prv']) ? $_POST['role-doc-prv'] : null;

            $role_doc_types = array();
            if (is_array($doc_types) && is_array($doc_types_privileges)) {
                $i = 0;
                foreach ($doc_types as $typ) {
                    $role_doc_types[$i]['typ'] = $typ;
                    $role_doc_types[$i]['prv'] = $doc_types_privileges[$i];
                    $i++;
                }
            }
            $role = array();
            if (!empty($role_doc_types)) {
                array_push($role, $role_name);
                array_push($role, $role_doc_types);
                if ($role_id) {
                    $res = $login_model->modifyRole($role_id, $role);
                } else {
                    $res = $login_model->saveNewRole($role);
                }
                if ($res) {
                    $data = array('success' => true, 'data' => '', 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            }
            echo json_encode($data);
        }
    }

    function jsonRole($role_id = null) {
        if ($role_id) {
            $login_model = $this->loadModel('role');
            $res = $login_model->getEachRole($role_id);
            if ($res) {
                $data = array('success' => true, 'data' => $res, 'error' => '');
            } else {
                $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_EMPTY_ROLE_ID);
        }
        echo json_encode($data);
    }

    function jsonStatus($role_id = null, $stsus = null) {
        $data = '';
        if ($role_id && ($stsus == 'D')) {
            $login_model = $this->loadModel('role');
            $item = $login_model->modifyStatus($role_id, $stsus);
            if ($item) {
                $data = array('success' => true, 'data' => $item, 'error' => '');
            } else {
                $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_EMPTY_ROLE_ID);
        }
        echo json_encode($data);
    }

}

?>