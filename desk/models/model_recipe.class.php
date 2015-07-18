<?php

class recipeModel extends model {

    function getAllRecipe() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_recipe_master
             WHERE
                RECIPE_MODE NOT IN ('D')";
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
                RECIPE_MODE NOT IN ('D')
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
                ri.RECIPE_ITEM_REMARK 
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

}

?>