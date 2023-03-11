<?php include('top.php');
require_once('Session-set.php');
if(isset($_POST['UpdateComplain']))
{
	$UComplainId = CleanData($_POST['UComplainId']);
	$CategoryId = CleanData($_POST['CategoryId']);
	$Title = CleanData($_POST['Title']);
	$SubTitle = CleanData($_POST['SubTitle']);
	$Description = CleanData($_POST['Description']);
	$ComplainType = CleanData($_POST['ComplainType']);
	$ComplainImage = CleanData($_FILES['ComplainImage']['name']);
	
	if(empty($ComplainImage))
	{
		$UpdateComplainQ = "update complain set ComplainCategoryID='$CategoryId',
						Title='$Title',SubTitle='$SubTitle',Description='$Description',
						ComplainType='$ComplainType' where ComplainId='$UComplainId'";
			
		$UpdateComplainQR = mysqli_query($con,$UpdateComplainQ);
		
		if($UpdateComplainQR)
		{
			echo "<h3 class=\"text-center\">Complain Updated Successfully.</h3>";
			?>
				<script>window.location='dashboard.php'</script>
			<?php
		}
		else
		{
			echo  "<h3 class=\"text-center\">Please Try Again.</h3>";
		}
	}

	else
	{
		$CheckImg = explode('.',$ComplainImage);
		if($CheckImg[1] != 'exe')
		{
			$RandId = rand('1234',4);
			$CImage = $RandId.$ComplainImage;

			$UpdateComplainQ = "update complain set ComplainCategoryID='$CategoryId',
						Title='$Title',SubTitle='$SubTitle',Description='$Description',
						ComplainType='$ComplainType',ComplainImage='$CImage' where ComplainId='$UComplainId'";
			
			$UpdateComplainQR = mysqli_query($con,$UpdateComplainQ);
			
			if($UpdateComplainQR)
			{
				$TempName = $_FILES['ComplainImage']['tmp_name'];
				$Destination = 'ComplainImages/'.$CImage;
				$MV = move_uploaded_file($TempName,$Destination);
						
				echo "<h3 class=\"text-center\">Complain Updated Successfully.</h3>";
				?>
					<script>window.location='dashboard.php'</script>
				<?php
			}
			else
			{
				echo  "<h3 class=\"text-center\">Please Try Again.</h3>";
			}
		}
	
		else
		{
			echo "<h3 class=\"text-cenetr\">Please Upload A Image File.</h3>";
		}
	}
	
}
?>
<script>
function FetchSubCat()
{
	var CatName =  document.getElementById("CatName").value;
	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
		 
     document.getElementById("SubCatName").innerHTML = xhttp.responseText;
    }
  };
  	xhttp.open("GET", "FetchSubCategory.php?CatId="+CatName, true);
 	xhttp.send();
  
}
</script>


<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
					<li><a href="#">Features</a><i class="icon-angle-right"></i></li>
					<li class="active">Edit Complain</li>
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
					if(isset($_GET['ComplainID']))
					{
						$ComplainID = CleanData($_GET['ComplainID']);
						
						$GetComplainQ = "select * from complain where Status='Under Progress' and ComplainUserId='$UserID' and ComplainId='$ComplainID' ;";
						
						
						$GetComplainQR = mysqli_query($con,$GetComplainQ);
						
						if(mysqli_num_rows($GetComplainQR)>0)
						{
							$GetComplainRow = mysqli_fetch_assoc($GetComplainQR);
							$ComplainId = $GetComplainRow['ComplainId'];
							$Title = $GetComplainRow['Title'];
							$SubTitle = $GetComplainRow['SubTitle'];
							$Description = $GetComplainRow['Description'];
							$ComplainImage = $GetComplainRow['ComplainImage'];
							$ComplainType = $GetComplainRow['ComplainType'];
							$Status = $GetComplainRow['Status'];
							$ComplainTime = $GetComplainRow['ComplainTime'];

							$ComplainCategoryID = $GetComplainRow['ComplainCategoryID'];
							
							$GetCategoryQ = "select * from category where 
							CategoryID=$ComplainCategoryID";
							
							$GetCategoryQR = mysqli_query($con,$GetCategoryQ);
							
							$GetCategoryRow = mysqli_fetch_assoc($GetCategoryQR);
							
							$CategoryName = $GetCategoryRow['CategoryName'];
							
							?>
							<article>
                            	<form role="form" class="complain-form" action="" method="post" enctype="multipart/form-data">
                                    <h2>Update Complain</h2>
                                    <hr class="colorgraph">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <input type="hidden" name="UComplainId" value="<?php echo $ComplainId;?>" />
                                                <select onChange="FetchSubCat()" class="form-control input-lg" name="CategoryId" id="CatName" required>
                                                    <option>Select A Category</option>
                                                    <?php
                                                    
                                                    $GetCatQ = "select * from category order by CategoryID
                                                    desc;";
                                                    $GetCatQR = mysqli_query($con,$GetCatQ);
                                                    
                                                    while($GetCatRow = mysqli_fetch_assoc($GetCatQR))
                                                    {
                                                        $CategoryID = $GetCatRow['CategoryID'];
                                                        $CategoryName = $GetCatRow['CategoryName'];
                                                        ?>
                                                            <option  <?php if($CategoryID==$ComplainCategoryID){ echo " selected"; }?> value="<?php echo $CategoryID; ?>"><?php echo $CategoryName;?></option>
                                                        <?php
                                                    }
                                                    
                                                    ?>
                                                </select>
                                                  
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <select name="SubTitle" id="SubCatName" class="form-control input-lg">
                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    	<input type="text" name="Title" id="Title" class="form-control input-lg" value="<?php echo $Title;?>" placeholder="Title" tabindex="2" required>
                                        
                                    </div>
                                    <div class="form-group">
                                        <textarea rows="10" class="form-control" name="Description" placeholder="Description" tabindex="3" required><?php echo $Description?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <select name="ComplainType" required class="form-control input-lg" tabindex="4">
                                            <option <?php if($ComplainType=='Normal'){ echo "selected";}?> value="Normal">Normal</option>
                                            <option <?php if($ComplainType=='Medium'){ echo "selected";}?> value="Medium">Medium</option>
                                            <option <?php if($ComplainType=='High'){ echo "selected";}?> value="High">High</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                    <?php
                                    	if(empty($ComplainImage))
                                        {
                                            ?>
                                            <img src="img/placeholder.jpg" alt="" class="img-responsive main-thumbail" />
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <img src="ComplainImages/<?php echo $ComplainImage; ?>" alt="" class="img-responsive main-thumbail" />
                                            <?php
                                        }
										
										?>
                                        <br>
                                        <input type="file" name="ComplainImage" id="complainImg" class="form-control input-lg" tabindex="5">
                                        <p class="help-block text-succedd"><b>Upload A image</b></p>
                                    </div>
                                    <hr class="colorgraph">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6"><input type="submit" value="UPDATE COMPLAIN" class="btn btn-primary btn-block btn-lg" tabindex="6" name="UpdateComplain"></div>
                                        
                                    </div>
                                </form>
								
							</article>
							<?php
							
							}
							else
							{
								//echo mysqli_error($con);
								echo "<h4 class=\"text-center\">No Complain Found</h4>";
							}
						}
					?>
            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->

<?php include('footer.php')?>	