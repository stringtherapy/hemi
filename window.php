<?php
session_start();
if(!isset($_SESSION['name']))
  header("Location:index.php");
$rand = $_SESSION['rand']; //here
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
   // font-style: bold;
//float:right;
//display:inline;
position:absolute;
bottom: 10%;
z-index:99;
    //color:#5D6D7E;
    background-color:#b3ffb3; 
//opacity:50%;
}

alert {

   // color:green;
    position:absolute;
   // bottom: 10%;
    //font-size:30px;
    z-axis:99;
  //margin-left:70;
    bottom: 20%;
   right: 20%;
    background-color:#ff99ff; 
    color:white;
    font-family:Georgia;
 //   font-style:italic;
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
$conn=mysqli_connect("sql307.epizy.com","epiz_27163442","migRiVCK3Bs","epiz_27163442_saga");
$list=mysqli_query($conn,"SELECT * FROM chathistory ORDER BY ID ASC");
if (mysqli_num_rows($list)>0)
{
while($result=mysqli_fetch_array($list)){
	
 if($_SESSION['name']==$result['name']){
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
  //  echo "<h1>". $rand."</h1>";    

?>

  </table>

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

    echo"<body style=background-image:url(img/$rand.jpg); 
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;></body>";

?>

<?php
$res = mysqli_query($conn,"SELECT count(1) FROM chathistory");
$row = mysqli_fetch_array($res);
$total = $row[0];

if(!isset($_SESSION['count'])) {
        $check = $_SESSION['count'] = $total;
    } else {
        $check = $_SESSION['count'];
    }

// echo $total;
     if($total > $check ) { 
        $check = $_SESSION['count'] = $total;
        $recent = mysqli_query($conn,"SELECT * FROM chathistory ORDER BY ID DESC LIMIT 1");
        $check=mysqli_fetch_array($recent);
       // echo $check["name"];
        if($_SESSION['name']==$check["name"]){
            //echo"<alert>message sent!</alert>";
        }
       //echo "<alert><img src=amaz.gif width=48px height=48px></alert>";
        else { echo 
        "<alert onclick=scrollWin()>new message from $check[name] &#8595;</alert><br>";
        }

     } else {
  // echo "<alert><img src=gif3.gif width=28px height=28px></alert>";
// echo "<alert>new message!</alert>";
     }
?>
  
</html>