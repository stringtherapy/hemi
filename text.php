<?php
include('extra/logincheck.php');
include('user/conn.php');  
include('extra/check_server_type.php');

//private lobby users will get an extra button on the top right corner named "settings"
if($chathistory != "chathistory"){
	echo"<button style=position:absolute;z-index:99;right:5%;opacity:70%><a href=extra/privateserver/admin.php>Settings</a></button>";
	include('extra/profanity_status.php');
}
?>

<html>
<head>
<title>Chat</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href ="css/text.css">
<script src="script/resub.js"></script>
<script src="script/text.js"></script>
</head>

<body onload="scrollWin()">
<script type="text/javascript" src="script/jquery-3.3.1.min.js"></script>	
<script src="user/refresh.js"></script>

<input type="button" id="logout" onClick="location.href='extra/logout.php'" value="Logout">	
  
<div id="Status" onload="scrollWin()"><br><br>
<?php include('window.php'); ?><img src="user/loading_animation.gif" width="25px" height="25px" style="margin-left:20%;">
</div>
 
<form action="text.php" method="post">          
<input type="text" name="message" value="" size="35" autocomplete="off">   
<input type="submit" value="send">
</form>

<?php
       
$stmt = mysqli_stmt_init($conn);
$sql  = "INSERT INTO $chathistory (name,message,time) VALUES (?, ?, ?)";          		// about to insert three values from user
	
if($_SERVER['REQUEST_METHOD']=="POST"){								// if user clicks "send"
	if(isset($_POST['message']) AND !empty($_POST['message'])){           			// if user's message is not empty

    	$name=$_SESSION['name'];								// getting name
  	$message=htmlspecialchars($_POST['message']);								// getting message              
	$time=date("l h:i:sa");									// registering time

		if($chathistory == "chathistory" OR $profanity == "ON")
		{										// checking for profanity settings
			include('extra/profanitycheck/filter.php');  
			$final_message = $censored;
		} else  $final_message = $message;

		if(mysqli_stmt_prepare($stmt,$sql)){
		   mysqli_stmt_bind_param($stmt, "sss", $name, $final_message, $time);		// inserting name, cencored message and time into database
		   mysqli_stmt_execute($stmt);
		}
	}
}
?>
</body>
</html>
