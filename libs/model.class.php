<?php

class model extends common {

    function __construct() {

        // create database connection
        try {
            $this->db = new database();
        } catch (Exception $e) {
            die('Database connection could not be established.');
        }

        $this->read = new read();
        $this->session = new session();
        //$this->email = new PHPMailer();
        $this->arr = array();
    }

    function selectUserModule($user_id = null) {
        if (empty($user_id))
            return false;
        $query = "
            SELECT 
                MD.MODULE_NAME,
                DT.DOC_TYPE_NAME,
                RDM.PERMISSION_LEVEL,
                MD.MODULE_ICON,
                DT.DOC_TYPE_URL
            FROM 
                tbl_user_role_mapping RM,
                tbl_role_document_type_mapping RDM, 
                tbl_document_type DT,
                tbl_module MD
            WHERE 
                RM.USER_ID='" . mysql_real_escape_string($user_id) . "' 
              AND
                RM.ROLE_ID=RDM.ROLE_ID
              AND
                RDM.DOC_TYPE_ID=DT.DOC_TYPE_ID
              AND 
                DT.MODULE_ID=MD.MODULE_ID
              GROUP BY 
                DT.DOC_TYPE_NAME
              ORDER BY 
                MD.MODULE_ORDER ASC";



        $modules = $this->db->queryMultipleObjects($query);
        return empty($modules) ? false : $modules;
    }

    function primaryKeyGenarator($table = null, $primaryKeyCol = null) {
        if (!$table OR !$primaryKeyCol)
            return false;
        $query = "SELECT " . $primaryKeyCol . " FROM " . $table . " ORDER BY " . $primaryKeyCol . " DESC";
        $res = $this->db->queryUniqueValue($query);

        if ($res === null) {
            $key = 1;
            $key = str_pad($key, 3, "0", STR_PAD_LEFT);
            return $key ? $key : false;
        } else if ($res) {
            $key = (int) substr($res, 3);
            $key+=1;
            $key = str_pad($key, 3, "0", STR_PAD_LEFT);
            return $key ? $key : false;
        }
        return false;
    }

    function logHistory($history = array()) {
        if (is_array($history) && !empty($history)) {
            $primaryKey = $this->primaryKeyGenarator('tbl_logs', 'LOG_ID');
            if ($primaryKey) {
                $primaryKey = 'LOG' . $primaryKey;
                $query = "
            INSERT INTO 
            tbl_logs
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                 '" . mysql_real_escape_string($history['log_ref_id']) . "',
                     '" . mysql_real_escape_string($history['log_user']) . "',
                        '" . mysql_real_escape_string($history['log_task']) . "',
                        NOW()
            )";
                $result = $this->db->execute($query);
                return ($result ? true : false);
            }
        }
    }

    function getLogHistory($ref_id) {
        if (empty($ref_id))
            return false;
        $query = "
            SELECT 
                * 
            FROM 
                tbl_logs
             WHERE
                LOG_REF_ID='" . mysql_real_escape_string($ref_id) . "'";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

}

?>