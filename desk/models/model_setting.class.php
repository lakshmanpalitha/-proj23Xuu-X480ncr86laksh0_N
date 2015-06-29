<?php

class settingModel extends model {

    function getAllCat() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_item_category 
            ORDER 
                BY ITEM_CAT_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }
    function getAllActiveCat() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_item_category 
            WHERE
                ITEM_CAT_STATUS='A'
            ORDER 
                BY ITEM_CAT_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getAllSubCat() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_item_category cat,
                tbl_item_sub_category sub 
            WHERE 
                sub.ITEM_CAT_ID = cat.ITEM_CAT_ID
                AND cat.ITEM_CAT_STATUS='A'
                AND sub.ITEM_SUB_CAT_STATUS='A'
            ORDER 
                BY sub.ITEM_SUB_CAT_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }
    function getAllActiveSubCat() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_item_category cat,
                tbl_item_sub_category sub 
            WHERE 
                sub.ITEM_CAT_ID = cat.ITEM_CAT_ID
            ORDER 
                BY sub.ITEM_SUB_CAT_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getSubCatById($cat) {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_item_sub_category 
            WHERE 
                ITEM_CAT_ID = '" . mysql_real_escape_string($cat) . "'
                AND ITEM_SUB_CAT_STATUS='A'
            ORDER 
                BY ITEM_SUB_CAT_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function saveNewCategory($category) {
        $primaryKey = $this->primaryKeyGenarator('tbl_item_category', 'ITEM_CAT_ID');
        if ($primaryKey) {
            $primaryKey = 'CAT' . $primaryKey;
            $query = "
            INSERT INTO 
            tbl_item_category
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                '" . mysql_real_escape_string($category[0]) . "',
                    '" . mysql_real_escape_string($category[1]) . "'                                                                                                        
            )";

            $result = $this->db->execute($query);
            return $result ? true : false;
        }
        return false;
    }

    function saveNewSubCategory($sub_category) {
        $primaryKey = $this->primaryKeyGenarator('tbl_item_sub_category', 'ITEM_SUB_CAT_ID');
        if ($primaryKey) {
            $primaryKey = 'SUB' . $primaryKey;
            $query = "
            INSERT INTO 
            tbl_item_sub_category
            VALUES(
            '" . mysql_real_escape_string($sub_category[0]) . "',
                '" . mysql_real_escape_string($primaryKey) . "',
                    '" . mysql_real_escape_string($sub_category[1]) . "',
                '" . mysql_real_escape_string($sub_category[2]) . "'  
            )";
            $result = $this->db->execute($query);
            return $result ? true : false;
        }
        return false;
    }

}

?>