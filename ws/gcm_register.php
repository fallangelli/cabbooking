<?php

// response json
$json = array();

/**
 * Registering a user device
 * Store reg id in gcm_user table
 */
include_once '../includes/db_functions.php';
$db = new DB_Functions();
if (isset($_REQUEST["email"]) && isset($_REQUEST["regId"]) && isset($_REQUEST["user_type"])) {

    $user_type = mysqli_real_escape_string(addslashes($_REQUEST["user_type"]));
    $email = mysqli_real_escape_string(addslashes($_REQUEST["email"]));
    $gcm_regid = mysqli_real_escape_string(addslashes($_REQUEST["regId"])); // GCM Registration ID
    // Store user details in db


    $db = new DB_Functions();

    $sel = db_query("SELECT * from gcm_users WHERE email = '$email'");
    $no_of_rows = mysqli_num_rows($sel);
    if ($no_of_rows > 0) {

        $res = $db->updateDriverRegID($email, $gcm_regid, $user_type);
    } else {

        $res = $db->storeUser($email, $gcm_regid, $user_type);
    }
    //echo $success;
} else {
    echo "not getting information";
}
?>