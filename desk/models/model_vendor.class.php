<?php

class vendorModel extends model {

    function getAllVendors() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_vendor ORDER BY VENDOR_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getAllActiveVendors() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_vendor
            WHERE
               VENDOR_STATUS IN ('A')
            ORDER 
                BY VENDOR_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function saveNewVendor($vendor) {
        $primaryKey = $this->primaryKeyGenarator('tbl_vendor', 'VENDOR_ID');
        if ($primaryKey) {
            $primaryKey = 'VEN' . $primaryKey;
            $query = "
            INSERT INTO 
            tbl_vendor
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                '" . mysql_real_escape_string($vendor[0]) . "',
                    '" . mysql_real_escape_string($vendor[1]) . "',
                        '" . mysql_real_escape_string($vendor[2]) . "',
                          '" . mysql_real_escape_string($vendor[3]) . "',
                    '" . mysql_real_escape_string($vendor[4]) . "',
                  '" . mysql_real_escape_string($vendor[6]) . "',
                '" . mysql_real_escape_string($vendor[5]) . "'
            )";

            $result = $this->db->execute($query);
            if ($result) {
                return $result ? true : false;
            }
        }
        return false;
    }

}

?>