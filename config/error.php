<?php

/*
 * login
 */
define("FEEDBACK_FIELD_NOT_VALID_TYPE", "User email or password not valid!");
define("FEEDBACK_FIELD_NOT_VALID", "Incorrect user email or password!");
define("FEEDBACK_FIELD_USER_INACTIVE", "Your account temprely deactivated,Please contact system admin");

/**
 * Configuration for: Error messages and notices
 */
define("FEEDBACK_FIELD_REQUIRED", "is required field");
define("FEEDBACK_INT_VALIDATION", "is not valid number!");
define("FEEDBACK_STRING_VALIDATION", "is not valid string!");
define("FEEDBACK_NUMERIC_VALIDATION", "is not valid numeric!");
define("FEEDBACK_EMAIL_VALIDATION", "is not valid email!");
define("FEEDBACK_DECIMAL_VALIDATION", "is not valid decimal number!");
define("FEEDBACK_DATE_VALIDATION", "is not valid date");
define("FEEDBACK_LENGTH_VALIDATION", "is exced max length");
define("FEEDBACK_MAX_LENGTH", "(max charcter length should be )");

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

/*
 * image upload
 */
define("FEEDBACK_IMAGE_TYPE_ERROR", "Image not valid image type. Image type should be 'jpg', 'jpeg', 'png' or 'gif'");
define("FEEDBACK_IMAGE_SIZE_ERROR", "Image exceed max upload size.Image size should be less than " . MAX_UPLOAD_SIZE);
define("FEEDBACK_ORI_IMAGE_UPLOAD_PARH_ERROR", "Original image upload path error");
define("FEEDBACK_THUMB_IMAGE_UPLOAD_PARH_ERROR", "Thumb image upload path error");
define("FEEDBACK_MEDIUM_IMAGE_UPLOAD_PARH_ERROR", "Medium image upload path error");
define("FEEDBACK_IMG_UPLOAD_FAIL", " is successfully added,image upload failed!");
?>