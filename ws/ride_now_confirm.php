<?php

include_once '../includes/db_functions.php';

$db = new DB_Functions();
if (isset($_REQUEST["unique_id"]) && isset($_REQUEST["user_type"]) && isset($_REQUEST["confirm_reject_cab"])) {

    $unique_id = $_REQUEST["unique_id"];
    $user_type = $_REQUEST["user_type"];
    $ride_status = $_REQUEST["confirm_reject_cab"];

    $sel_stat = mysqli_fetch_object(mysqli_query("select * from tbl_ride where id='$unique_id'"));
    $stat = $sel_stat->ride_status;
    $driver_id = $sel_stat->driver;
    $passenger_id = $sel_stat->passenger;

    $sel_driver_data = mysqli_fetch_object(mysqli_query("select * from tbl_user where id='$driver_id'"));
    $driver_email = $sel_driver_data->email;

    $sel_pass_data = mysqli_fetch_object(mysqli_query("select * from tbl_user where id='$passenger_id'"));
    $user_email = $sel_pass_data->email;


    if ($stat != 'reject') {

        $update_status = "update tbl_ride set ride_status='$ride_status' where id='$unique_id' ";
        $update_status_exe = mysqli_query($update_status);

        if ($stat == 'confirm') {
            if ($ride_status == 'reject') {
                if ($user_type == 'driver') {
                    $sel_query = mysqli_query("SELECT * FROM gcm_users where email='$user_email' ");
                    $row = mysqli_fetch_array($sel_query);
                    $user_regID[] = $row['gcm_regid'];
                    $msg = "Your Booking has been Rejected by Driver ";

                    include_once '../includes/GCM.php';

                    $gcm = new GCM();

                    $registatoin_ids = $user_regID;
                    $message = array("ride_now_reject_msg" => $msg);

                    $result = $gcm->send_notification($registatoin_ids, $message);
                } else {
                    $sel_query = mysqli_query("SELECT * FROM gcm_users where email='$driver_email' ");
                    $row = mysqli_fetch_array($sel_query);
                    $driver_regID[] = $row['gcm_regid'];
                    $msg = "Your Booking has been Rejected by Passenger ";

                    include_once '../includes/GCM.php';

                    $gcm = new GCM();

                    $registatoin_ids = $driver_regID;
                    $message = array("ride_now_reject_msg" => $msg);

                    $result = $gcm->send_notification($registatoin_ids, $message);
                }
            }
        }
    }
    $response = array();
    if ($update_status_exe) {
        $response['success'] = '1';
        $response['status'] = "$ride_status";
        $response['user_type'] = "$user_type";
        echo json_encode($response);
    } else {
        $response['success'] = '0';
        $response['status'] = "$ride_status";
        $response['user_type'] = "$user_type";
        echo json_encode($response);
    }

    //entries in payment table
    $sel_values = mysqli_query("select * from tbl_ride where id='$unique_id' and ride_status='confirm' ");
    $sel_count = mysqli_num_rows($sel_values);
    if ($sel_count > 0) {
        $values = mysqli_fetch_array($sel_values);
        $driver_id = $values['driver'];
        $passenger_id = $values['passenger'];
        $pickup_date = $values['pickup_date'];
        $pickuptime = $values['pickuptime'];
        $pickup_address = $values['pickup_address'];
        $dropoff_address = $values['dropoff_address'];
        $distance = $values['distance'];
        $cab_number = $values['cab_number'];

        $sel_pay_values = mysqli_query("select * from tbl_payments where passenger_id='$passenger_id' and driver_id='$driver_id' and pickup_date='$pickup_date' and pickup_time='$pickuptime'");
        $count = mysqli_num_rows($sel_pay_values);
        if ($count == 0) {
            $ins_pay = "insert into tbl_payments (`passenger_id`,`driver_id`,`pickup_date`,`pickup_time`,`pickup_address`,`dropoff_address`,`distance`,`cab_number`,`status`) "
                . "values ('$passenger_id','$driver_id','$pickup_date','$pickuptime','$pickup_address','$dropoff_address','$distance','$cab_number','pending')";
            mysqli_query($ins_pay);
        }
    }
}
?>