<?php
//enter the values to establish connection with your server
$servername    = "localhost";
$username      = "root";
$password      = "";
$databasename  = "dbname";
$portnumber    =  3306;

$conn=mysqli_connect($servername,$username,$password,$dbname,$portnumber);

if (!$conn)
{
	die("not connected".mysqli_error($conn));
}

// define any timezone you want. check php manual for the exact names allowed: https://www.php.net/manual/en/timezones.php
date_default_timezone_set("UTC");
?>
