<?php

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set("Asia/Calcutta");

/**
 * Configuration for: Base URL
 */
define('URL', 'http://localhost/lansuwa/branches/develop/');
define('FILE_URL', '//localhost/lansuwa/branches/develop/');
define('DOC_PATH', 'D:/xampp/htdocs/lansuwa/branches/develop/');

/**
 * Configuration for: Folders
 * Here you define where your folders are. Unless you have renamed them, there's no need to change this.
 */
define('COMMON_PATH', 'libs/');
define('CONTROLLER_PATH', 'application/controllers/');
define('MODELS_PATH', 'application/models/');
define('VIEWS_PATH', 'application/views/');



/**
 * Configuration for: Cookies 
 */
define('COOKIE_RUNTIME', 1209600);
define('COOKIE_DOMAIN', '.localhost');

/**
 * Configuration for: Database
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'db_lansuwa');
define('DB_USER', 'root');
define('DB_PASS', '');



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


/* image upload setting */
define("MAX_UPLOAD_SIZE", 5000 * 1024);

define("CAT_THUMB_WIDTH", 100);
define("CAT_THUMB_HEIGHT", 70);
define("CAT_MEDIUM_WIDTH", 300);
define("CAT_MEDIUM_HEIGHT", 180);
define("CAT_ORIGINAL_UPLOAD_PATH", DOC_PATH . "public/uploads/product_category/large/");
define("CAT_THUMB_UPLOAD_PATH", DOC_PATH . "public/uploads/product_category/thumb/");
define("CAT_MEDIUM_UPLOAD_PATH", DOC_PATH . "public/uploads/product_category/medium/");
define("CAT_ALLOW_THUMB", true);
define("CAT_ALLOW_MEDIUM", true);

define("PRODUCT_THUMB_WIDTH", 100);
define("PRODUCT_THUMB_HEIGHT", 70);
define("PRODUCT_MEDIUM_WIDTH", 300);
define("PRODUCT_MEDIUM_HEIGHT", 180);
define("PRODUCT_ORIGINAL_UPLOAD_PATH", '');
define("PRODUCT_THUMB_UPLOAD_PATH", '');
define("PRODUCT_MEDIUM_UPLOAD_PATH", '');
define("PRODUCT_ALLOW_THUMB", '');
define("PRODUCT_ALLOW_MEDIUM", '');



/*
 * include error description file
 */
include('error.php');
?>