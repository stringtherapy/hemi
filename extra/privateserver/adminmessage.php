<?php
include('private_check.php');
?>

<html>
<head>
<title>Chat</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href ="../../css/private.css">
</head>

<body>
<div id="message" style="background: #66CCCC;">
<?php 
echo "<h2>Hello $_SESSION[name]</h2>";
echo "No lobby with key <b>".$_SESSION['lobby_key']."</b> exits. Do you wanna create one?"; ?><br><br>
<form action = "" method="post">
Set admin password: <input type = "password" name="pass" value = "" placeholder="" maxlength="20">
<input type = "submit" name="admin" value = "Create"><br><br>
<input type = "button" onClick="location.href='../../index.php'" value = "Go Back">
</form>
</div>
</body>

<?php 
$conn=mysqli_connect("localhost","root","","hemi",3306);
if(isset($_POST['admin'])){
			$lobby_key = $_SESSION['lobby_key'];
			$password = sha1($_POST['pass']);
			$chathistory = "ZDB_".$_SESSION['name']."_".$lobby_key;	
			$date = date("Y/m/d");

			$stmt = mysqli_stmt_init($conn);	
			$ins="INSERT INTO private_servers (server_name,lobby_key,password,time) VALUES (?,?,?,?)";
			if (mysqli_stmt_prepare($stmt,$ins)){		
			mysqli_stmt_bind_param($stmt, "ssss", $chathistory, $lobby_key, $password, $date);
			mysqli_stmt_execute($stmt);
			} 

			
			$tab = "CREATE TABLE $chathistory (
			ID int(10) NOT NULL AUTO_INCREMENT,
			name varchar(40) NOT NULL,
			message varchar(350) NOT NULL,
			time varchar(40) NOT NULL,
			PRIMARY KEY (ID) ) ";

			if (mysqli_query($conn, $tab)){ 
				mysqli_query($conn,"INSERT INTO $chathistory (ID,name,message,time) values (NULL,'<b>bot</b>','<small><i>$_SESSION[name]</i> created private lobby (key: $lobby_key) on $date<small>','')");
				$_SESSION['server_name']=$chathistory;	
				header('Location:../../text.php'); 
			}
}
?>

</body>
</html>