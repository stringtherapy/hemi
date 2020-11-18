<?php
session_start();
if(!isset($_SESSION['name']))
  header("Location:index.php");
$rand = $_SESSION['rand']; 									//getting the random number from index.php
?>
<html>
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
*{
  margin:0px;
  padding:0px;
    }
#boxg{
border:0px solid black;
background-color:#5081BC;
opacity:0.85;
border-radius:20px;
padding-left:15px;
padding-right:15px;
padding-top:10px;
padding-bottom:10px;      
margin-right:0px;
margin-left:0px;      
width: 50%;
position: relative;
overflow: hidden;
height: 100%;}  
    
#boxb{
border:0px solid black;
background-color:#f07142;
opacity:0.85;
border-radius:20px;
padding-left:15px;
padding-right:15px;
padding-top:10px;
padding-bottom:10px; 
margin-left:110px;
margin-right:0px;
width: 60%;
left:0%;
float:right;
position: relative;
overflow: hidden;
height: 100%;} 

#imgg{
border:0px solid black;
background-color:transparent;
border-radius:20px;
padding-left:15px;
padding-right:15px;
padding-top:10px;
padding-bottom:10px; 
margin-left:0px;
margin-right:0px;
width: 60%;
position: relative;
overflow: hidden;
height: 100%;} 

#imgb{
border:0px solid black;
background-color:transparent;
border-radius:20px;
padding-left:15px;
padding-right:15px;
padding-top:10px;
padding-bottom:10px; 
margin-left:0px;
margin-right:0px;
width: 60%;
left:50%;
position: relative;
overflow: hidden;
height: 100%;} 

body{
background-color: #404040;
}

#w{
font-family:Georgia;
font-size:11px;
font-color:black;
font-style: italic;
position:absolute;
bottom: 10%;
z-index:99;
background-color:#b3ffb3;
}

alert {
position:absolute;
z-axis:99;
bottom: 20%;
right: 20%;
background-color:#ff99ff;
color:white;
font-family:Georgia;
font-style:italic;
border:0px solid black;
border-radius:25px;
padding:10px;
opacity:80%;
}

table {
border-collapse: collapse;
overflow:auto;
}

td {
padding-top: .5em;
padding-bottom: .5em;
}   
</style>

</head>
<table>
<th></th>

<?php 
$conn=mysqli_connect("host","user","password","db");                   				// part 1: displaying the table of chat data stored in SQL
$list=mysqli_query($conn,"SELECT * FROM chathistory ORDER BY ID ASC");
if (mysqli_num_rows($list)>0)
{
while($result=mysqli_fetch_array($list)){
	
 if($_SESSION['name']==$result['name']){                        				//differentiate color for user and others using session cookie
      echo "
		<tr>
		<td>
   <p style=color:white; font-family:Georgia id=boxg>
  <span style=float:left;font-size:14px;color:#F5F5F5>$result[name]</span><br> 
  <span style=float:left;font-size:20px;opacity:1;>$result[message]</span><br>
  <span style=float:right;font-size:12px;color:#F5F5F5>$result[time]</span>
</p>   
        </td>
		</tr>";
      } else echo "
		<tr>
		<td>
   <p style=color:white; font-family:Georgia id=boxb>
  <span style=float:right;font-size:14px;color:#F5F5F5>$result[name]</span><br> 
  <span style=float:right;font-size:20px;opacity:1;>$result[message]</span><br>
  <span style=float:left;font-size:12px;color:#F5F5F5>$result[time]</span>
</p>   
        </td>
		</tr>";

    }
    }
?>

</table>

<form action="" method="post">
<input type="submit" name="signal" value="refresh" id="w">
</form>

<?php                                                       					//part 2: allowing user to change the background
$randnew= rand(1,25);                                       					//generating a new random number
$var=0;
if(isset($_POST['signal']))
{
	$var .= $var++;
}
if($var!==0){	
	$rand = $randnew;	                                   				//changing the original random number
}

echo"<body style=background-image:url(img/$rand.jpg);></body>"; 				//the random number directly corresponds to 1 of 25 images

?>

<?php                                                                  				//part 3: to get real time notification
$res = mysqli_query($conn,"SELECT count(1) FROM chathistory");         				//to identify change in sql table
$row = mysqli_fetch_array($res);
$total = $row[0];                                                       			//getting the count in total variable

if(!isset($_SESSION['count'])) {                                        			//a session variable to keep check on count
        $check = $_SESSION['count'] = $total;                           			//storing it in check variable
    } else {
        $check = $_SESSION['count'];
    }

// echo $total;
     if($total > $check ) {                                             			//comparing total and check
        $check = $_SESSION['count'] = $total;
        $recent = mysqli_query($conn,"SELECT * FROM chathistory ORDER BY ID DESC LIMIT 1"); 	//getting the last user details
        $check=mysqli_fetch_array($recent);
       // echo $check["name"];
        if($_SESSION['name']==$check["name"]){                                 			//if the message is from user ignore
            //echo"<alert>message sent!</alert>";
        }
        else { echo                                                            			//if not trigger notification along with name
        "<alert onclick=scrollWin()>new message from $check[name] &#8595;</alert><br>";
        }
     } 
?>
  
</html>
