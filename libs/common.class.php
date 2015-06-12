<?php

class common {

    function __construct(Database $db) {
        
    }

    function log($data, $name) {

        $loged_user = session::get('user_email');
        $file_name = RUNTIME_LOG_PATH . $name . date("Y_m_d_h") . ".txt";
        $mess = "";
        $mess = $mess . "Timestamp : " . date("d-m-Y h:i:s") . ", \n";
        $mess = $mess . "User : " . $loged_user . ", \n";
        $mess = $mess . $data . " \n";
        $mess = $mess . "==================================================================================================================== \n\n";
        if (!file_exists(RUNTIME_LOG_PATH)) {
            @mkdir(RUNTIME_LOG_PATH, 0777, true);
        }

        if (file_exists(RUNTIME_LOG_PATH)) {
            $file = @fopen($file_name, "a+");
            @fwrite($file, $mess);
            @chmod($file_name, 0755);
            @fclose($file);
        }
    }

}

?>