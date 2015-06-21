<?php

class roleModel extends model {

    function getDocumentTypes() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_document_type
            WHERE 
                DOC_TYPE_STATUS='A'";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function saveNewRole($role_name, $doc_types) {

        $primaryKey = $this->primaryKeyGenarator('tbl_role', 'ROLE_ID');
        if ($primaryKey) {
            $primaryKey = 'ROL' . $primaryKey;
            $query = "
            INSERT INTO 
            tbl_role
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                '" . mysql_real_escape_string($role_name) . "',
               'A'
            )";

            $result = $this->db->execute($query);
            if ($result) {
                $values = null;
                foreach ($doc_types as $doc) {
                    $values.= "('" . $primaryKey . "','" . $doc['typ'] . "','" . $doc['prv'] . "'),";
                }
                $query_2 = "
                            INSERT INTO 
                            tbl_role_document_type_mapping
                                 VALUES " . rtrim($values, ',');
                $result_2 = $this->db->execute($query_2);
                return $result_2 ? true : false;
            }
        }
        return false;
    }

    function getAllRole() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_role
            WHERE 
                ROLE_STATUS='A'";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

}

?>