<?php

class itemModel extends model {

    function getAllUnit() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_unit 
            ORDER BY 
                UNIT_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getAllActiveUnit() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_unit 
            WHERE
                UNIT_STATUS='A'
            ORDER BY 
                UNIT_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getAllItem() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_item_master
            WHERE
                ITEM_STATUS NOT IN ('D')
            ORDER BY 
                ITEM_ADD_DATE";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getSelectItem($item_id) {
        if (empty($item_id))
            return false;
        $query = "
            SELECT 
                * 
            FROM 
                tbl_item_master
            WHERE
                ITEM_ID='" . mysql_real_escape_string($item_id) . "'
                AND ITEM_MODE NOT IN ('D')";
        $result = $this->db->queryUniqueObject($query);
        return ($result ? $result : false);
    }

    function getAllActiveItem() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_item_master 
             WHERE
                ITEM_MODE IN ('A')
                AND ITEM_STATUS IN ('A')
            ORDER BY 
                ITEM_NAME";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getItemStockUnit($itemId) {
        $query = "
            SELECT 
                u.UNIT_NAME 
            FROM 
                tbl_unit u,
                tbl_item_master im
             WHERE
                im.ITEM_ID='" . mysql_real_escape_string($itemId) . "'
                AND im.ITEM_STOCK_UNIT=u.UNIT_CODE";
        $result = $this->db->queryUniqueValue($query);
        return ($result ? $result : false);
    }
    function getItemIssueUnit($itemId) {
        $query = "
            SELECT 
                u.UNIT_NAME 
            FROM 
                tbl_unit u,
                tbl_item_master im
             WHERE
                im.ITEM_ID='" . mysql_real_escape_string($itemId) . "'
                AND im.ITEM_ISSUE_UNIT=u.UNIT_CODE";
        $result = $this->db->queryUniqueValue($query);
        return ($result ? $result : false);
    }

    function saveNewItem($item) {
        $primaryKey = $this->primaryKeyGenarator('tbl_item_master', 'ITEM_ID');
        if ($primaryKey) {
            $primaryKey = 'ITM' . $primaryKey;
//            $query = "
//            INSERT INTO 
//            tbl_item_master
//            VALUES(
//            '" . mysql_real_escape_string($primaryKey) . "',
//                 '" . mysql_real_escape_string($item[0]) . "',
//                     '" . mysql_real_escape_string($item[2]) . "',
//                        '" . mysql_real_escape_string($item[3]) . "',
//                            '" . mysql_real_escape_string($item[1]) . "',
//                                '" . mysql_real_escape_string($item[4]) . "',
//                                    '" . mysql_real_escape_string($item[5]) . "',
//                                 '" . mysql_real_escape_string($item[6]) . "',
//                             '" . mysql_real_escape_string($item[7]) . "',
//                         '" . mysql_real_escape_string($item[8]) . "',
//                     '" . mysql_real_escape_string($item[9]) . "',
//                  '" . mysql_real_escape_string($item[10]) . "',
//            '" . mysql_real_escape_string($item[11]) . "',
//          'S',
//          NOW()
//            )";
            $query = "
            CALL  
            PR_ADD_ITEM
            (
            '" . mysql_real_escape_string($primaryKey) . "',
                 '" . mysql_real_escape_string($item[0]) . "',
                     '" . mysql_real_escape_string($item[2]) . "',
                        '" . mysql_real_escape_string($item[3]) . "',
                            '" . mysql_real_escape_string($item[1]) . "',
                                '" . mysql_real_escape_string($item[4]) . "',
                                    '" . mysql_real_escape_string($item[5]) . "',
                                 '" . mysql_real_escape_string($item[6]) . "',
                             '" . mysql_real_escape_string($item[7]) . "',
                         '" . mysql_real_escape_string($item[8]) . "',
                     '" . mysql_real_escape_string($item[9]) . "',
                  '" . mysql_real_escape_string($item[10]) . "',
            '" . mysql_real_escape_string($item[11]) . "',
          'S',
          @RESPONSE
            )";
            $this->db->execute($query);
            $result = $this->db->queryUniqueValue("SELECT @RESPONSE");
            if ($result) {
                $history['log_ref_id'] = $primaryKey;
                $history['log_user'] = session::get('user_email');
                $history['log_task'] = 'Add new item';
                $this->logHistory($history);
                return true;
            }
            return false;
        }
        return false;
    }

    function modifyItem($item_id = null, $item) {
        if (!$item_id)
            return false;
        $query = "UPDATE tbl_item_master SET
                        ITEM_CODE= '" . mysql_real_escape_string($item[0]) . "',
                        ITEM_CATEGORY_ID= '" . mysql_real_escape_string($item[2]) . "',
                        ITEM_SUB_CATEGORY_ID= '" . mysql_real_escape_string($item[3]) . "',
                        ITEM_NAME= '" . mysql_real_escape_string($item[1]) . "',
                        ITEM_STOCK_UNIT= '" . mysql_real_escape_string($item[4]) . "',
                        ITEM_RATIO= '" . mysql_real_escape_string($item[5]) . "',
                        ITEM_ISSUE_UNIT= '" . mysql_real_escape_string($item[6]) . "',
                        ITEM_RE_ORDER_LEVEL= '" . mysql_real_escape_string($item[7]) . "',
                        ITEM_NEAR_RE_ORDER_LEVEL= '" . mysql_real_escape_string($item[8]) . "',
                        ITEM_LOCATION= '" . mysql_real_escape_string($item[9]) . "',
                        ITEM_REMARK= '" . mysql_real_escape_string($item[10]) . "'
                 WHERE ITEM_ID='" . mysql_real_escape_string($item_id) . "'";
        $result = $this->db->execute($query);
        if ($result) {
            $history['log_ref_id'] = $item_id;
            $history['log_user'] = session::get('user_email');
            $history['log_task'] = 'Modify item';
            $this->logHistory($history);
            return true;
        }
        return false;
    }

    function modifyStatus($item_id = null, $ststus = null) {
        if (!$item_id OR !$ststus)
            return false;
        $query = "UPDATE tbl_item_master SET
                        ITEM_STATUS= '" . mysql_real_escape_string($ststus) . "'
                 WHERE ITEM_ID='" . mysql_real_escape_string($item_id) . "'";
        $result = $this->db->execute($query);
        if ($result) {
            $history['log_ref_id'] = $item_id;
            $history['log_user'] = session::get('user_email');
            $history['log_task'] = 'Item ' . ($ststus == 'A' ? 'Activated' : ($ststus == 'I' ? 'Inactivated' : 'Deleted'));
            $this->logHistory($history);
            return true;
        }
        return false;
    }

    function modifyMode($item_id = null, $ststus = null) {
        if (!$item_id OR !$ststus)
            return false;
        $query = "UPDATE tbl_item_master SET
                        ITEM_MODE= '" . mysql_real_escape_string($ststus) . "'
                 WHERE ITEM_ID='" . mysql_real_escape_string($item_id) . "'";
        $result = $this->db->execute($query);
        if ($result) {
            $history['log_ref_id'] = $item_id;
            $history['log_user'] = session::get('user_email');
            $history['log_task'] = 'Item ' . ($ststus == 'P' ? 'submited' : ($ststus == 'A' ? 'accepted' : ''));
            $this->logHistory($history);
            return true;
        }
        return false;
    }

    function history($item_id) {
        $res = $this->getLogHistory($item_id);
        return $res ? $res : false;
    }

    function itemUsed($item_id) {
        if ($item_id) {
            $query = "
            SELECT 
                COUNT(ITEM_ID) 
            FROM 
                tbl_item_master 
             WHERE
                ITEM_ID IN (SELECT bi.ITEM_ID FROM tbl_batch_item bi,tbl_batch b WHERE b.BATCH_ID=bi.BATCH_ID AND b.BATCH_STATUS NOT IN ('D') AND bi.ITEM_ID='" . mysql_real_escape_string($item_id) . "')
                OR ITEM_ID IN (SELECT gi.ITEM_ID FROM tbl_grn_item gi,tbl_grn_master g WHERE g.GRN_ID=gi.GRN_ID AND  g.GRN_STATUS NOT IN ('D') AND gi.ITEM_ID='" . mysql_real_escape_string($item_id) . "') 
                OR ITEM_ID IN (SELECT pi.ITEM_ID FROM tbl_product_mat_item pi,tbl_product_master p WHERE p.PRODUCT_ID=pi.PRODUCT_ID AND p.PRODUCT_STATUS NOT IN ('D') AND pi.ITEM_ID='" . mysql_real_escape_string($item_id) . "')
                OR ITEM_ID IN (SELECT ri.ITEM_ID FROM tbl_recipe_item ri,tbl_recipe_master r WHERE r.RECIPE_ID=ri.RECIPE_ID AND r.RECIPE_STATUS NOT IN ('D') AND  ri.ITEM_ID='" . mysql_real_escape_string($item_id) . "')";
            
            $result = $this->db->queryUniqueValue($query);
            return ($result ? $result : false);
        }
        return false;
    }

}

?>