<?php include('top.php');
require_once('Session-set.php');
if(isset($_POST['CreateCategory']))
{
	$CategroryID = CleanData($_POST['CategroryID']);
	
	$SubCatName = CleanData($_POST['SubCatName']);
	
	$CategoryQ = "insert into subcat(CatID,SubCatNam)
				 value('$CategroryID','$SubCatName');";
	
	$CategoryQR = mysqli_query($con,$CategoryQ);
	
	if($CategoryQR)
	{
		echo "<h3 class=\"text-center\">Sub Category Addedd Successfully</h3>";
	}
	else
	{
		echo "<h3 class=\"text-center\">Please Try Again</h3>";
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
					<li class="active">Create Sub Category</li>
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
            	<form role="form" class="category-form" method="post" action="">
     
                    <h2>Create Sub Category</h2>
                    <hr class="colorgraph">
        			
                    <div class="form-group">
                    	<select name="CategroryID" class="form-control input-lg" >
                        	<option value="">Select A Category</option>
                            <?php 
								$GetCatQ = "
									select * from category order by CategoryID desc;
								";
								$GetCatQR = mysqli_query($con,$GetCatQ);
								
								if(mysqli_num_rows($GetCatQR))
								{
									while($GetCatRow = mysqli_fetch_assoc($GetCatQR))
									{
										$CategoryID = $GetCatRow['CategoryID'];
										$CategoryName = $GetCatRow['CategoryName'];	
										?>
                                        	<option value="<?php echo $CategoryID?>"><?php echo $CategoryName?></option>
										<?php
										
									}
								}
								
								
							?>
                        </select>
                        
                    </div>
                    
                    <div class="form-group">
                        <input type="text" name="SubCatName" id="catname" class="form-control input-lg" placeholder="Sub Category Name" tabindex="1">
                    </div>
                    
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                        	<input type="submit" name="CreateCategory" value="Create Sub Category" class="btn btn-primary btn-block btn-lg" tabindex="2">
                        </div>
                    </div>
                </form>
            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->

<?php include('footer.php')?>