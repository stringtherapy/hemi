<html>
<head>
<title>Messenger</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body{
    text-align:center;
    height: 100%;
    background-color: #404040;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-image:url("https://source.unsplash.com/random/1136x640");
    }                       <!-- random images from Unsplash API -->
    </style>
</head>

<form action="index.php" method="post">
<br>
<br>
<br>
<i>Hello</i>:<input type="text" name="name" value=""><br><br>
<input type="submit" value="welcome">
</form>

<?php
$rand=rand(1,25);                                                   //generating random number for later use
$conn=mysqli_connect("host","user","pass","db");                    //establishing connection to any database

if($_SERVER['REQUEST_METHOD']=="POST")                              //on submission
{
    if(isset($_POST['name']) AND !empty($_POST['name'])){           //if name is not empty
	$name=$_POST['name'];                                           //storing the user name in variable
    
    
    //checking for profanity (basic version)
    $list=file_get_contents("profan.txt");
                                                                    
    $me=explode(" ",$name);
    $length = count($me);
	$var=0;
	
    for ($i = 0; $i < $length; $i++)
		
		{
			if(strlen($me[$i]) >= 4){
			$me2[$i] = "/$me[$i]/i";
			if(preg_match($me2[$i], $list)==1){
                $var .= $var++;
                }
			
		} 
        }
    if($var!== 0){
        echo "please try again";
    }
    //End of profanity check. For more details and improvised version check my repo:bleepblop
        
    else{
	session_start();                                                    //starting session to store user input as cookie
	$_SESSION['name']=$name;                                            //storing username
    $_SESSION['rand']=$rand;                                            //storing the random number unique to this login
  	mysqli_query($conn,"INSERT INTO friends(name)VALUES('$name')");     //registering the user into database
	header("Location:text.php");                                        //redirecting to chat area
    } 
    } else echo "please enter your name";                               //if user returns empty data
}
?>
</body>
</html>
