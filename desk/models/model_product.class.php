<?php

class productModel extends model {

    function getAllProduct() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_product_master pm,
                tbl_unit u
             WHERE
                pm.PRODUCT_MODE NOT IN ('D')
                AND u.UNIT_CODE=pm.UNIT_CODE";

        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getAllActiveProduct() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_product_master pm,
                tbl_unit u
             WHERE
                pm.PRODUCT_MODE NOT IN ('D')
                AND pm.PRODUCT_STATUS IN ('A')
                AND u.UNIT_CODE=pm.UNIT_CODE";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getSelectProduct($product_id) {
        if (empty($product_id))
            return false;
        $query = "
            SELECT 
                * 
            FROM 
                tbl_product_master pm,
                tbl_unit u
             WHERE
                pm.PRODUCT_ID='" . mysql_real_escape_string($product_id) . "'
                AND pm.PRODUCT_MODE NOT IN ('D')
                AND pm.PRODUCT_STATUS IN ('A')
                AND u.UNIT_CODE=pm.UNIT_CODE";
        $result = $this->db->queryUniqueObject($query);
        return ($result ? $result : false);
    }

    function getRecipeSelectProduct($product_id) {
        $query = "
            SELECT 
                pr.RECIPE_ID,
                rm.RECIPE_NAME,
                pr.PRODUCT_RECIPE_REMARK
            FROM 
                tbl_product_recipe pr,
                tbl_recipe_master rm
             WHERE
                pr.PRODUCT_ID ='" . mysql_real_escape_string($product_id) . "'
                AND pr.RECIPE_ID=rm.RECIPE_ID";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getRecipeSelectMaterial($product_id) {
        $query = "
            SELECT 
                pm.ITEM_ID,
                im.ITEM_NAME,
                pm.PRODUCT_ITEM_QUANTITY
            FROM 
                tbl_product_mat_item pm,
                tbl_item_master im
             WHERE
                pm.PRODUCT_ID ='" . mysql_real_escape_string($product_id) . "'
                AND pm.ITEM_ID=im.ITEM_ID";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getProductUnit($product_id) {
        $query = "
            SELECT 
                u.UNIT_NAME 
            FROM 
                tbl_unit u,
                tbl_product_master pm
             WHERE
                pm.PRODUCT_ID='" . mysql_real_escape_string($product_id) . "'
                AND pm.UNIT_CODE=u.UNIT_CODE";
        $result = $this->db->queryUniqueValue($query);
        return ($result ? $result : false);
    }

    function saveNewProduct($product) {
        $primaryKey = $this->primaryKeyGenarator('tbl_product_master', 'PRODUCT_ID');
        if ($primaryKey) {
            $primaryKey = 'PRO' . $primaryKey;
            $query = "
            INSERT INTO 
            tbl_product_master
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                 '" . mysql_real_escape_string($product[0]) . "',
                        NOW(),
                        '" . mysql_real_escape_string($product[2]) . "',
                            '" . mysql_real_escape_string($product[1]) . "',
                             '" . session::get('user_email') . "',                  
                        'S',
                     '" . $product[5] . "',                  
                  '" . $product[6] . "'                  

            )";
            $result = $this->db->execute($query);
            if ($result) {
                $result_2 = true;
                if (!empty($product[3])) {
                    $values = null;
                    foreach ($product[3] as $items) {
                        $values.= "(
                        '" . $primaryKey . "',
                            '" . $items->item_id . "',
                             '" . $items->item_qty . "'
                         ),";
                    }
                    $result_2 = false;
                    if ($values) {
                        $query_2 = "
                            INSERT INTO 
                            tbl_product_mat_item
                                 VALUES " . rtrim($values, ',');
                        $result_2 = $this->db->execute($query_2);
                    }
                }

                $values_2 = null;
                foreach ($product[4] as $recipe) {
                    $values_2.= "(
                        '" . $primaryKey . "',
                            '" . $recipe->recipe_id . "',
                             '" . $recipe->recipe_remark . "'
                         ),";
                }
                $result_3 = false;
                if ($values_2) {
                    $query_3 = "
                            INSERT INTO 
                            tbl_product_recipe
                                 VALUES " . rtrim($values_2, ',');
                    $result_3 = $this->db->execute($query_3);
                }

                return ($result_2 && $result_3) ? true : false;
            }
        }
        return false;
    }

    function modifyProduct($product_id = null, $product) {
        if (!$product_id)
            return false;
        $query = "UPDATE tbl_product_master SET
                        PRODUCT_NAME= '" . mysql_real_escape_string($product[0]) . "',
                        PRODUCT_CREATE_DATE= NOW(),
                        PRODUCT_REMARK= '" . mysql_real_escape_string($product[2]) . "',  
                        PRODUCT_CREATE_BY= '" . mysql_real_escape_string(session::get('user_email')) . "',  
                        PRODUCT_QUANTITY= '" . mysql_real_escape_string($product[5]) . "',  
                        UNIT_CODE= '" . mysql_real_escape_string($product[6]) . "'
                 WHERE PRODUCT_ID='" . mysql_real_escape_string($product_id) . "'";
        $result = $this->db->execute($query);
        if ($result) {
            $del_query = "DELETE FROM tbl_product_mat_item WHERE PRODUCT_ID='" . mysql_real_escape_string($product_id) . "'";
            $del_result = $this->db->execute($del_query);

            $del_query_rec = "DELETE FROM tbl_product_recipe WHERE PRODUCT_ID='" . mysql_real_escape_string($product_id) . "'";
            $del_result_rec = $this->db->execute($del_query_rec);
            if ($del_result && $del_result_rec) {
                $result_2 = true;
                if (!empty($product[3])) {
                    $values = null;
                    foreach ($product[3] as $items) {
                        $values.= "(
                        '" . $product_id . "',
                            '" . $items->item_id . "',
                             '" . $items->item_qty . "',
                                  '" . $items->item_remark . "'
                         ),";
                    }
                    $result_2 = false;
                    if ($values) {
                        $query_2 = "
                            INSERT INTO 
                            tbl_product_mat_item
                                 VALUES " . rtrim($values, ',');
                        $result_2 = $this->db->execute($query_2);
                    }
                }

                $values_2 = null;
                foreach ($product[4] as $recipe) {
                    $values_2.= "(
                        '" . $product_id . "',
                            '" . $recipe->recipe_id . "',
                             '" . $recipe->recipe_remark . "'
                         ),";
                }
                $result_3 = false;
                if ($values_2) {
                    $query_3 = "
                            INSERT INTO 
                            tbl_product_recipe
                                 VALUES " . rtrim($values_2, ',');
                    $result_3 = $this->db->execute($query_3);
                }

                return ($result_2 && $result_3) ? true : false;
            }
        }
        return false;
    }

}

?>