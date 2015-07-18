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

    function getEachVendor($vendor_id = null) {
        if (!$vendor_id)
            return false;
        $query = "
            SELECT 
                * 
            FROM 
                tbl_vendor
            WHERE
               VENDOR_ID= '" . mysql_real_escape_string($vendor_id) . "'
            ORDER 
                BY VENDOR_NAME DESC";
        $result = $this->db->queryUniqueObject($query);
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

    function modifyVendor($vendor_id = null, $vendor) {
        if (!$vendor_id)
            return false;
        $query = "UPDATE tbl_vendor SET
                        VENDOR_NAME= '" . mysql_real_escape_string($vendor[0]) . "',
                        VENDOR_EMAIL= '" . mysql_real_escape_string($vendor[1]) . "',
                        VENDOR_ADDRESS= '" . mysql_real_escape_string($vendor[2]) . "',
                        VENDOR_CONTACT_NO= '" . mysql_real_escape_string($vendor[3]) . "',
                        VENDOR_TYPE= '" . mysql_real_escape_string($vendor[4]) . "',
                        VENDOR_REMARK= '" . mysql_real_escape_string($vendor[6]) . "',
                        VENDOR_STATUS= '" . mysql_real_escape_string($vendor[5]) . "'
                 WHERE VENDOR_ID='" . mysql_real_escape_string($vendor_id) . "'";
        $result = $this->db->execute($query);
        return $result ? true : false;
    }

}

?>