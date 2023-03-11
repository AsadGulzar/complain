<?php include('top.php');
require_once('Session-set.php');


if(isset($_POST['Complain']))
{
	$UserID = CleanData($_POST['UserID']);
	$CategoryId = CleanData($_POST['CategoryId']);
	$Title = CleanData($_POST['Title']);
	$SubTitle = CleanData($_POST['SubTitle']);
	$Description = CleanData($_POST['Description']);
	$ComplainType = CleanData($_POST['ComplainType']);
	$ComplainImage = CleanData($_FILES['ComplainImage']['name']);
	
	if(empty($ComplainImage))
	{
		$InsertComplainQ = "insert into complain (ComplainUserId,ComplainCategoryID,
						Title,SubTitle,Description,ComplainType,Status,ComplainTime)
						values ('$UserID','$CategoryId','$Title','$SubTitle',
						'$Description','$ComplainType','Under Progress',now()) ";
			
		$InsertComplainQR = mysqli_query($con,$InsertComplainQ);
		
		if($InsertComplainQR)
		{
			echo "<h3 class=\"text-center\">Complain Added Successfully.</h3>";
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
			
			$InsertComplainQ = "insert into complain (ComplainUserId,ComplainCategoryID,
						Title,SubTitle,Description,ComplainImage,ComplainType,Status,ComplainTime)
						values('$UserID','$CategoryId','$Title','$SubTitle','$Description','$CImage','$ComplainType','Under Progress',now()) ";
			
			$InsertComplainQR = mysqli_query($con,$InsertComplainQ);
			
			if($InsertComplainQR)
			{
				$TempName = $_FILES['ComplainImage']['tmp_name'];
				$Destination = 'ComplainImages/'.$CImage;
				$MV = move_uploaded_file($TempName,$Destination);
						
				echo "<h3 class=\"text-center\">Complain Added Successfully.</h3>";
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
					<li class="active">Dashboard</li>
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
            	<form role="form" class="complain-form" action="" method="post" enctype="multipart/form-data">
                    <h2>Create Complain</h2>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                            	<input type="hidden" name="UserID" value="<?php echo $UserID;?>" />
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
                                        	<option value="<?php echo $CategoryID; ?>"><?php echo $CategoryName;?></option>
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
                    	<input type="text" class="form-control input-lg" name="Title" placeholder="Title" tabindex="3">
                    </div>
                    <div class="form-group">
                    	<textarea rows="10" class="form-control" name="Description" placeholder="Description" tabindex="3" required></textarea>
                    </div>
                    <div class="form-group">
                    	<select name="ComplainType" required class="form-control input-lg" tabindex="4">
                        	<option value="Normal">Normal</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" name="ComplainImage" accept="image/*" id="complainImg" class="form-control input-lg" tabindex="5">
                        <p class="help-block text-succedd"><b>Upload A image</b></p>
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6"><input type="submit" value="SUBMIT COMPLAIN" class="btn btn-primary btn-block btn-lg" tabindex="6" name="Complain"></div>
                        
                    </div>
                </form>
            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->

<?php include('footer.php')?>