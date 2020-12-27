<?php
if(!isset($_SESSION['server_name'])){
	$chathistory = "chathistory"; 			     //default public server
	} else {
	$chathistory = $_SESSION['server_name'];             //custom private server
	}
?>
