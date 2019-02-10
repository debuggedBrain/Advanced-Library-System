<?php

$servername = "sql1.njit.edu";
$username   = "ah366";
$password   = "2TzsfCRFN";
$dbname     = "ah366";

include("myFunctions.php");
include("doFunction.php");

$db = mysqli_connect($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $cdb->connect_error);
}

$patronName       = $_GET["patronName"];
$patronCardNumber = $_GET["patronCardNumber"];

$found = '1';
if (validate($patronName, $patronCardNumber)) {
    $found = '0';
    return $found;
}

$db->close();

?>