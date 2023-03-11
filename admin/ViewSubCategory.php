<?php include('top.php');
require_once('Session-set.php');
if(isset($_POST['SubCatUpdate']))
{
	$SubCatId = CleanData($_POST['SubCatId']);
	$SubCatNam = CleanData($_POST['SubCatNam']);
	
	$CategoryQ = "update subcat set SubCatNam='$SubCatNam' where SubCatId='$SubCatId';";
	
	$CategoryQR = mysqli_query($con,$CategoryQ);
	
	if($CategoryQR)
	{
		echo "<h3 class=\"text-center\">Successfully Updated</h3>";
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
					if(!isset($_GET['EditSubCategory']))
					{
						$SubCategoryQ = "
							select c.CategoryID, c.CategoryName , s.SubCatId,
							s.CatID,  s.SubCatNam from category c inner join
							subcat s on s.CatID=c.CategoryID;
						";
						$SubCategoryQR = mysqli_query($con,$SubCategoryQ);
						$SubCategoryNr = mysqli_num_rows($SubCategoryQR);
						
						if($SubCategoryNr>0)
						{
							?>
								<table class="table table-bordered table-striped">
									<tr>
										<th>SR Number</th>
										<th>Category Name</th>
                                        <th>Sub Category Name</th>
										<th>Edit</th>
									</tr>
							<?php
							$Srnumber = 1;
							while($SubCategoryRow = mysqli_fetch_assoc($SubCategoryQR))
							{
								$CategoryID = $SubCategoryRow['CatID'];
								$SubCatId = $SubCategoryRow['SubCatId'];
								$SubCatNam = $SubCategoryRow['SubCatNam'];
								$CategoryName = $SubCategoryRow['CategoryName'];
								?>
									
									
									<tr>
										<td><?php echo $Srnumber; ?></td>
										<td><?php echo $CategoryName; ?></td>
                                        <td><?php echo $SubCatNam; ?></td>
                                        
										<td><a href="ViewSubCategory.php?EditSubCategory=<?php echo $SubCatId;?>" class="btn btn-primary">Edit</a></td>
									</tr>
							
								<?php
								
								$Srnumber++;	
							}
							?>
								</table>
							<?php
						}
						else
						{//echo mysqli_error($con);
							echo "<h3 class=\"text-center\">No Sub Categories Found</h3>";	
						}
					}
					else
					{
						$EditSubCategory = CleanData($_GET['EditSubCategory']);
						
						/* Select Sub Catname for update */
						$SubCatQ = "select * from subcat where 
								SubCatId='$EditSubCategory';";
						
						$SubCatQR = mysqli_query($con,$SubCatQ);
						
						$SubCatRow = mysqli_fetch_assoc($SubCatQR);
						
						$SubCatId = $SubCatRow['SubCatId'];
						
						$SubCatNam = $SubCatRow['SubCatNam']
						
						?>
                        	<form role="form" class="category-form" method="post" action="">
             
                            <h2>Update Category </h2>
                            <hr class="colorgraph">
                
                            <div class="form-group">
                                <input type="text" value="<?php echo $SubCatNam;?>" name="SubCatNam" id="catname" class="form-control input-lg" placeholder="Update Category Name" tabindex="1">
                                <input type="hidden" name="SubCatId" value="<?php echo $SubCatId?>" />
                            </div>
                            
                            <hr class="colorgraph">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <input type="submit" name="SubCatUpdate" value="Update Category" class="btn btn-primary btn-block btn-lg" tabindex="2">
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