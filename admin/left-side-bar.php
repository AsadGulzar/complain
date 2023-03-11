<ul class="nav nav-pills nav-stacked">
	
    <li class="active"><a href="ComplainRequests.php">Complains Requests</a></li>
    <li class="active"><a href="ReviewComplains.php">Review Complains</a></li>
    <li class="active"><a href="SolveComplains.php">Solve Complains</a></li>
    <br>
    <li><h4>Categories</h4></li>
	<?php
		$GetUserCategoriesQ = "select distinct ComplainCategoryID from complain ";
	
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
            	  <li class="active"><a href="CategoryView.php?categoryId=<?php echo $CatId;?>"><?php echo $CatName;?></a></li>
			<?php
		}
	}
    ?>
    
</ul>