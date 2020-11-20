<?php	

$list=file_get_contents("profan.txt");
$arr= explode("\n",$list);

for($i=0; $i < count($arr); $i++)
{
if(strlen($arr[$i]) == 3)

	file_put_contents("three.txt", $arr[$i]."\n", FILE_APPEND);
	
}
?>