<html>
<head>
<title>Authentication</title>
</head>
<body>
<?php
//Connecting
$conn=mysqli_connect("localhost","root","","lib");
if(!$conn)
die("no connection".mysqli_error($conn));
else echo "Connection Successful<br>";

//Input
$username =$_POST['username'];
$password =$_POST['password'];
$hashed_password=sha1($password);


//Authentication
$queryA="SELECT ID FROM adminlogin WHERE username = '{$username}'";
$queryB="SELECT ID FROM adminlogin WHERE hashed_password = '{$hashed_password}' LIMIT 1";


$resultA=mysqli_query($conn,$queryA);
$resultB=mysqli_query($conn,$queryB);

$userID = mysqli_fetch_assoc($resultA);
$passID = mysqli_fetch_assoc($resultB);

echo "$userID"."$passID";

if ($userID==$passID)
{ header("Location: StaffArea.php");
session_start();
$_SESSION['username']="$username";}
else {header("Location: AdminLoginfail.php"); }
?>

</body>
</html>