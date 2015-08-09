<?php

class recipeModel extends model {

    function getAllRecipe() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_recipe_master
             WHERE
                RECIPE_STATUS NOT IN ('D')";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getAllActiveRecipe() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_recipe_master
             WHERE
                RECIPE_MODE IN ('A')
                AND RECIPE_STATUS IN ('A')";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getSpecificRecipe($recipe_id) {
        if (empty($recipe_id))
            return false;
        $query = "
            SELECT 
                * 
            FROM 
                tbl_recipe_master
             WHERE
                RECIPE_ID='" . mysql_real_escape_string($recipe_id) . "'
                AND RECIPE_MODE NOT IN ('D')";
        $result = $this->db->queryUniqueObject($query);
        return ($result ? $result : false);
    }

    function getItemsSpecificrecipe($recipe_id) {
        if (empty($recipe_id))
            return false;
        $query = "
            SELECT 
                im.ITEM_NAME, 
                ri.ITEM_ID, 
                ri.RECIPE_ITEM_QUANTITY, 
                ri.RECIPE_ITEM_REMARK,
                (SELECT UNIT_NAME FROM tbl_unit WHERE UNIT_CODE=im.ITEM_STOCK_UNIT) AS UNIT_NAME
            FROM 
                tbl_recipe_item ri, 
                tbl_item_master im 
            WHERE 
                ri.RECIPE_ID='" . mysql_real_escape_string($recipe_id) . "'  
                AND ri.ITEM_ID=im.ITEM_ID";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function saveNewRecipe($recipe) {
        $primaryKey = $this->primaryKeyGenarator('tbl_recipe_master', 'RECIPE_ID');
        if ($primaryKey) {
            $primaryKey = 'REC' . $primaryKey;
            $query = "
            INSERT INTO 
            tbl_recipe_master
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                 '" . mysql_real_escape_string($recipe[0]) . "',
                     '" . mysql_real_escape_string(session::get('user_email')) . "',
                        NOW(),
                            '" . mysql_real_escape_string($recipe[2]) . "',
                                '" . mysql_real_escape_string($recipe[1]) . "',                            
                        'S'             
            )";
            $result = $this->db->execute($query);
            if ($result) {
                $history['log_ref_id'] = $primaryKey;
                $history['log_user'] = session::get('user_email');
                $history['log_task'] = 'Add new recipe';
                $this->logHistory($history);
                $values = null;
                foreach ($recipe[3] as $items) {
                    $values.= "(
                        '" . $primaryKey . "',
                            '" . $items->item_id . "',
                                '" . $items->item_qty . "',
                         '" . $items->item_remark . "'),";
                }
                $query_2 = "
                            INSERT INTO 
                            tbl_recipe_item
                                 VALUES " . rtrim($values, ',');

                $result_2 = $this->db->execute($query_2);
                return $result_2 ? true : false;
            }
        }
        return false;
    }

    function modifyRecipe($recipe_id = null, $recipe) {
        if (!$recipe_id)
            return false;
        $query = "UPDATE tbl_recipe_master SET
                        RECIPE_NAME= '" . mysql_real_escape_string($recipe[0]) . "',
                        RECIPE_CREATE_BY= '" . mysql_real_escape_string(session::get('user_email')) . "',
                        RECIPE_CREATE_DATE= NOW(),  
                        RECIPE_REMARK= '" . mysql_real_escape_string($recipe[2]) . "'
                 WHERE RECIPE_ID='" . mysql_real_escape_string($recipe_id) . "'";
        $result = $this->db->execute($query);
        if ($result) {
            $history['log_ref_id'] = $recipe_id;
            $history['log_user'] = session::get('user_email');
            $history['log_task'] = 'Modify recipe';
            $this->logHistory($history);
            $del_query = "DELETE FROM tbl_recipe_item WHERE RECIPE_ID='" . mysql_real_escape_string($recipe_id) . "'";
            $del_result = $this->db->execute($del_query);
            if ($del_result) {
                $values = null;
                foreach ($recipe[3] as $items) {
                    $values.= "(
                        '" . $recipe_id . "',
                            '" . $items->item_id . "',
                                '" . $items->item_qty . "',
                         '" . $items->item_remark . "'),";
                }
                $query_2 = "
                            INSERT INTO 
                            tbl_recipe_item
                                 VALUES " . rtrim($values, ',');

                $result_2 = $this->db->execute($query_2);
                return $result_2 ? true : false;
            }
        }
        return false;
    }

    function modifyStatus($recipe_id = null, $ststus = null) {
        if (!$recipe_id OR !$ststus)
            return false;
        $query = "UPDATE tbl_recipe_master SET
                        RECIPE_STATUS= '" . mysql_real_escape_string($ststus) . "'
                 WHERE RECIPE_ID='" . mysql_real_escape_string($recipe_id) . "'";
        $result = $this->db->execute($query);
        if ($result) {
            $history['log_ref_id'] = $recipe_id;
            $history['log_user'] = session::get('user_email');
            $history['log_task'] = 'Recipe ' . ($ststus == 'A' ? 'Activated' : ($ststus == 'I' ? 'Inactivated' : 'Deleted'));
            $this->logHistory($history);
            return true;
        }
        return false;
    }

    function modifyMode($recipe_id = null, $ststus = null) {
        if (!$recipe_id OR !$ststus)
            return false;
        $query = "UPDATE tbl_recipe_master SET
                        RECIPE_MODE= '" . mysql_real_escape_string($ststus) . "'
                 WHERE RECIPE_ID='" . mysql_real_escape_string($recipe_id) . "'";
        $result = $this->db->execute($query);
        if ($result) {
            $history['log_ref_id'] = $recipe_id;
            $history['log_user'] = session::get('user_email');
            $history['log_task'] = 'Recipe ' . ($ststus == 'P' ? 'submited' : ($ststus == 'A' ? 'accepted' : ''));
            $this->logHistory($history);
            return true;
        }
        return false;
    }

    function history($grn_id) {
        $res = $this->getLogHistory($grn_id);
        return $res ? $res : false;
    }

    function recipeUsed($recipe_id) {
        if ($recipe_id) {
            $query = "
            SELECT 
                COUNT(pr.RECIPE_ID) 
            FROM 
                tbl_product_recipe pr,
                tbl_product_master pm
             WHERE
                pr.RECIPE_ID='" . mysql_real_escape_string($recipe_id) . "'
                AND pm.PRODUCT_ID=pr.PRODUCT_ID
                AND pm.PRODUCT_STATUS NOT IN ('D')";
            $result = $this->db->queryUniqueValue($query);
            return ($result ? $result : false);
        }
    }

}

?>