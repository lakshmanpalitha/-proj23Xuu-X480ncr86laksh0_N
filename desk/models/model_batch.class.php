<?php

class batchModel extends model {

    function getAllBatch() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_batch bch,
                tbl_product_master pm,
                tbl_unit u
             WHERE
                bch.BATCH_MODE NOT IN ('D')
                AND bch.PRODUCT_ID=pm.PRODUCT_ID
                AND pm.UNIT_CODE=u.UNIT_CODE";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getSelectBatch($batch_id) {
        if (empty($batch_id))
            return false;
        $query = "
            SELECT 
                * 
            FROM 
                tbl_batch bch,
                tbl_product_master pm,
                tbl_unit u
             WHERE
                bch.BATCH_ID= '" . mysql_real_escape_string($batch_id) . "'
                AND bch.BATCH_MODE NOT IN ('D')
                AND bch.PRODUCT_ID=pm.PRODUCT_ID
                AND pm.UNIT_CODE=u.UNIT_CODE";
        $result = $this->db->queryUniqueObject($query);
        return ($result ? $result : false);
    }

    function getSelectBatchMaterel($batch_id) {
        $query = "
            SELECT 
                bi.ITEM_ID,
                im.ITEM_NAME,
                bi.BATCH_ITEM_QUANTITY,
                bi.BATCH_ITEM_REMARK
            FROM 
                tbl_batch_item bi,
                tbl_item_master im
             WHERE
                bi.BATCH_ID ='" . mysql_real_escape_string($batch_id) . "'
                AND bi.ITEM_ID=im.ITEM_ID";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function saveNewBatch($batch) {
        $primaryKey = $this->primaryKeyGenarator('tbl_batch', 'BATCH_ID');
        if ($primaryKey) {
            $primaryKey = 'BCH' . $primaryKey;
            $query = "
            INSERT INTO 
            tbl_batch
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                 '" . mysql_real_escape_string($batch[0]) . "',
                     '" . mysql_real_escape_string($batch[2]) . "',
                        '" . mysql_real_escape_string($batch[3]) . "',
                            '" . mysql_real_escape_string($batch[4]) . "',
                            '" . mysql_real_escape_string($batch[5]) . "',
                            '" . mysql_real_escape_string($batch[1]) . "',
                        'S',
                        NOW(),
                        '" . session::get('user_email') . "'
            )";
            $result = $this->db->execute($query);
            if ($result) {
                $result_2 = true;
                if (!empty($batch[6])) {
                    $values = null;
                    foreach ($batch[6] as $items) {
                        $values.= "(
                        '" . $primaryKey . "',
                            '" . $items->item_id . "',
                                '" . $items->item_qty . "',
                         '" . $items->item_remark . "'),";
                    }
                    if ($values) {
                        $query_2 = "
                            INSERT INTO 
                            tbl_batch_item
                                 VALUES " . rtrim($values, ',');
                        $result_2 = $this->db->execute($query_2);
                    }
                }
                return $result_2 ? true : false;
            }
        }
        return false;
    }

}

?>