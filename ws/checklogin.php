<?php
include('../includes/database_connection.php');
$response = array();
$uname = mysqli_real_escape_string(addslashes($_REQUEST['username']));
$pass = mysqli_real_escape_string(addslashes($_REQUEST['password']));

if ($uname != "" && $pass != "") {

    $ucount = mysqli_query("select * from tbl_user where email='$uname' and password='$pass' and status='Active' ");
    $count = mysqli_num_rows($ucount);
    $set = mysqli_fetch_object($ucount);

    if ($count == 0) {
        header('Content-type: application/json');
        $response["success"] = 0;
        echo json_encode($response);
        exit;
    } else {

        $uinfo = mysqli_query("select * from tbl_user where email='$uname' and password='$pass'  and status='Active' ");
        $res = mysqli_fetch_object($uinfo);
        $user_type = $res->usertype;
        $response["success"] = 1;
        $response["user_type"] = $user_type;
        echo json_encode($response);
        exit;
    }
}

?>