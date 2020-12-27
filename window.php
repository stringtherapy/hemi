<?php
include('extra/logincheck.php');
$rand = $_SESSION['rand']; 
?>
<html>
<head>
<title>chat table</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href ="css/window.css">
</head>
													<!-- code that displays mysql table -->
<table>
<th></th>
<?php 
include('user/conn.php');
include('extra/check_server_type.php');

if($list=mysqli_query($conn,"SELECT * FROM $chathistory ORDER BY ID ASC"))
{
if (mysqli_num_rows($list)>0) {
    while($result=mysqli_fetch_array($list)){
        if($_SESSION['name']==$result['name']){                 
          echo "<tr>
	  <td>
          <p style=color:white; font-family:Georgia id=user>
          <span style=float:left;font-size:14px;color:#F5F5F5>$result[name]</span><br> 
          <span style=float:left;font-size:20px;opacity:1;>$result[message]</span><br>
          <span style=float:right;font-size:12px;color:#F5F5F5>$result[time]</span></p>   
          </td>
          </tr>";
        } else echo "<tr>
          <td>
          <p style=color:white; font-family:Georgia id=others>
          <span style=float:right;font-size:14px;color:#F5F5F5>$result[name]</span><br> 
          <span style=float:right;font-size:20px;opacity:1;>$result[message]</span><br>
          <span style=float:left;font-size:12px;color:#F5F5F5>$result[time]</span></p>   
          </td>
          </tr>";
	}
}
} else {
echo "<h2 style=color:white;text-align:center;top:20%;>server:<i> " .substr($chathistory,4)."</i> no longer available &#129335<br><br> <small><a href=index.php style=color:white>click to exit</a></small></h2>" ;
exit();
}
?>
</table>
	
													<!-- code that changes background -->		
<form action="" method="post">
<input type="submit" name="signal" value="refresh" id="w">
</form>

<?php
$randnew= rand(1,25);        
$var=0;
if(isset($_POST['signal']))
{
  $var .= $var++;
}
if($var!==0){ 
  $rand = $randnew;                
}
echo"<body style=background-image:url(img/$rand.jpg);></body>";
?> 
                                           
<?php                                                                 					 // code to detect mysql changes 
$res = mysqli_query($conn,"SELECT count(1) FROM $chathistory");         
$row = mysqli_fetch_array($res);
$total = $row[0];                                                       

if(!isset($_SESSION['count'])) {                                        
        $check = $_SESSION['count'] = $total;
} else {
        $check = $_SESSION['count'];
}

     if($total > $check ) {                                                              		// detected a new entry in table 
        $check = $_SESSION['count'] = $total;								
        $recent = mysqli_query($conn,"SELECT * FROM $chathistory ORDER BY ID DESC LIMIT 1"); 
        $check=mysqli_fetch_array($recent);
        	if($_SESSION['name']==$check["name"]){                                             
            	//echo"<alert>message sent!</alert>";
        	} else echo "<alert>new message from <i>$check[name]</i> &#8595;</alert><br>";		// generating notification 
}
?>
</html>
