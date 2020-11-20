<html>
<head>
<title>Authentication</title>
</head>
<body>
<?php
$conn=mysqli_connect("host","root","","db");                                                    //connecting
if(!$conn)
die("no connection".mysqli_error($conn));
else echo "Connection Successful<br>";

                                                                                               //getting data from any form
$username =$_POST['username'];
$password =$_POST['password'];
$hashed_password= password_hash($password, PASSWORD_DEFAULT);                                   //basic encryption for password


//Authentication
$queryA="SELECT ID FROM login WHERE username = '{$username}'";                                  //SQL ID is unique for each user 
$queryB="SELECT ID FROM login WHERE hashed_password = '{$hashed_password}' LIMIT 1";            //comparing IDs of name and password never fail  


$resultA=mysqli_query($conn,$queryA);
$resultB=mysqli_query($conn,$queryB);

$userID = mysqli_fetch_assoc($resultA);
$passID = mysqli_fetch_assoc($resultB);


if ($userID==$passID){ 
  header("Location: ChatArea.php");                                                               //Authentication 
  session_start();
  $_SESSION['username']="$username";
} else {
  echo "login fail"; 
}
?>
  
</body>
</html>
