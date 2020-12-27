<?php
if(!isset($_SESSION)){ 
	session_start();
	if(!isset($_SESSION['private']) OR !isset($_SESSION['server_name'])){
		header("Location:../../index.php");
		exit();
	} 
}
?>