<?php

class validation {

    public static function isInt($value) {
        if (empty($value))
            return false;
        $value = trim($value);
        if (!preg_match('/^[0-9]*$/', $value)) {
            return false;
        }
        return true;
    }

    public static function isString($value) {
        if (empty($value))
            return false;
        $value = trim($value);
        if (!preg_match('/^[A-Za-z ]*$/', $value)) {
            return false;
        }
        return true;
    }

    public static function isAlphaNumeric($value) {
        if (empty($value))
            return false;
        $value = trim($value);
        if (!preg_match('/^[A-Za-z0-9 ]*$/', $value)) {
            return false;
        }
        return true;
    }

    public static function isSpecialChars($value) {
        if (empty($value))
            return false;
        $value = trim($value);
        if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $value)) {
            return false;
        }
        return true;
    }

    public static function isDate($value) {
        $value = trim($value);
        if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $value)) {
            return false;
        }
        return true;
    }

    public static function isDecimal($value) {
        if (empty($value))
            return false;
        if (!preg_match('/^[0-9]+(\.[0-9]{1,5})?$/', $value)) {
            return false;
        }
        return true;
    }

    public static function isEmail($value) {
        $value = trim($value);
        if (empty($value))
            return false;
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

}

?>