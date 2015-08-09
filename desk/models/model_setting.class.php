<?php

class settingModel extends model {

    function getAllCat() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_item_category
            WHERE
                ITEM_CAT_STATUS NOT IN('D')
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
                ITEM_CAT_STATUS IN('A')
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
                AND cat.ITEM_CAT_STATUS NOT IN('D')
                AND sub.ITEM_SUB_CAT_STATUS NOT IN('D')
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

    function editCategory($category, $cat_id) {
        if ($cat_id) {
            $query = "
                UPDATE 
                    tbl_item_category 
                SET 
                    ITEM_CAT_NAME='" . mysql_real_escape_string($category[0]) . "' 
                WHERE 
                    ITEM_CAT_ID='" . mysql_real_escape_string($cat_id) . "'";
            $result = $this->db->execute($query);
            return $result ? true : false;
        }
        return false;
    }

    function editSubCategory($sub_category, $sub_cat_id) {
        if ($sub_cat_id) {
            $query = "
                UPDATE 
                    tbl_item_sub_category 
                SET 
                    ITEM_CAT_ID='" . mysql_real_escape_string($sub_category[0]) . "',
                    ITEM_SUB_CAT_NAME='" . mysql_real_escape_string($sub_category[1]) . "' 
                WHERE 
                    ITEM_SUB_CAT_ID='" . mysql_real_escape_string($sub_cat_id) . "'";

            $result = $this->db->execute($query);
            return $result ? true : false;
        }
        return false;
    }

    function modifyCatStatus($cat_id = null, $ststus = null) {
        if (!$cat_id OR !$ststus)
            return false;
        $query = "UPDATE tbl_item_category SET
                        ITEM_CAT_STATUS= '" . mysql_real_escape_string($ststus) . "'
                 WHERE ITEM_CAT_ID='" . mysql_real_escape_string($cat_id) . "'";
        $result = $this->db->execute($query);
        return $result ? true : false;
    }

    function modifySubCatStatus($sub_cat_id = null, $ststus = null) {
        if (!$sub_cat_id OR !$ststus)
            return false;
        $query = "UPDATE tbl_item_sub_category SET
                        ITEM_SUB_CAT_STATUS= '" . mysql_real_escape_string($ststus) . "'
                 WHERE ITEM_SUB_CAT_ID='" . mysql_real_escape_string($sub_cat_id) . "'";
        $result = $this->db->execute($query);
        return $result ? true : false;
    }

    function checkCatUsed($cat_id) {
        if ($cat_id) {
            $query = "SELECT 
                        COUNT(ITEM_ID) 
                      FROM 
                        tbl_item_master 
                      WHERE 
                        ITEM_CATEGORY_ID IN ('" . mysql_real_escape_string($cat_id) . "')";
            $result = $this->db->queryUniqueValue($query);
            return $result ? $result : false;
        }
        return false;
    }

    function checkSubCatUsed($sub_cat_id) {
        if ($sub_cat_id) {
            $query = "SELECT 
                        COUNT(ITEM_ID) 
                      FROM 
                        tbl_item_master 
                      WHERE 
                        ITEM_SUB_CATEGORY_ID IN ('" . mysql_real_escape_string($sub_cat_id) . "')";
            $result = $this->db->queryUniqueValue($query);
            return $result ? $result : false;
        }
        return false;
    }

}

?>