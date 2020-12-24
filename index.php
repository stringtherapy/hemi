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
include('user/conn.php');					// importing user's database configuration
if($_SERVER['REQUEST_METHOD'] == "POST")			// if user clicks the button "welcome"
{
    if(isset($_POST['name']) AND !empty($_POST['name'])){	// if the name entered by user is not empty 
	$html = htmlspecialchars($_POST['name']);    		// [security purpose]: to prevent interpretation of html code
	$name = mysqli_real_escape_string($conn,$html);		// [security purpose]: to prevent SQL injection  
	    
	//creating template before sending
	$stmt = mysqli_stmt_init($conn);			
	$sql="INSERT INTO friends (name) VALUES (?)";		// using placeholders(?) instead of direct insertion into database if a good security practice
	    
	//checking profanity before sending    			
	$message = $name;					// profanity filter only accepts the variable name "message"
	include('extra/profanitycheck/filter.php');     	// filtering happens here
	if ($check==0){						// the variable "check" indicates presence or absence of profanity
		session_start();				// beginning to store user info
		$_SESSION['name']=$name;			// storing username as cookie
    		$_SESSION['rand']=rand(1,25);			// generating and storing random number which will determine the default wallpaper of next page
		
		//sending value to database
		if (mysqli_stmt_prepare($stmt,$sql)){		
		mysqli_stmt_bind_param($stmt, "s", $name);
		mysqli_stmt_execute($stmt);			// user's name is stored in database 
		header('Location:text.php');			// user is redirected to text.php
		}
	} else echo 'please try again';				// failure case: user entered a name containing profanity
    } else echo 'please enter a name'; 				// failure case: user didn't enter a name
}
?>
</body>
</html>
