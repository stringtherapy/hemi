<?php
session_start();
if(isset($_SESSION['server_name'])){
unset($_SESSION['server_name']);
}
?>
<html>
<head>
<title>Messenger</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href ="css/index.css"/>
<script src="script/resub.js"></script>
</head>


<form action="index.php" id="login" method="post"><br><br><br>
<i>Hello</i>:<input type="text" name="name" placeholder="type your name" value="" maxlength="25">
<input type="submit" value="welcome"><br><br>
<input type="radio" name="server_type" value="PUBLIC" checked>Public Lobby &nbsp <input type="radio" name="server_type" value="PRIVATE">Private Lobby 
</form>

<?php
include('user/conn.php');					// importing user's database configuration
if($_SERVER['REQUEST_METHOD'] == "POST")			// if user logs in
{	
    if(isset($_POST['name']) AND !empty($_POST['name'])){	// if the name entered by user is not empty 
	$name = htmlspecialchars($_POST['name']);    		// [security purpose]: to prevent interpretation of html code
	    
	//creating template before sending		
	$stmt = mysqli_stmt_init($conn);
	$sql="INSERT INTO friends (name) VALUES (?)";		// [security purpose]: placeholders(?) to prevent SQL injections (you could also use mysqli_real_escape_string method)
	
	$server_type=$_POST['server_type'];
	    
	//checking profanity before sending    			
	$message = $name;					// profanity filter only accepts the variable name "message"
	include('extra/profanitycheck/filter.php');     	// filtering happens here
	if ($check==0){						// the variable "check" indicates presence or absence of profanity
		//session_start();				// beginning to store user info
		$_SESSION['name']=$name;			// storing username as cookie
    		$_SESSION['rand']=rand(1,25);			// generating and storing random number which will determine the default wallpaper of chat page
		
		//sending value to database
		if (mysqli_stmt_prepare($stmt,$sql)){		
		mysqli_stmt_bind_param($stmt, "s", $name);
		mysqli_stmt_execute($stmt);			// user's name is stored in database 
			
		//redirecting based on server type	
		if($server_type == "PUBLIC"){
		$_SESSION['private']=False;	
		header('Location:text.php');
		exit();}	
		
		else if($server_type == "PRIVATE"){
		$_SESSION['private']=True;	
		include('user/conn.php');
		include('extra/privateserver/private_setup.php');
		}		
		}
	} else echo '<p id=login>please try again</p>';				// failure case: user entered a name containing profanity
    } else echo '<p id=login>please enter a name</p>'; 				// failure case: user didn't enter a name
}
?>
</body>
</html>
