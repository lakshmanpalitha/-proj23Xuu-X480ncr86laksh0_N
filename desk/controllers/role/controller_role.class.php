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

            if (!empty($role_doc_types)) {
                $res = $login_model->saveNewRole($role_name, $role_doc_types);
                if ($res) {
                    $data = array('success' => true, 'data' => '', 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            }
            echo json_encode($data);
        }
    }

}

?>