<?php

class userModel extends model {

    function getAllUsers() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_user ORDER BY USER_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function saveNewUser($user) {
        $primaryKey = $this->primaryKeyGenarator('tbl_user', 'USER_ID');
        if ($primaryKey) {
            $primaryKey = 'USR' . $primaryKey;
            $query = "
            INSERT INTO 
            tbl_user
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                '" . mysql_real_escape_string($user[0]) . "',
                    '" . mysql_real_escape_string($user[1]) . "',
                        '" . mysql_real_escape_string(md5($user[2])) . "',
                         '',
                       '',
                    '" . mysql_real_escape_string($user[3]) . "',
                  ''
            )";

            $result = $this->db->execute($query);
            if ($result) {
                $values = null;
                foreach ($user[4] as $rol) {
                    $values.= "('" . $primaryKey . "','" . $rol . "'),";
                }
                $query_2 = "
                            INSERT INTO 
                            tbl_user_role_mapping
                                 VALUES " . rtrim($values, ',');
                $result_2 = $this->db->execute($query_2);
                return $result_2 ? true : false;
            }
        }
        return false;
    }

}

?>