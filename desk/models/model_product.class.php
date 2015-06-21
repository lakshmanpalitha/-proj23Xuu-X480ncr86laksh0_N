<?php

class productModel extends model {

    function getAllProduct() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_product_master
             WHERE
                PRODUCT_MODE NOT IN ('D')";
        $result = $this->db->queryMultipleObjects($query);
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
                        'S'                                          
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

}

?>