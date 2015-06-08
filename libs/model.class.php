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
        $this->email = new PHPMailer();
        $this->arr = array();
    }

    function selectUserModule($user_id = null) {
        if (empty($user_id))
            return false;
        $query = "
            SELECT 
                MD.MODULE_NAME,
                DT.DOC_TYPE_NAME,
                RDM.PERMISSION_LEVEL
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
            ORDER BY 
                MD.MODULE_ORDER ASC";
        
   

        $modules = $this->db->queryMultipleObjects($query);
        return empty($modules) ? false : $modules;
    }

}

?>