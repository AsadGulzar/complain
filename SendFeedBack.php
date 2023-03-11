<?php
require('connection.php');
if(isset($_GET['ComplainID']) && isset($_GET['FeedBacK']) && isset($_GET['stars']) )
{
	$ComplainId =  CleanData($_GET['ComplainID']);
	$FeedBacK =  CleanData($_GET['FeedBacK']);
	$stars =  CleanData($_GET['stars']);
	
	$FeedBackQ = "update complain set FeedBack='$FeedBacK', Rating='$stars' 
				where ComplainId='$ComplainId';";
	
	$FeedBackQR = mysqli_query($con,$FeedBackQ);
	
	if($FeedBackQR)
	{
		echo "<h3>FeedBackGiven SuccessFully</h3>";
	}
	else
	{
		echo "Something Went Wrong Please try Again.";
	}
	
}
?>