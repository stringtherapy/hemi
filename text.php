check!
<?php
session_start();
if(!isset($_SESSION['name']))
  header("Location:index.php");
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
    //background-color: #47d147;
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

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

</head>
<body onload="scrollWin()"> 
<?php //include('window.php'); ?>  

<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
<script type="text/javascript">   
    var auto_refresh = setInterval(
    function ()
    {$('#Status').load('window.php');
    },1000); 
</script> 
  
<script type="text/javascript">     
    function scrollWin(){
     document.querySelector("#Status").scrollTop = document.querySelector("#Status").scrollHeight;
    }; 
</script>  
  

<div id="Status"  onload="scrollWin()"><br><br>
<?php include('window.php'); ?><img src="load.gif" width="25px" height="25px" style="margin-left:20%;">
</div>

 
<form action="textpro.php" method="post">
<input type="text" name="message" value="" size="35" autocomplete="off">
<input type="hidden" value="<?php echo $rand?>" name="check">
<input type="submit" value="send">
</form>



<?php
$conn=mysqli_connect("sql307.epizy.com","epiz_27163442","migRiVCK3Bs","epiz_27163442_saga");
date_default_timezone_set("Asia/Kolkata");   

if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_POST['message']) AND !empty($_POST['message'])){

    $name=$_SESSION['name'];    
	$message=$_POST['message']; 
	$time=date("l h:i:sa");

    $list=file_get_contents("profan.txt");
    $exem = array("whole", "will", "other","mother","long","fell","best","face","star","ones","horn","chin","lock","full","test"); 
	$exem2 = array("sex","tit","cum","ass","fux","god");
    /*if(strripos($list,$_POST['message']) !== false){
        echo "<font color=white>language!</font>";
    }
    else{ */

    $me=explode(" ",$message);
    $length = count($me);
	$censored='';
    //core filtering
    for ($i = 0; $i < $length; $i++)
		
		{
		    $melow[$i] = strtolower($me[$i]);	
            $me2[$i] = preg_replace('/[^A-Za-z0-9\-]/', '', $melow[$i]);
			if(strlen($me2[$i]) >= 4){									
			$me3[$i] = "/$me2[$i]/";
			if(preg_match($me3[$i], $list)==1){                       
			if(!in_array($me2[$i], $exem)){											
			$me[$i]="<strike><d style = opacity:20%>".$me[$i]."</d></strike>"; 
				}
				}
				} else if(in_array($me2[$i], $exem2)){
					$me[$i]="<strike><d style = opacity:20%>".$me[$i]."</d></strike>"; 
				}	
		$censored .= "$me[$i]"." ";
		}
//message is now censored
	
	mysqli_query($conn,"INSERT into chathistory(name,message,time) VALUES('$name','$censored','$time')");
  // echo "<script>window.location.href='textpro.php'</script>";
	}
    
}
?>

<?php /*
if(isset($_SESSION['scroll']))
{
   echo "<script>window.location.href='textpro.php'</script>";  
   unset($_SESSION['scroll']);
} */
?>

</body>
</html>
