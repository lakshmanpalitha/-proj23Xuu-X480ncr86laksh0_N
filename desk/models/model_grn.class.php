<?php

class grnModel extends model {

    function getAllGrn() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_grn_master grn,
                tbl_vendor vdr
             WHERE
                grn.GRN_STATUS NOT IN ('D')
                AND grn.VENDOR_ID=vdr.VENDOR_ID";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getSelectGrn($grn_id) {
        if (empty($grn_id))
            return false;
        $query = "
            SELECT 
                * 
            FROM 
                tbl_grn_master grn,
                tbl_vendor vdr
             WHERE
                grn.GRN_ID='" . mysql_real_escape_string($grn_id) . "'
                AND grn.GRN_STATUS NOT IN ('D')
                AND grn.VENDOR_ID=vdr.VENDOR_ID";
        $result = $this->db->queryUniqueObject($query);
        return ($result ? $result : false);
    }

    function getItemsSelectedGrn($grn_id = null, $item_id = null) {
        $where = '';
        if ($grn_id && $item_id) {
            $where = "gi.GRN_ID='" . mysql_real_escape_string($grn_id) . "' AND gi.ITEM_ID='" . mysql_real_escape_string($item_id) . "'";
        } else if ($grn_id) {
            $where = "gi.GRN_ID='" . mysql_real_escape_string($grn_id) . "'";
        } else if ($item_id) {
            $where = "gi.ITEM_ID='" . mysql_real_escape_string($item_id) . "'";
        } else {
            return false;
        }
        $query = "
            SELECT 
                im.ITEM_NAME, 
                gi.ITEM_ID, 
                gi.ITEM_QUANTITY, 
                gi.ITEM_AMOUNT,
                gi.ITEM_EXP_DATE,
                gi.ITEM_REMARK,
                (SELECT UNIT_NAME FROM tbl_unit WHERE UNIT_CODE=im.ITEM_STOCK_UNIT) AS UNIT_NAME
            FROM 
                tbl_grn_item gi, 
                tbl_item_master im 
            WHERE 
                " . ($where ? $where : '') . "
                AND gi.ITEM_ID=im.ITEM_ID";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function saveNewGrn($grn) {
        $primaryKey = $this->primaryKeyGenarator('tbl_grn_master', 'GRN_ID');
        if ($primaryKey) {
            $primaryKey = 'GRN' . $primaryKey;
            $query = "
            INSERT INTO 
            tbl_grn_master
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                 '" . mysql_real_escape_string($grn[0]) . "',
                     '" . mysql_real_escape_string($grn[1]) . "',
                        '" . mysql_real_escape_string($grn[2]) . "',
                            '" . mysql_real_escape_string($grn[4]) . "',
                            '" . mysql_real_escape_string($grn[3]) . "',
                        'S',
                        NOW(),
                        '" . session::get('user_email') . "'
            )";
            $result = $this->db->execute($query);
            if ($result) {
                $values = null;
                foreach ($grn[5] as $items) {
                    $values.= "(
                        '" . $primaryKey . "',
                            '" . $items->item_id . "',
                                '" . $items->item_qty . "',
                                 '" . $items->item_amt . "',
                                '" . $items->item_exp . "',
                         '" . $items->item_remark . "'),";
                }
                $query_2 = "
                            INSERT INTO 
                            tbl_grn_item
                                 VALUES " . rtrim($values, ',');
                $result_2 = $this->db->execute($query_2);
                return $result_2 ? true : false;
            }
        }
        return false;
    }

    function modifyGrn($grn_id = null, $grn) {
        if (!$grn_id)
            return false;
        $query = "UPDATE tbl_grn_master SET
                        INVOICE_ID= '" . mysql_real_escape_string($grn[0]) . "',
                        VENDOR_ID= '" . mysql_real_escape_string($grn[1]) . "',
                        INVOICE_DATE= '" . mysql_real_escape_string($grn[2]) . "',  
                        GRN_REMARK= '" . mysql_real_escape_string($grn[4]) . "',  
                        GRN_TITLE= '" . mysql_real_escape_string($grn[3]) . "',  
                        GRN_CREATE_BY= '" . mysql_real_escape_string(session::get('user_email')) . "',  
                        GRN_CREATE_DATE= NOW()
                 WHERE GRN_ID='" . mysql_real_escape_string($grn_id) . "'";
        $result = $this->db->execute($query);
        if ($result) {
            $del_query = "DELETE FROM tbl_grn_item WHERE GRN_ID='" . mysql_real_escape_string($grn_id) . "'";
            $del_result = $this->db->execute($del_query);
            if ($del_result) {
                $values = null;
                foreach ($grn[5] as $items) {
                    $values.= "(
                        '" . $grn_id . "',
                            '" . $items->item_id . "',
                                '" . $items->item_qty . "',
                                 '" . $items->item_amt . "',
                                '" . $items->item_exp . "',
                         '" . $items->item_remark . "'),";
                }
                $mod_query = "
                            INSERT INTO 
                            tbl_grn_item
                                 VALUES " . rtrim($values, ',');
                $mod_result = $this->db->execute($mod_query);
                return $mod_result ? true : false;
            }
        }
        return false;
    }

}

?>