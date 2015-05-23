<?php

class loginModel extends model {

    function login($userEmail = null, $userPassword = null) {
        if (!$userEmail || !$userPassword)
            return false;

        $res = true;

        $query = "
            SELECT 
                * 
            FROM 
                tbl_users 
            WHERE 
                user_email='" . mysql_real_escape_string($userEmail) . "' 
                AND user_password='" . md5($userPassword) . "'
                AND user_status NOT IN('D')";

        $user = $this->db->queryUniqueObject($query);


        if (empty($user)) {
            $res = FEEDBACK_FIELD_NOT_VALID;
            return $res;
        }
        if ($user->user_sataus === 'I') {
            $res = FEEDBACK_FIELD_USER_INACTIVE;
            return $res;
        }
        session::set('user_logged_in', true);
        session::set('user_email', $user->user_email);
        session::set('user_type', $user->user_type);
        session::set('user_id', $user->user_id);
        session::set('user_last_log', $user->user_last_log);

        $updateQuery = "
            UPDATE 
                tbl_sys_users 
            SET
                user_last_log='" . date("Y-m-d H:i:s") . "'
            WHERE
                user_id='" . $user->user_id . "'";
        $result = $this->db->execute($updateQuery);
        return $res;
    }

}

?>