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

}

?>