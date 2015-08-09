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

    function saveNewRole($role) {

        $primaryKey = $this->primaryKeyGenarator('tbl_role', 'ROLE_ID');
        if ($primaryKey) {
            $primaryKey = 'ROL' . $primaryKey;
            $query = "
            INSERT INTO 
            tbl_role
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                '" . mysql_real_escape_string($role[0]) . "',
               'A'
            )";

            $result = $this->db->execute($query);
            if ($result) {
                $values = null;
                foreach ($role[1] as $doc) {
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

    function modifyRole($role_id = null, $role) {
        if (!$role_id)
            return false;
        $query = "UPDATE tbl_role SET
                        ROLE_NAME= '" . mysql_real_escape_string($role[0]) . "'
                 WHERE ROLE_ID='" . mysql_real_escape_string($role_id) . "'";
        $result = $this->db->execute($query);
        if ($result) {
            $values = null;
            $del_query = "DELETE FROM tbl_role_document_type_mapping WHERE ROLE_ID='" . mysql_real_escape_string($role_id) . "'";
            $del_result = $this->db->execute($del_query);
            $result_2 = false;
            if ($del_result) {
                foreach ($role[1] as $doc) {
                    $values.= "('" . $role_id . "','" . $doc['typ'] . "','" . $doc['prv'] . "'),";
                }
                $query_2 = "
                            INSERT INTO 
                            tbl_role_document_type_mapping
                                 VALUES " . rtrim($values, ',');
                $result_2 = $this->db->execute($query_2);
            }
            return $result_2 ? true : false;
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

    function getEachRole($role_id = null) {
        if (!$role_id)
            return false;
        $query = "
            SELECT 
                role.ROLE_ID,
                role.ROLE_NAME,
                (select 
                    GROUP_CONCAT(CONCAT(rd.DOC_TYPE_ID , '#' ,rd.PERMISSION_LEVEL )SEPARATOR ', ')
                 FROM 
                    tbl_role_document_type_mapping rd 
                 WHERE 
                    rd.ROLE_ID=role.ROLE_ID ) as doc_typ                 
            FROM 
                tbl_role role
            WHERE 
                role.ROLE_ID='" . mysql_real_escape_string($role_id) . "'";
        $result = $this->db->queryUniqueObject($query);
        return ($result ? $result : false);
    }

    function modifyStatus($role_id = null, $ststus = null) {
        if (!$role_id OR !$ststus)
            return false;
        $query = "UPDATE tbl_role SET
                        ROLE_STATUS= '" . mysql_real_escape_string($ststus) . "'
                 WHERE ROLE_ID='" . mysql_real_escape_string($role_id) . "'";
        $result = $this->db->execute($query);
        return $result ? true : false;
    }

}

?>