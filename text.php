<?php
session_start();
if(!isset($_SESSION['name']))
  header("Location:index.php");  //redirecting to login page user is not logged in
?>                               
<html>
<head>
<title>Chat</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    *{margin:0px;
    padding:0px;
    }

    body{margin-right:10px;
    margin-left:10px;}  
     
    input[type=text] {
    width: 80%;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid white;
    border-radius: 20px;
    background-color:transparent;
    color:white;
    text-shadow: 1px 1px 2px gray;
    font-size: 16px;
    }
     
     #nav li{
	display:inline-block;
	list-style:none;
    padding:5px;
	padding-left:5px;}

     #nav{
    border-bottom:0.75px solid black;
    text-align:center;
    border-bottom-right-radius:10px;
    border-bottom-left-radius:10px;}
    
    #nav a{
    text-decoration: none;
    color: black;}

    input[type=submit] {
    border:none;
    color:black;
    padding:10px;
    border-radius:25px;
    font-size:15px;}

     #Status{
    width:100%;
  	height:90%;
    overflow:auto;
    -webkit-overflow-scrolling: touch;}    

</style>

<script>                                                              	  //three lines to prevent form resubmission on reload
if ( window.history.replaceState ) {                                  	  //javascript code source:www.webtrickshome.com
  window.history.replaceState( null, null, window.location.href );
}
</script>

</head>
<body onload="scrollWin()">                                                <!-- calling a function to load window.php file -->

<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
<script type="text/javascript">   
    var auto_refresh = setInterval(                                   	   //window.php is refreshed to display continous data.
    function ()
    {$('#Status').load('window.php');
    },1000); 
</script> 
  
<script type="text/javascript">                                       	   //script to make window.php scroll down to bottom on load
    function scrollWin(){
     document.querySelector("#Status").scrollTop = document.querySelector("#Status").scrollHeight;
    }; 
</script>  
  

<div id="Status"  onload="scrollWin()"><br><br>                        	   <!-- the element where scroll function is applied. -->
<?php include('window.php'); ?><img src="load.gif" width="25px" height="25px" style="margin-left:20%;"> <!-- a little animation -->
</div>

 
<form action="text.php" method="post">                                     <!-- this is where text.php starts. -->
<input type="text" name="message" value="" size="35" autocomplete="off">   <!-- getting message from user -->
<input type="submit" value="send">
</form>



<?php
$conn=mysqli_connect("host","user","password","db");                      	//establishing connection
date_default_timezone_set("Asia/Kolkata");                                	//defining time zone

if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['message']) AND !empty($_POST['message'])){           	//on receiving data from user

    $name=$_SESSION['name'];
	$message=$_POST['message'];                                           	//storing name, message, date
	$time=date("l h:i:sa");

    $list=file_get_contents("profan.txt");                               	//basic profanity check
    $me=explode(" ",$message);                                            	//for more details check my repo: bleepblop
    $length = count($me);
	$censored='';
    for ($i = 0; $i < $length; $i++)
		{
        $me2[$i] = preg_replace('/[^A-Za-z0-9\-]/', '', $me[$i]);
        if(strlen($me2[$i]) >= 4){
        $me3[$i] = "/$me2[$i]/i";
        if(preg_match($me3[$i], $list)==1){
        if(!in_array($me2[$i], $exem)){
        $me[$i] = str_repeat("*", strlen($me[$i]));
        }
        }
        }
		$censored .= "$me[$i]"." ";                                      //getting censored data to store in database
		}
	
	mysqli_query($conn,"INSERT into chathistory(name,message,time) VALUES('$name','$censored','$time')");
	}
}
?>
</body>
</html>
