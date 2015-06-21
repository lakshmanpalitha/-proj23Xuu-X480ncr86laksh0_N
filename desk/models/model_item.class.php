<?php

class itemModel extends model {

    function getAllUnit() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_unit 
            ORDER BY 
                UNIT_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getAllActiveUnit() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_unit 
            WHERE
                UNIT_STATUS='A'
            ORDER BY 
                UNIT_NAME DESC";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getAllItem() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_item_master
            WHERE
                ITEM_MODE NOT IN ('D')
            ORDER BY 
                ITEM_ADD_DATE";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getAllActiveItem() {
        $query = "
            SELECT 
                * 
            FROM 
                tbl_item_master 
             WHERE
                ITEM_MODE NOT IN ('D')
                AND ITEM_STATUS IN ('A')
            ORDER BY 
                ITEM_NAME";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

    function getItemStockUnit($itemId) {
        $query = "
            SELECT 
                u.UNIT_NAME 
            FROM 
                tbl_unit u,
                tbl_item_master im
             WHERE
                im.ITEM_ID='" . mysql_real_escape_string($itemId) . "'
                AND im.ITEM_STOCK_UNIT=u.UNIT_CODE";
        $result = $this->db->queryUniqueValue($query);
        return ($result ? $result : false);
    }

    function saveNewItem($item) {
        $primaryKey = $this->primaryKeyGenarator('tbl_item_master', 'ITEM_ID');
        if ($primaryKey) {
            $primaryKey = 'ITM' . $primaryKey;
            $query = "
            INSERT INTO 
            tbl_item_master
            VALUES(
            '" . mysql_real_escape_string($primaryKey) . "',
                 '" . mysql_real_escape_string($item[0]) . "',
                     '" . mysql_real_escape_string($item[2]) . "',
                        '" . mysql_real_escape_string($item[3]) . "',
                            '" . mysql_real_escape_string($item[1]) . "',
                                '" . mysql_real_escape_string($item[4]) . "',
                                    '" . mysql_real_escape_string($item[5]) . "',
                                 '" . mysql_real_escape_string($item[6]) . "',
                             '" . mysql_real_escape_string($item[7]) . "',
                         '" . mysql_real_escape_string($item[8]) . "',
                     '" . mysql_real_escape_string($item[9]) . "',
                  '" . mysql_real_escape_string($item[10]) . "',
            '" . mysql_real_escape_string($item[11]) . "',
          'S',
          NOW()
            )";
            $result = $this->db->execute($query);
            return $result ? true : false;
        }
        return false;
    }

}

?>