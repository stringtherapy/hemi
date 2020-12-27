<?php
$match = '';

$search1="SELECT * FROM private_servers WHERE lobby_key='$key'";
$search2="SELECT * FROM private_servers WHERE password='$password'";


$result1 = mysqli_query($conn, $search1);
$result2 = mysqli_query($conn, $search2);


if(mysqli_num_rows($result1) == 1 AND mysqli_num_rows($result2) == 1) {

$row1 = mysqli_fetch_array($result1);
$row2 = mysqli_fetch_array($result2);

if($row1['ID']==$row2['ID']){
	$match = "YES";  //success password match
} else $match = "no"; //wrong password; 
} else $match = "no"; //no records found;
?>