<?php
include('private_check.php');
?>

<html>
<head>
<title>Chat</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href ="../../css/private.css">
 <script src="script/resub.js"></script>
</head>


<body>
<div id="message" style="background: #cc99ff;">
<?php 
echo "<h2>Hello $_SESSION[name]</h2>";
$chathistory = $_SESSION['server_name'];
echo "You're about to enter lobby: <b>".substr($_SESSION['server_name'], 4)."</b>"; ?>
<br>
<form action = "" method="post"><br><br>
<input type = "button"  onClick="location.href='../../index.php'" value = "Go Back">  <input type = "submit" name="guest" value = "Take me in">
</form>
</div>
</body>
<?php 
include('../../user/conn.php');
if(isset($_POST['guest'])){
mysqli_query($conn,"INSERT INTO $chathistory (ID,name,message,time) values (NULL,'<b>bot</b>','&#128400<i><small><b> $_SESSION[name]</b> hopped onto the lobby</i></small>','')");
header('Location:../../text.php');
}
<?php include('hints.php'); ?>
?>
