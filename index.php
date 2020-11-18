<html>
<head>
<title>Messenger</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body{
    text-align:center;
    height: 100%; background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    color:white;
    }
    </style>
</head>
<body style="background: #404040 center / cover no-repeat;background-image:url(https://source.unsplash.com/random/1136x640)">  
	<!-- for random images from Unsplash API -->

<form action="index.php" method="post">
<br>
<br>
<br>
<i>Hello</i>:<input type="text" name="name" value=""><br><br>
<input type="submit" value="welcome">
</form>

<?php
$rand=rand(1,25);  
$conn=mysqli_connect("host","user","pass","db");   

if($_SERVER['REQUEST_METHOD']=="POST")
{
    if(isset($_POST['name']) AND !empty($_POST['name'])){
	$name=$_POST['name'];
    
    $list=file_get_contents("profan.txt");

    $me=explode(" ",$name);
    $length = count($me);
	$var=0;
	
    //check loop
    for ($i = 0; $i < $length; $i++)
		
		{
			if(strlen($me[$i]) >= 4){
			$me2[$i] = "/$me[$i]/i";
			if(preg_match($me2[$i], $list)==1){
                $var .= $var++;			            //signal
                }
			
		} 
        }
    //check loop


    if($var!== 0){
        echo "please try again";
    }
    else{
	session_start();
	$_SESSION['name']=$name;
    $_SESSION['rand']=$rand; //here
  	mysqli_query($conn,"INSERT INTO friends(name)VALUES('$name')");
	header("Location:textpro.php");
    } 
    } else echo "please enter your name";
}
?>
</body>
</html>
