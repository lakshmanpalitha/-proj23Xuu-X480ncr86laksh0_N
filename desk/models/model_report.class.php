<?php

class reportModel extends model {

    function itemStockCount() {
        $query = "
            SELECT 
                im.ITEM_ID,
                im.ITEM_CODE,
                im.ITEM_CATEGORY_ID,
                (SELECT ITEM_CAT_NAME FROM tbl_item_category WHERE ITEM_CAT_ID=im.ITEM_CATEGORY_ID) AS CAT_NAME, 
                im.ITEM_SUB_CATEGORY_ID,
                (SELECT ITEM_SUB_CAT_NAME FROM tbl_item_sub_category WHERE ITEM_SUB_CAT_ID=im.ITEM_SUB_CATEGORY_ID) AS SUB_CAT_NAME, 
                im.ITEM_NAME,
                im.ITEM_STOCK_UNIT,
                (SELECT UNIT_NAME FROM tbl_unit WHERE UNIT_CODE=im.ITEM_STOCK_UNIT) AS UNIT_NAME, 
                im.ITEM_LOCATION,
                im.ITEM_RE_ORDER_LEVEL,
                im.ITEM_NEAR_RE_ORDER_LEVEL,
                (SELECT STOCK_QUANTITY FROM tbl_stock WHERE ITEM_ID=im.ITEM_ID) AS QUANTITY 
            FROM 
                tbl_item_master im
            WHERE
                im.ITEM_STATUS NOT IN ('D')
            ORDER BY 
                im.ITEM_ADD_DATE";
        $result = $this->db->queryMultipleObjects($query);
        return ($result ? $result : false);
    }

}

?>