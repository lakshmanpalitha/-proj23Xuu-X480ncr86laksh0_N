<?php

class customexception extends Exception {

    public function errorMessage($defErrorCode = null) {
        //error message
        $errorMsg = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
                . ': <b>' . $this->getMessage() . '</b>' . FEEDBACK_EMAIL_VALIDATION;

        return $errorMsg;
    }

}

?>