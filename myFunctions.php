<?php

$servername = "sql1.njit.edu";
$username   = "ah366";
$password   = "2TzsfCRFN";
$dbname     = "ah366";

include("doFunction.php");
include("checkPatron.php");

$db = mysqli_connect($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $cdb->connect_error);
}

mysqli_select_db($db, $dbname);

$patronName       = $_GET["patronName"];
$patronCardNumber = $_GET["patronCardNumber"];
$bookName         = $_GET["bookName"];
$patronEmail      = $_GET["patronEmail"];

function validate($patronName, $patronCardNumber)
{
    global $db;
    
    $s = "select * from patrons where name = '$patronName' and cardnum = '$patronCardNumber'";
    
    //if no rows pop up then false
    $t = mysqli_query($db, $s) or die(mysqli_error($db));
    $num = mysqli_num_rows($t);
    if ($num == 0) {
        return false;
    }
    return true;
}

function viewRecords($patronCardNumber)
{
    global $db;
    
    $s = "select * from patrons where cardnum = '$patronCardNumber'";
    $t = mysqli_query($db, $s) or die(mysqli_error($db));
    $num = mysqli_num_rows($t);
    
    if ($num == 1) {
        echo $s;
    } else {
        echo "<br>Nothing was found, sorry but you need to check your information!<br>";
    }
}

function searchBook($bookName)
{
    global $db;
    
    $s = "select * from books where booktitle = '$bookName'";
    $t = mysqli_query($db, $s) or die(mysqli_error($db));
    $num = mysqli_num_rows($t);
    
    if ($num == 1) {
        echo "<br>Yes, we have this book... here is the information on it: <br> ";
        echo $s;
    } else {
        echo "<br>Sorry but we do not have this book, we can order it though! <br>";
    }
}

function returnBook($bookName)
{
    global $db;
    
    $r = "delete from patrons where booksout = '$bookName";
    $z = mysqli_query($db, $r) or die(mysqli_error($db));
    $s = "select booksout from patrons where booksout = '$bookName'";
    $t = mysqli_query($db, $s) or die(mysqli_error($db));
    
    echo "<br>Your book has been returned, here are your books: <br> ";
    echo $s;
    
}

function create($patronCardNumber, $patronName, $patronEmail)
{
    global $db;
    
    $s = "INSERT INTO patrons(name, cardnum, email, booksout, duedate, booksorder) VALUES ($patronName,$patronCardNumber,$patronEmail,NULL,NULL,NULL)";
    $t = mysqli_query($db, $s) or die(mysqli_error($db));
    
    $a = "select * from patrons where cardnum = $patronCardNumber";
    
    echo "<br>Your information has been entered into our database, here it is:<br>";
    echo $a;
}


$db->close();

?>