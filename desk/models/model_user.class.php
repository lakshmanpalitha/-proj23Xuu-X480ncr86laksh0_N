<?php

class userModel extends model {

    function getAllUsers() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_user 
            WHERE 
                USER_STATUS NOT IN ('D')
            ORDER BY 
                USER_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getEachUser($user_id = null) {
        if (!$user_id)
            return false;
        $query = "
            SELECT 
                user.USER_ID,
                user.USER_NAME,
                user.USER_EMAIL,
                user.USER_STATUS,
                (select 
                    GROUP_CONCAT((SELECT ROLE_NAME FROM tbl_role WHERE ROLE_ID=ur.ROLE_ID) SEPARATOR ', ')
                 FROM 
                    tbl_user_role_mapping ur 
                 WHERE 
                    ur.USER_ID=user.USER_ID ) as user_role 
            FROM 
                tbl_user user
            WHERE user.USER_ID='" . mysql_real_escape_string($user_id) . "'";
        $result = $this->db->queryUniqueObject($query);
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

    function modifyUser($user_id = null, $user) {
        if (!$user_id)
            return false;
        $query = "UPDATE tbl_user SET
                        USER_NAME= '" . mysql_real_escape_string($user[0]) . "',
                        USER_EMAIL= '" . mysql_real_escape_string($user[1]) . "',
                        USER_PASSWORD= '" . mysql_real_escape_string(md5($user[2])) . "',
                        USER_STATUS= '" . mysql_real_escape_string($user[3]) . "'
                 WHERE USER_ID='" . mysql_real_escape_string($user_id) . "'";
        $result = $this->db->execute($query);
        $result_2 = false;
        if ($result) {
            $del_query = "DELETE FROM tbl_user_role_mapping WHERE USER_ID='" . mysql_real_escape_string($user_id) . "'";
            $del_result = $this->db->execute($del_query);
            if ($del_result) {
                $values = null;
                foreach ($user[4] as $rol) {
                    $values.= "('" . $user_id . "','" . $rol . "'),";
                }
                $query_2 = "
                            INSERT INTO 
                            tbl_user_role_mapping
                                 VALUES " . rtrim($values, ',');
                $result_2 = $this->db->execute($query_2);
            }
            return $result_2 ? true : false;
        }
        return false;
    }

    function modifyStatus($user_id = null, $ststus = null) {
        if (!$user_id OR !$ststus)
            return false;
        $query = "UPDATE tbl_user SET
                        USER_STATUS= '" . mysql_real_escape_string($ststus) . "'
                 WHERE USER_ID='" . mysql_real_escape_string($user_id) . "'";
        $result = $this->db->execute($query);
        return $result ? true : false;
    }

}

?>