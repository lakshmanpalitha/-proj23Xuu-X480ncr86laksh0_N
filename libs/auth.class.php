<?php

/**
 * Class Auth
 * Simply checks if user is logged in. In the app, several controllers use Auth::handleLogin() to
 * check if user if user is logged in, useful to show controllers/methods only to logged-in users.
 */
class auth {

    public static function handleLogin() {
        // initialize the session
        session::init();

        // if user is still not logged in, then destroy session, handle user as "not logged in" and
        // redirect user to login page
        if (!isset($_SESSION['user_logged_in'])) {
            session::destroy();
            header('location: ' . URL . 'desk/login/');
        }
    }
    public static function isAdmin() {
        // initialize the session
        session::init();

        // if user is still not logged in, then destroy session, handle user as "not logged in" and
        // redirect user to login page
        if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'A') {
            session::setError("feedback_negative", FEEDBACK_COMPANY_ACCESS_PROHIBIT);
            header('location: ' . URL . 'admin/user/error/');
        }
    }





}
