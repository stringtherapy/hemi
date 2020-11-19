<html>
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<style>
#collection{max-width:25px;}
</style>

<form action="stickers.php" method="post">
<input type="image" name="party" src="party.png" alt="party" />
<input type="hidden" name="action" value="party">
</form>



<?php 
$name=$_SESSION['studentname'];
$conn=mysqli_connect("sql109.epizy.com","epiz_23057865","4OmjEeOO","epiz_23057865_mydb");
if($_SERVER['REQUEST_METHOD']=="POST"){


if($_POST['action'] == "party"){
$fetch=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM stickers WHERE name = 'party'"));
$smiley= addslashes($fetch['smiley']);
//echo '<img src="data:image/jpeg;base64,'.base64_encode($smiley).'"/>';
if(mysqli_query($conn,"INSERT INTO chathistory(name,img) VALUES('$name','$smiley')"){
echo "success";}
//header("Location:text.php");
//end();}
else echo "error".mysqli_error($conn);
}
}
?>

</body>
</html>