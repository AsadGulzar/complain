<?php include('top.php');
require_once('Session-set.php');
if(isset($_POST['UCreateCategory']))
{
	$UCatId = CleanData($_POST['UpdateCategoryID']);
	$UCatName = CleanData($_POST['UCatName']);
	
	$CategoryQ = "update category set CategoryName='$UCatName' where CategoryID='$UCatId';";
	
	$CategoryQR = mysqli_query($con,$CategoryQ);
	
	if($CategoryQR)
	{
		?>
        <script>alert('Category Updated Successfully');</script>
        <script>window.location='ManageCategories.php';</script>
		<?php

	}
	else
	{
		echo "<h3 class=\"text-center\">Please try Again</h3>";
	}
	
}
?>
<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
					<li><a href="#">Features</a><i class="icon-angle-right"></i></li>
					<li class="active">Edit Category</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="content-wraper">
	<div class="container">
    	<div class="row">
			<div class="col-sm-3">
            	<?php include('left-side-bar.php')?>
            </div><!-- col-sm-3 end here -->
            <div class="col-sm-9">
            	<?php
					if(!isset($_GET['EditCategory']))
					{
						$GetCategoryQ = "select * from category order by CategoryID desc";
						$GetCategoryQR = mysqli_query($con,$GetCategoryQ);
						$GetCategoryNr = mysqli_num_rows($GetCategoryQR);
						
						if($GetCategoryNr>0)
						{
							?>
								<table class="table table-bordered table-striped">
									<tr>
										<th>SR Number</th>
										<th>Category Name</th>
										<th>Edit</th>
									</tr>
							<?php
							$Srnumber = 1;
							while($GetCategoryRow = mysqli_fetch_assoc($GetCategoryQR))
							{
								$CategoryID = $GetCategoryRow['CategoryID'];
								$CategoryName = $GetCategoryRow['CategoryName'];
								?>
									
									
									<tr>
										<td><?php echo $Srnumber; ?></td>
										<td><?php echo $CategoryName; ?></td>
										<td><a href="ManageCategories.php?EditCategory=<?php echo $CategoryID;?>" class="btn btn-primary">Edit</a></td>
									</tr>
							
								<?php
								
								$Srnumber++;	
							}
							?>
								</table>
							<?php
						}
						else
						{
							echo "<h3 class=\"text-center\">No Categories Found</h3>";	
						}
					}
					else
					{
						$EditCategory = CleanData($_GET['EditCategory']);
						
						/* Select Catname for update */
						$GetCatQ = "select * from category where CategoryID='$EditCategory';";
						
						$GetCatQR = mysqli_query($con,$GetCatQ);
						
						$GetCatRow = mysqli_fetch_assoc($GetCatQR);
						
						$UpdateCategoryID = $GetCatRow['CategoryID'];
						
						$UpdateCategoryName = $GetCatRow['CategoryName']
						
						?>
                        	<form role="form" class="category-form" method="post" action="">
             
                            <h2>Update Category </h2>
                            <hr class="colorgraph">
                
                            <div class="form-group">
                                <input type="text" value="<?php echo $UpdateCategoryName;?>" name="UCatName" id="catname" class="form-control input-lg" placeholder="Update Category Name" tabindex="1">
                                <input type="hidden" name="UpdateCategoryID" value="<?php echo $UpdateCategoryID?>" />
                            </div>
                            
                            <hr class="colorgraph">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <input type="submit" name="UCreateCategory" value="Update Category" class="btn btn-primary btn-block btn-lg" tabindex="2">
                                </div>
                            </div>
                        </form>
						<?php
					}
					
				?>
            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->

<?php include('footer.php')?>