<?php

/*
 * login
 */
define("FEEDBACK_FIELD_NOT_VALID_TYPE", "User email or password not valid!");
define("FEEDBACK_FIELD_NOT_VALID", "Incorrect user email or password!");
define("FEEDBACK_FIELD_USER_INACTIVE", "Your account temprely deactivated,Please contact system admin");

define("FEEDBACK_FIELD_REQUIRED", "is required field");
define("FEEDBACK_INT_VALIDATION", "is not valid number!");

/**
 * Configuration for: Error messages and notices
 */
define("FEEDBACK_REQUIRED_FIELDS", "Enter all required fields");
define("FEEDBACK_USER_ROLE", "User role is required!");
define("FEEDBACK_NEW_USER_PASSWORD", "Password not match!");
define("FEEDBACK_STRING_VALIDATION", "is not valid string!");
define("FEEDBACK_NUMERIC_VALIDATION", "is not valid numeric!");
define("FEEDBACK_EMAIL_VALIDATION", "is not valid email!");
define("FEEDBACK_DECIMAL_VALIDATION", "is not valid decimal number!");
define("FEEDBACK_DATE_VALIDATION", "is not valid date");
define("FEEDBACK_LENGTH_VALIDATION", "is exced max length");
define("FEEDBACK_MAX_LENGTH", "(max charcter length should be )");
define("FEEDBACK_GRN_ITEMS", "GRN items can't be empty!");
define("FEEDBACK_PRODUCT_RECIPE", "Product recipe can't be empty!");

/*
 * Shop 
 */
define("FEEDBACK_SHOP_EXIST", "New shop is allredy exist!");

/*
 * System user
 */
define("FEEDBACK_USER_EXIST", "User allredy registered!");
define("FEEDBACK_PASSWORD_MISSMATCH", "Confirm password not match to password");
/*
 * product category
 */
define("FEEDBACK_CATEGORY_EXIST", "Category allredy exist");

define("FEEDBACK_GRN_UPDATE_FAILED", "GRN allredy confirm.You haven't modify permission");
define("FEEDBACK_BATCH_UPDATE_FAILED", "Batch allredy confirm.You haven't modify permission");
define("FEEDBACK_PRODUCT_UPDATE_FAILED", "Product allredy confirm.You haven't modify permission");
define("FEEDBACK_RECIPE_UPDATE_FAILED", "Recipe allredy confirm.You haven't modify permission");
define("FEEDBACK_ITEM_UPDATE_FAILED", "Item allredy confirm.You haven't modify permission");

define("FEEDBACK_EMPTY_VENDOR_ID", "Vendoris not longer in system");
define("FEEDBACK_EMPTY_ROLE_ID", "Role not longer in system");
define("FEEDBACK_EMPTY_GRN_ID", "GRN not longer in system");
define("FEEDBACK_EMPTY_BATCH_ID", "Batch not longer in system");
define("FEEDBACK_EMPTY_RECIPE_ID", "Recipe not longer in system");
define("FEEDBACK_EMPTY_PRODUCT_ID", "Product not longer in system");
define("FEEDBACK_EMPTY_USER_ID", "User not longer in system");
define("FEEDBACK_INVALID_ACTION", "Invalid action");

define("FEEDBACK_INVALID_CATEGORY", "Invalid cayegory id");
define("FEEDBACK_INVALID_SUBCATEGORY", "Invalid sub cayegory id");

define("FEEDBACK_FAILED_DELETE_CAT", "You can't delete category,It is allredy used in item");
define("FEEDBACK_FAILED_DELETE_SUBCAT", "You can't delete sub category,It is allredy used in item");

define("FEEDBACK_ITEM_CREATE_FAILED", "Add new item failed,@OPERATION RALLBACK");
define("FEEDBACK_ITEM_GRN_MODIFY_MODE_FAILED", "Operation failed,@RALLBACK");

define("FEEDBACK_ITEM_BATCH_MODIFY_MODE_FAILED", "Operation failed,@RALLBACK");

define("FEEDBACK_BATCH_DELETE_FAILED", "Batch delete failed,You can't delete confirm batch");
define("FEEDBACK_PRODUCT_DELETE_FAILED", "Product delete failed,Selected product allredy used to batch");
define("FEEDBACK_RECIPE_DELETE_FAILED", "Recipe delete failed,Selected recipe allredy used to product");
define("FEEDBACK_GRN_DELETE_FAILED", "GRN delete failed,You can't delete confirm GRN");
define("FEEDBACK_ITEM_DELETE_FAILED", "Item delete failed,Selected item allredy used");
define("FEEDBACK_VENDOR_DELETE_FAILED", "Vendor delete failed,Vendor allredy used to GRN");

?>