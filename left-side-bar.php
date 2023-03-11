<ul class="nav nav-pills nav-stacked">
	<?php 
	
	$GetUserCategoriesQ = "select distinct ComplainCategoryID from complain where ComplainUserId = $UserID;";
	
	$GetUserCategoriesQR = mysqli_query($con,$GetUserCategoriesQ);
	
	$GetUserCategoriesNR = mysqli_num_rows($GetUserCategoriesQR);
	
	if($GetUserCategoriesNR>0)
	{
		while($GetUserCategoriesRow = mysqli_fetch_assoc($GetUserCategoriesQR))
		{
			$ComplainCategoryID = $GetUserCategoriesRow['ComplainCategoryID'];
			
			$getCategoryQ = "select * from category where CategoryID='$ComplainCategoryID'";
			
			$getCategoryQR = mysqli_query($con,$getCategoryQ);
			
			$getCategoryRow = mysqli_fetch_assoc($getCategoryQR);
			
			 $CatId= $getCategoryRow['CategoryID'];
			 $CatName= $getCategoryRow['CategoryName'];
			
			?>
            	  <li class="active"><a href="dashboard.php?categoryId=<?php echo $CatId;?>"><?php echo $CatName;?></a></li>
			<?php
		}	
	}
	else
	{
		echo "<h4 class=\"text-center\">you have made no complain.</h4>";
	}
	
	
	
	?>

</ul>