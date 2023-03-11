<?php
$con = mysqli_connect('localhost','root','','complain');
if(!$con)
{
	echo "Db Connection Error ".mysqli_error($con) ;
}
else
{
	echo "";
}

function CleanData($Data)
{
	$Data = addslashes($Data);
	$Data = trim($Data);
	$Data = stripslashes($Data);
	return $Data;
}
?>