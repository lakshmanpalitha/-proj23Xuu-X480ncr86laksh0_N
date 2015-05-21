<?php

// Load application config (error reporting, database credentials etc.)
require 'config/config.php';

// The auto-loader to load the php-login related internal stuff automatically
require 'config/autoload.php';

// The Composer auto-loader (official way to load Composer contents) to load external stuff automatically
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}

error::SetLogFile(DOC_PATH . 'logs/error.log');
//error::SetLogLevel(E_ALL | E_STRICT, true);
error::SetLogLevel(E_ALL, true);
error::SetDebug(false, true); //echo debug data and do it between <pre></pre> tags
// Start our application
$app = new application();
