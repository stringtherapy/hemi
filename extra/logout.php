<?php
include('../user/conn.php');         
session_start();
if(isset ($_SESSION['server_name'])){
  $chathistory = $_SESSION['server_name'];
  $logout = "INSERT INTO $chathistory (ID,name,message,time) values (NULL,'<b>bot</b>','&#128075<i><small><b>$_SESSION[name]</b> logged out</small></i>','')";
  if(mysqli_query($conn,$logout)){
	  // remove all session variables
	  session_unset();
	  // destroy the session
	  session_destroy();
  }
}
header("Location:../index.php");
?>
