<?php include('top.php');
require_once('Session-set.php');
if(isset($_POST['CreateCategory']))
{
	$CatName = CleanData($_POST['CatName']);
	
	$CategoryQ = "insert into category(CategoryName) value('$CatName');";
	
	$CategoryQR = mysqli_query($con,$CategoryQ);
	
	if($CategoryQR)
	{
		?>
        <script>alert('Category Addedd Successfully')</script>
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
					<li class="active">Create Category</li>
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
     
                    <h2>Create Category </h2>
                    <hr class="colorgraph">
        
                    <div class="form-group">
                        <input type="text" name="CatName" id="catname" class="form-control input-lg" placeholder="Category Name" tabindex="1">
                    </div>
                    
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                        	<input type="submit" name="CreateCategory" value="Create Category" class="btn btn-primary btn-block btn-lg" tabindex="2">
                        </div>
                    </div>
                </form>
            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->

<?php include('footer.php')?>