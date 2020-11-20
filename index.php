<html>
<head>
<title>Messenger</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href ="css/index.css"/>
</head>

<form action="index.php" method="post"><br><br><br>
<i>Hello</i>:<input type="text" name="name" value=""><br><br>
<input type="submit" value="welcome">
</form>

<?php
include('user/conn.php');
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    if(isset($_POST['name']) AND !empty($_POST['name'])){
	$name = mysqli_real_escape_string($conn,$_POST['name']);
	$message = $name;
	include('extra/profanitycheck/filter.php'); 
	if ($check == 0){
		session_start();
		$_SESSION['name']=$name;
    		$_SESSION['rand']=rand(1,25);
  		mysqli_query($conn,"INSERT INTO friends(name)VALUES('$name')");
		header('Location:text.php');
	} else echo 'please try again';
    } else echo 'please enter a name'; 
}
?>
</body>
</html>
