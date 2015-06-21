<?php

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set("Asia/Calcutta");


/*
 * off magic_quotes_gpc
 */
if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}

/**
 * Configuration for: Base URL
 */
define('URL', 'http://microsola.com/preview/biotech/');
define('DOC_PATH', '/home2/microsq0/public_html/preview/biotech/');

/**
 * Define module path
 */
define('MOD_ADMIN_URL', 'http://microsola.com/preview/biotech/desk/');
define('MOD_ADMIN_DOC', '/home2/microsq0/public_html/preview/biotech/desk/');


/**
 * Define log path
 */
define('LOG_PATH', DOC_PATH . 'logs/error.log');
define('RUNTIME_LOG_PATH', DOC_PATH . 'logs/runtime/');


/*
 * Define templates path
 */
define('CSS_PATH', URL . 'assets/css/');
define('JS_PATH', URL . 'assets/js/');
define('IMAGE_PATH', URL . 'assets/images/');

/**
 * Configuration for: Folders
 * Here you define where your folders are. Unless you have renamed them, there's no need to change this.
 */
define('COMMON_PATH', 'libs/');
define('CONTROLLER_PATH', 'controllers/');
define('MODELS_PATH', 'models/');
define('VIEWS_PATH', 'views/');



/**
 * Configuration for: Cookies 
 */
define('COOKIE_RUNTIME', 1209600);
define('COOKIE_DOMAIN', '.localhost');

/**
 * Configuration for: Database
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'microsq0_biotech');
define('DB_USER', 'microsq0_preview');
define('DB_PASS', 'lanka1234');



/**
 * Configuration for: Email server credentials
 */
define("PHPMAILER_DEBUG_MODE", 0);
// use SMTP or basic mail() ? SMTP is strongly recommended
define("EMAIL_USE_SMTP", false);
// name of your host
define("EMAIL_SMTP_HOST", 'yourhost');
// leave this true until your SMTP can be used without login
define("EMAIL_SMTP_AUTH", true);
// SMTP provider username
define("EMAIL_SMTP_USERNAME", 'yourusername');
// SMTP provider password
define("EMAIL_SMTP_PASSWORD", 'yourpassword');
// SMTP provider port
define("EMAIL_SMTP_PORT", 465);
// SMTP encryption, usually SMTP providers use "tls" or "ssl", for details see the PHPMailer manual
define("EMAIL_SMTP_ENCRYPTION", 'ssl');

/*
 * include error description file
 */
include('error.php');
?>