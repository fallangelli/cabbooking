<?php
/**
 * Database config variables
 */
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "root");
define("DB_DATABASE", "cabbooking");

/*
 * Google API Key
 */
define("GOOGLE_API_KEY", "PLACE YOUR KEY HERE"); // Place your Google API Server Key


$root_path = '/cabbooking/admin/'; // please replace "PATH FROM ROOT" with your path from root here. If your application is in root, leave it as /admin/
$root_path1 = '/cabbooking';// please replace "PATH FROM ROOT" with your path from root here. If your application is in root, leave it as /
$dirroot_path = $_SERVER['DOCUMENT_ROOT'] . 'cabbooking/admin/';// please replace "PATH FROM ROOT" with your path from root here. If your application is in root, leave it as /
$dirroot_path1 = $_SERVER['DOCUMENT_ROOT'] . 'cabbooking/';// please replace "PATH FROM ROOT" with your path from root here. If your application is in root, leave it as /
$host = "http://$_SERVER[HTTP_HOST]";
$completelink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$admin_mail = "contact@eprofitbooster.com";

define("PROJECT_NAME", "BookMyCab")

?>