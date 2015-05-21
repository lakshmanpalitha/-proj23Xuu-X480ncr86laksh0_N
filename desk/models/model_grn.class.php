<?php

class grnModel extends model {

    function getUsers() {
        $qry = "
            SELECT 
                * 
            FROM 
                tbl_users";
        $result = $this->db->queryMultipleObjects($qry);
        return ($result ? $result : false);
    }

}

?>