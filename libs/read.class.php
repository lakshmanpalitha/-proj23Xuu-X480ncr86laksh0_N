<?php

define("GET", "GET");
define("POST", "POST");
define("REQUSET", "REQUSET");
define("SESSION", "SESSION");
define("COOKIE", "COOKIE");

class read {

    private $lastread;
    private $index;

    public function get($index, $method = REQUSET, $validate = false, $length = 0, $required = false) {
        $ex = explode(",", $index);
        if (is_array($ex))
            if (isset($ex[1]))
                if ($ex[1] != null) {
                    foreach ($ex as $e) {
                        $s[$e] = $this->sget($e, $method, $validate);
                    }
                    return $s;
                } else {
                    return $this->sget($index, $method, $validate);
                } else {
                return $this->sget($index, $method, $validate, $length, $required);
            }
    }

    private function sget($index, $method = REQUSET, $validate, $length, $required) {
        $this->lastread = false;
        $this->index = $index;
        if ($method == GET) {
            $this->lastread = (isset($_GET[$index])) ? $_GET[$index] : false;
        } else if ($method == POST) {
            $this->lastread = (isset($_POST[$index])) ? $_POST[$index] : false;
        } else if ($method == SESSION) {
            $this->lastread = (isset($_SESSION[$index])) ? $_SESSION[$index] : false;
        } else if ($method == COOKIE) {
            $this->lastread = (isset($_COOKIE[$index])) ? $_COOKIE[$index] : false;
        } else {
            $this->lastread = (isset($_REQUEST[$index])) ? $_REQUEST[$index] : false;
        }
        
        if (!$this->lastread) {
            if (!$required) {
                return true;
            } else {
                session::setError("feedback_negative", $this->index . " " . FEEDBACK_FIELD_REQUIRED);
                return false;
            }
        }


        if ($validate) {
            if ($validate == 'INT') {
                if (!validation::isInt($this->lastread)) {
                    session::setError("feedback_negative", $this->index . " " . FEEDBACK_INT_VALIDATION);
                    return false;
                }
            } else if ($validate == 'DOUBLE') {
                if (!validation::isDecimal($this->lastread)) {
                    session::setError("feedback_negative", $this->index . " " . FEEDBACK_DECIMAL_VALIDATION);
                    return false;
                }
            } else if ($validate == 'STRING') {
                if (!validation::isString($this->lastread)) {
                    session::setError("feedback_negative", $this->index . " " . FEEDBACK_STRING_VALIDATION);
                    return false;
                }
            } else if ($validate == 'NUMERIC') {
                if (!validation::isAlphaNumeric($this->lastread)) {
                    session::setError("feedback_negative", $this->index . " " . FEEDBACK_NUMERIC_VALIDATION);
                    return false;
                }
            } else if ($validate == 'DATE') {
                if (!validation::isDate($this->lastread)) {
                    session::setError("feedback_negative", $this->index . " " . FEEDBACK_DATE_VALIDATION);
                    return false;
                }
            } else if ($validate == 'EMAIL') {
                if (!validation::isEmail($this->lastread)) {
                    session::setError("feedback_negative", $this->index . " " . FEEDBACK_EMAIL_VALIDATION);
                    return false;
                }
            } else if ($validate == 'SPCHARS') {
                if (!validation::isSpecialChars($this->lastread)) {
//                    session::setError("feedback_negative", $this->index . "" . FEEDBACK_POLICY_EMPTY_FIELDS);
//                    return false;
                }
            }
        }

        if ($length > 0) {
            if (strlen($this->lastread) > $length) {
                session::setError("feedback_negative", $this->index . "" . FEEDBACK_LENGTH_VALIDATION . FEEDBACK_MAX_LENGTH);
                return false;
            }
        }
        return $this->lastread;
    }

}

?>
