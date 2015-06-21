<?php

class user extends controller {

    function __construct($module) {
        //auth::handleLogin();
        parent::__construct($module);
    }

    function index() {
        $login_model_role = $this->loadModel('role');
        $login_model = $this->loadModel('user');
        $this->view->role = $login_model_role->getAllRole();
        $this->view->users = $login_model->getAllUsers();
        $this->view->render('user/user', true, true, $this->module);
    }

    function addNewUser() {
        $valid = true;
        $data = array();
        $user = array();
        $login_model = $this->loadModel('user');

        if (!$user_name = $this->read->get("user_name", "POST", 'STRING', 250, true))
            $valid = false;
        if (!$user_email = $this->read->get("user_email", "POST", 'EMAIL', 150, true))
            $valid = false;
        if (!$user_pwd = $this->read->get("pwd", "POST", '', '', true))
            $valid = false;
        if (!$user_re_pwd = $this->read->get("re_pwd", "POST", '', '', true))
            $valid = false;
        if (!$user_status = $this->read->get("status", "POST", 'STRING', 1, true))
            $valid = false;
        if ($valid) {
            $user_role = isset($_POST['user_role']) ? $_POST['user_role'] : null;
            if (empty($user_role)) {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_USER_ROLE);
            } else if ($user_pwd != $user_re_pwd) {
                $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_NEW_USER_PASSWORD);
            } else {
                array_push($user, $user_name);
                array_push($user, $user_email);
                array_push($user, $user_pwd);
                array_push($user, $user_status);
                array_push($user, $user_role);
                $res = $login_model->saveNewUser($user);
                if ($res) {
                    $data = array('success' => true, 'data' => '', 'error' => '');
                } else {
                    $data = array('success' => false, 'data' => '', 'error' => $this->view->renderFeedbackMessagesForJson());
                }
            }
        } else {
            $data = array('success' => false, 'data' => '', 'error' => FEEDBACK_REQUIRED_FIELDS);
        }

        echo json_encode($data);
    }

}

?>