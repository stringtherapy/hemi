<?php
include('admin_check.php');
include('../../user/conn.php');
include('../check_server_type.php');
include('../profanity_status.php');
?>

<html>
<head>
<title>Chat</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href ="../../css/private.css">
</head>

<body>
<div id="message" style="background:  #80ffbf;">
<?php echo "<h2>Settings for Lobby: ".substr($_SESSION['server_name'],4)."</h2>"; ?>

<form method="post">

<input type = "radio" name = "option" value="change">Change Lobby Key: <input type = "text" name="newname" pattern="(?=.*\d).{5,}"><br> 
<i>(warning: all guests using old lobby key will be logged out)</i><br><br>
<input type = "radio" name = "option" value="clear">Clear Chat History<br><br>
<input type = "radio" name = "option" value="delete"><b>Delete Lobby</b><br><br>

<?php 
if($profanity=="OFF"){
	echo "<input type=radio value=profanity name=option>Turn ON Profanity Filter";
} else {
	echo "<input type=radio value=profanity name=option>Turn OFF Profanity Filter";}
?>
<br><br>

Type admin password: <input type = "password" name="password" value = ""><br><br>
<input type = "button" onClick="location.href='../../text.php'" value = "Go Back">
<input type = "submit" name="change" value = "Update Settings">

</form>

<?php 
$date = date("Y/m/d");
if($_SERVER['REQUEST_METHOD']=="POST" AND isset($_POST['option'])){		
$option = $_POST['option'];
$key = $_SESSION['lobby_key'];
$password = sha1($_POST['password']);
include('password_check.php');
	if($match == "YES"){
//option one: admin can change server name:
		if($option == "change"){
			if(isset($_POST['newname']) AND !empty($_POST['newname'])){
				$new = htmlspecialchars($_POST['newname']);
				$newname = mysqli_real_escape_string($conn,$new);
				$search=mysqli_query($conn,"SELECT * FROM private_servers WHERE lobby_key = '{$newname}'");
					if(mysqli_num_rows($search) == 0){
						$dbname = "ZDB_".$_SESSION['name']."_".$newname;
						$update = "UPDATE private_servers SET server_name= '$dbname',lobby_key='$newname' WHERE id=$ID";
						$change = "ALTER TABLE $chathistory RENAME TO $dbname";
						if(mysqli_query($conn,$change) AND mysqli_query($conn,$update)){
							mysqli_query($conn,"INSERT INTO $dbname (ID,name,message,time) values (NULL,'<b>bot</b>','<small><i>$_SESSION[name]</i> updated the private server (key: $newname) on $date </small>','')");
							$_SESSION['server_name'] = $dbname;
							header('Location:../../text.php'); 
						} else echo "cant rename from ".$chathistory." to ".$dbname." because ".mysqli_error($conn); 
					} else echo "lobby name already exists";
			} else echo "no name entered";
		} 

		if($option == "clear"){
			$oldinfo = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM $chathistory WHERE ID=1"));
			$oldmessage = $oldinfo['message'];
			$query1 = "INSERT INTO $chathistory (ID,name,message,time) values (NULL,'<b>bot</b>','$oldmessage','')";

			if(mysqli_query($conn,"TRUNCATE TABLE $chathistory")){
				$oldname = substr($_SESSION['server_name'],4);
				echo "chat history cleared";
				$query2 = "INSERT INTO $chathistory (ID,name,message,time) values (NULL,'<b>bot</b>','<small> chat history of lobby <b>$oldname</b> was cleared by <i>$_SESSION[name]</i> on $date </small>','')";
				mysqli_query($conn,$query1);
				mysqli_query($conn,$query2);
				header('Location:../../text.php'); 
			} 
		} 


		if($option == "delete"){
			if(mysqli_query($conn,"DROP TABLE $chathistory")){
			header('Location:../../text.php'); 
			} 
		}

		if($option == "profanity"){

			mysqli_query($conn,"INSERT INTO $chathistory (ID,name,message,time) values (NULL,'<b>bot</b>','<small><i>$_SESSION[name]</i> changed profanity filter settings</small>','')");

			if($profanity=="OFF"){
				if(mysqli_query($conn,"UPDATE private_servers SET profanity='1' WHERE server_name='$chathistory'"))
				header('Location:../../text.php'); 
			} 

			else if ($profanity=="ON"){
				mysqli_query($conn,"UPDATE private_servers SET profanity='0' WHERE server_name='$chathistory'");
				header('Location:../../text.php'); 
			} 
		}
} else echo "try again";
}
?>
</div>
</body>
</html>
