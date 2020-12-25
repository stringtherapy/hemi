<?php
if(!isset($_SESSION)){ 
	session_start();
	if(!isset($_SESSION['private'])){
		header("Location:index.php");
	}
}
?>

<html>
<form action='extra/privateserver/private_setup.php' id='login' method='post'><br><br><br>
<i>Enter Key</i>: <input type='text' name='key' placeholder="invite anyone with this key"  pattern="(?=.*\d).{5,}" value=''> 
<input type='submit' name='create' value="enter as <?php echo $_SESSION['name'] ?> "><br><br>
minimum 5 characters with at least one number
</form> 
</html>

<?php
$conn=mysqli_connect("localhost","root","","hemi",3306);
if(isset($_POST['create'])){
	if(isset($_POST['key']) AND !empty($_POST['key'])){
		$lobby_key = htmlspecialchars($_POST['key']);
		$search=mysqli_query($conn,"SELECT * FROM private_servers WHERE lobby_key = '{$lobby_key}'");

		if(mysqli_num_rows($search) == 0){
			$chathistory = "ZDB_".$_SESSION['name']."_";	
			$date = date("Y/m/d");
			$ins="INSERT INTO private_servers (server_name,lobby_key,time) values ('$chathistory','$lobby_key','$date')";
			mysqli_query($conn, $ins);
			$tab = "CREATE TABLE $chathistory (
			ID int(10) NOT NULL AUTO_INCREMENT,
			name varchar(40) NOT NULL,
			message varchar(140) NOT NULL,
			time varchar(40) NOT NULL,
			PRIMARY KEY (ID) ) ";
			
			if (mysqli_query($conn, $tab)){ 
				mysqli_query($conn,"INSERT INTO $chathistory (ID,name,message,time) values (NULL,'<b>bot</b>','<small><i>$_SESSION[name]</i> created this private server (key: $lobby_key) on $date </small>','')");
				$_SESSION['server_name']=$chathistory;	
				header('Location:../../text.php');
				exit();
			}
		} else {
				$presult= mysqli_fetch_array($search);
				$chathistory = $presult['server_name'];
				mysqli_query($conn,"INSERT INTO $chathistory (ID,name,message,time) values (NULL,'<b>bot</b>','<small><i>$_SESSION[name]</i> hopped onto the server</small>','')");
				$_SESSION['server_name']=$chathistory;	
				header('Location:../../text.php');
				exit();
		}

	}
}
?>
