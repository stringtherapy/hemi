<?php
include('private_check.php');
?>

<html>
<form action='extra/privateserver/private_setup.php' id='login' method='post'><br><br><br>
Lobby Key: <input type='text' name='key' placeholder="e.g. mySpace3"  pattern="(?=.*\d).{5,}" value='' maxlength='25'> 
<input type='submit' name='create' value="enter as <?php echo $_SESSION['name'] ?> "><br><br>
<i>5 or more characters with at least one number</i>
</form> 
</html>

<?php
$conn=mysqli_connect("localhost","root","","hemi",3306);
if(isset($_POST['create'])){
	if(isset($_POST['key']) AND !empty($_POST['key'])){
		$lobby_key = htmlspecialchars($_POST['key']);
		$search=mysqli_query($conn,"SELECT * FROM private_servers WHERE lobby_key = '{$lobby_key}'");

		if(mysqli_num_rows($search) == 0){
			$_SESSION['lobby_key'] = $lobby_key;
			header('Location:adminmessage.php');
			exit();
		} else {
			$presult= mysqli_fetch_array($search);
			$chathistory = $presult['server_name'];
			$_SESSION['lobby_key'] = $lobby_key;
			$_SESSION['server_name']=$chathistory;	
			header('Location:guestmessage.php');
			exit();
		}

	} else header('Location:../../index.php');
}
?>
