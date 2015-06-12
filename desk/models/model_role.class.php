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

}

?>