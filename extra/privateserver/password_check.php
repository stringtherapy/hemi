<?php
$match = '';

$search2="SELECT * FROM private_servers WHERE lobby_key='$key'";
$result2 = mysqli_query($conn, $search2);

if(mysqli_num_rows($result2) !== 1) {
 echo "no table with name ". $key." found";
} else {
$row2 = mysqli_fetch_array($result2);
if($row2['password']==$password){
	$match = "YES";  
	$ID = $row1['ID'];
} //else echo "password dont match "; 
} 
?>
