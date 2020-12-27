<?php
$match = '';

$search2="SELECT * FROM private_servers WHERE server_name='$_SESSION[server_name]'";
$result2 = mysqli_query($conn, $search2);

if(mysqli_num_rows($result2) !== 0) {

$row2 = mysqli_fetch_array($result2);
if($row2['password']==$password){
	$match = "YES";  
	$ID = $row1['ID'];
} 
}
?>