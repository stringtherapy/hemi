<?php
session_start();
if(!isset($_SESSION['name'])){
	header("Location:index.php");
}
//if user tried to access the chat window without logging in, the user is redirected to index page
