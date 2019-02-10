<?php

$servername = "sql1.njit.edu";
$username   = "ah366";
$password   = "2TzsfCRFN";
$dbname     = "ah366";

include("myFunctions.php");
include("checkPatron.php");

$db = mysqli_connect($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $cdb->connect_error);
}

$option   = $_GET["patronTransaction"];
$bookName = $_GET["bookName"];


if ($option == "view") {
    echo "<br>Here is your data:<br>";
    viewRecords($patronCardNumber);
}

else if ($option == "search") {
    echo "<br>Here is the result for the book you searched for:<br>";
    searchBook($bookName);
}

else if ($option == "return") {
    echo "<br>The following book has been returned:<br>";
    returnBook($bookName);
}

else if ($option == "create") {
    echo "<br>Here is the show output<br>";
    create($patronCardNumber, $patronName, $patronEmail);
}

$db->close();
?>