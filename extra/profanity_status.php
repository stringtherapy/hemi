<?php
	$prof_query = "SELECT * FROM private_servers WHERE server_name = '$chathistory'";
	$prof_execute = mysqli_query($conn, $prof_query);
	$row = mysqli_fetch_array($prof_execute);
	$profanity_check = $row['profanity'];

	if($profanity_check==0)
		$profanity = "OFF";
	else 
		$profanity = "ON";
?>