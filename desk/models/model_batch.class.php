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
                bch.BATCH_STATUS NOT IN ('D')
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
                AND bch.BATCH_STATUS NOT IN ('D')
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
                bi.BATCH_ITEM_REMARK,
               (SELECT UNIT_NAME FROM tbl_unit WHERE UNIT_CODE=im.ITEM_ISSUE_UNIT) AS UNIT_NAME
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
                        '" . session::get('user_email') . "',
                            '" . mysql_real_escape_string($batch[7]) . "'
            )";
            $result = $this->db->execute($query);
            if ($result) {
                $history['log_ref_id'] = $primaryKey;
                $history['log_user'] = session::get('user_email');
                $history['log_task'] = 'Add new batch';
                $this->logHistory($history);
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

    function modifyBatch($batch_id = null, $batch) {
        if (!$batch_id)
            return false;
        $query = "UPDATE tbl_batch SET
                        BATCH_CODE= '" . mysql_real_escape_string($batch[0]) . "',
                        BATCH_NAME= '" . mysql_real_escape_string($batch[2]) . "',
                        PRODUCT_ID= '" . mysql_real_escape_string($batch[3]) . "',  
                        BATCH_QUANTITY= '" . mysql_real_escape_string($batch[4]) . "',  
                        BATCH_REMARK= '" . mysql_real_escape_string($batch[5]) . "',  
                        BATCH_CREATE_BY= '" . mysql_real_escape_string(session::get('user_email')) . "', 
                        BATCH_EXPIRE_DATE= '" . mysql_real_escape_string($batch[7]) . "',
                        BATCH_CREATE_DATE= NOW()
                 WHERE BATCH_ID='" . mysql_real_escape_string($batch_id) . "'";
        $result = $this->db->execute($query);
        if ($result) {
            $history['log_ref_id'] = $batch_id;
            $history['log_user'] = session::get('user_email');
            $history['log_task'] = 'Modify batch';
            $this->logHistory($history);
            $del_query = "DELETE FROM tbl_batch_item WHERE BATCH_ID='" . mysql_real_escape_string($batch_id) . "'";
            $del_result = $this->db->execute($del_query);
            if ($del_result) {
                $result_2 = true;
                if (!empty($batch[6])) {
                    $values = null;
                    foreach ($batch[6] as $items) {
                        $values.= "(
                        '" . $batch_id . "',
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

    function modifyStatus($batch_id = null, $ststus = null) {
        if (!$batch_id OR !$ststus)
            return false;
        $query = "UPDATE tbl_batch SET
                        BATCH_STATUS= '" . mysql_real_escape_string($ststus) . "'
                 WHERE BATCH_ID='" . mysql_real_escape_string($batch_id) . "'";
        $result = $this->db->execute($query);
        if ($result) {
            $history['log_ref_id'] = $batch_id;
            $history['log_user'] = session::get('user_email');
            $history['log_task'] = 'Batch ' . ($ststus == 'A' ? 'Activated' : ($ststus == 'I' ? 'Inactivated' : 'Deleted'));
            $this->logHistory($history);
            return true;
        }
        return false;
    }

    function modifyMode($batch_id = null, $ststus = null) {
        if (!$batch_id OR !$ststus)
            return false;
//        $query = "UPDATE tbl_batch SET
//                        BATCH_MODE= '" . mysql_real_escape_string($ststus) . "'
//                 WHERE BATCH_ID='" . mysql_real_escape_string($batch_id) . "'";
//        $result = $this->db->execute($query);

        $query = " CALL  
            PR_MODIFY_BATCH_STATUS('" . mysql_real_escape_string($batch_id) . "','" . mysql_real_escape_string($ststus) . "',@RESPONSE)";
        $this->db->execute($query);
        $result = $this->db->queryUniqueValue("SELECT @RESPONSE");
        if ($result) {
            $history['log_ref_id'] = $batch_id;
            $history['log_user'] = session::get('user_email');
            $history['log_task'] = 'Batch ' . ($ststus == 'P' ? 'submited' : ($ststus == 'A' ? 'accepted' : ''));
            $this->logHistory($history);
            return true;
        }
        return false;
    }

    function history($batch_id) {
        $res = $this->getLogHistory($batch_id);
        return $res ? $res : false;
    }

}

?>