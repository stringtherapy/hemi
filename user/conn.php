<?php
//enter the four strings to establish connection with your database
$conn=mysqli_connect("hostname","username","password","databasename","portnumber_without_quotations");

if (!$conn)
{
	die("not connected".mysqli_error($conn));
}

// define any timezone you want. check php manual for the exact names allowed: https://www.php.net/manual/en/timezones.php
date_default_timezone_set("Asia/Kolkata");
?>
