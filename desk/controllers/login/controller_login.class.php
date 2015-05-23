<?php

class login extends controller {

    function __construct($module) {
        //auth::handleLogin();
        parent::__construct($module);
    }

    function index() {

        $this->view->render('login/login', true, true, $this->module);
    }

    function doLogin() {
        $valid = true;
        $login_status = 'invalid';
        $resp = array();
        $res = '';

        $login_model = $this->loadModel('login');

        if (!$login_email = $this->read->get("email", "POST", 'EMAIL', 150, true))
            $valid = false;
        if (!$login_password = $this->read->get("password", "POST", '', '', true))
            $valid = false;


        if (!$valid) {
            $res = FEEDBACK_FIELD_NOT_VALID_TYPE;
            $login_status = 'invalid';
        } else {
            $res = $login_model->login($login_email, $login_password);
            if ($res === true) {
                $login_status = 'success';
                $res = '';
            } else {
                $login_status = 'invalid';
            }
        }

        $resp['login_error'] = $res;
        $resp['login_status'] = $login_status;
        $resp['redirect_url'] = URL . 'desk/';

        echo json_encode($resp);
    }

    function logout() {
        session::set('user_logged_in', false);
        session::set('user_email', null);
        session::set('user_type', null);
        session::set('user_id', null);
        session::set('user_last_log', null);

        Session::clear('user_logged_in');
        Session::clear('user_email');
        Session::clear('user_type');
        Session::clear('user_id');
        Session::clear('user_last_log');

        header('location: ' . URL . 'desk/login/');
    }

}

?>