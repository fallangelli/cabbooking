<?php

include '../includes/database_connection.php';
date_default_timezone_set('Asia/Calcutta');

$sel_rides = mysqli_query("select * from tbl_ride where ride_status='confirm' ");
while ($sel_data = mysqli_fetch_array($sel_rides)) {

    $date1 = date('Y-m-d H:i:s');
//echo "<br/>";
    $date2 = $sel_data['pickup_date'] . " " . $sel_data['pickuptime'];
    $diff_min = round((strtotime($date2) - strtotime($date1)) / 60, 2);

    if ($diff_min <= 60 && $diff_min >= 1) {

        //send notification of ride to users
        $sel_passenger = mysqli_fetch_array(mysqli_query("select * from tbl_user where id='" . $sel_data['passenger'] . "' "));
        $row = mysqli_fetch_array(mysqli_query("SELECT * FROM gcm_users where email='" . $sel_passenger['email'] . "' "));

        $user_regID[] = $row['gcm_regid'];
        $msg = "Your ride is on time";

        include_once '../includes/GCM.php';

        $gcm = new GCM();

        $registatoin_ids = $user_regID;
        $message = array("inform_passenger_msg" => $msg);

        $result = $gcm->send_notification($registatoin_ids, $message);


        $sel_driver = mysqli_fetch_array(mysqli_query("select * from tbl_user where id='" . $sel_data['driver'] . "' "));
        $row2 = mysqli_fetch_array(mysqli_query("SELECT * FROM gcm_users where email='" . $sel_driver['email'] . "' "));

        $driver_regID[] = $row2['gcm_regid'];
        $msg2 = "Your ride is on time";

        include_once '../includes/GCM.php';

        $gcm2 = new GCM();

        $registatoin_ids2 = $driver_regID;
        $message2 = array("inform_driver_msg" => $msg2);

        $result2 = $gcm2->send_notification($registatoin_ids2, $message2);
    }
}
?>