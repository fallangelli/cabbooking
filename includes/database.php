<?php
include_once "config.php";

session_start();
ob_start();
error_reporting(E_ALL ^ E_NOTICE);

function admin_redirect()
{
    if ($_SESSION['admin_username'] == "") {
        header("location:index.php");
    }
}

function connect_db()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
    if (!$link)
        echo "FAILD!连接错误";
    else {
        $GLOBALS['dbcon'] = $link;
        mysqli_select_db($GLOBALS['dbcon'], DB_DATABASE) or die('Could not Select Database' . mysqli_error($link));
    }
}

function db_query($query, $dbcon2 = null)
{
    if ($dbcon2 == '') {
        if (!isset($GLOBALS['dbcon'])) {
            connect_db();
        }
        $dbcon2 = $GLOBALS['dbcon'];
    }
    $result = mysqli_query($dbcon2, $query) or die(db_error($query));

    return $result;
}

function fetch($results)
{
    $row = mysqli_fetch_array($results);
    return $row;
}

function insert($data, $table)
{
    $li = sizeof($data);
    $saperator = "";
    $str_field = "";
    $str_data = "";
    $result = "0";
    for ($i = 0; $i < $li; $i++) {
        $str_field .= $saperator . $data[$i]["field"];
        $str_data .= $saperator . "'" . $data[$i]["value"] . "'";
        $saperator = ",";
    }
    $str = "INSERT INTO $table($str_field)VALUES($str_data)";
    try {
        $result = query_exec($str);
    } catch (Exception $e) {

    }
    return mysqli_affected_rows();
}

function update($data, $condition, $table)
{
    $li = sizeof($data);
    $saperator = "";
    $str_field = "SET ";
    $str_data = "";
    $result = "0";
    if ($condition != "")
        $condition = "WHERE " . $condition;
    for ($i = 0; $i < $li; $i++) {
        $str_field .= "$saperator" . $data[$i]['field'] . "='" . $data[$i]['value'] . "'";
        $saperator = ",";
    }
    $str = "UPDATE $table $str_field $condition";
    try {
        $result = query_exec($str);
    } catch (Exception $e) {

    }
    return mysqli_affected_rows();
}

function select($data, $condition, $table)
{
    if ($condition != "")
        $condition = "WHERE " . $condition;
    $str = "SELECT $data FROM $table $condition";
    try {
        $result = query_exec($str);
        $rows = array();
        while ($row = mysqli_fetch_array($result)) {
            $rows[] = $row;
        }
    } catch (Exception $e) {
        return $e;
    }
    return $rows;
}


function query_exec_no($fetch_data)
{
    $total_record = mysqli_num_rows($fetch_data);
    return $total_record;
}


function real_escape_string($str, $dbcon2 = null)
{
    if ($dbcon2 == '') {
        if (!isset($GLOBALS['dbcon'])) {
            connect_db();
        }
        $dbcon2 = $GLOBALS['dbcon'];
    }
    $result = mysqli_real_escape_string($dbcon2, $str) or die(db_error($str));

    return $result;
}


?>