<?php include('top.php');
require_once('Session-set.php');
if(isset($_GET['ReviewId']))
{
	$ComlainID = $_GET['ReviewId'];
	
	$UpdateComlainQ = "update complain set Status='Under Review' where ComplainId='$ComlainID';";
	
	$UpdateComlainQR = mysqli_query($con,$UpdateComlainQ);
	
	if($UpdateComlainQR)
	{
		?>
        	<script>alert('Complain Status Updated');</script>
            <script>window.location='ComplainRequests.php';</script>
		<?php
		die();
	}
	else
	{
		echo "<h3 class=\"text-center\">Please again Try To Update</h3>";
	}
	
}

if(isset($_GET['CompleteId']))
{
	$ComlainID = $_GET['CompleteId'];
	
	$UpdateComlainQ = "update complain set Status='Completed' where ComplainId='$ComlainID';";
	
	$UpdateComlainQR = mysqli_query($con,$UpdateComlainQ);
	
	if($UpdateComlainQR)
	{
		
		/* Get User Id Start */
		$GetComplainU = "select * from complain where ComplainId='$ComlainID';";
		$GetComplainR = mysqli_query($con,$GetComplainU);
		$GetComplainRow = mysqli_fetch_assoc($GetComplainR);
		$UserId = $GetComplainRow['ComplainUserId'];
		/* Get User Id  Ends */		
		
		/* Get User Email Address Starts */
		$GetUserE = "select * from users where UserId='$UserId';";
		$GetUserER = mysqli_query($con,$GetUserE);
		$GetUserERow = mysqli_fetch_assoc($GetUserER);
		$UserEmail = $GetUserERow['Email'];
		
		
		
		
		$to = $UserEmail;
		$Subject = 'Complain FeedBack';
		$Message = 'your Complain Number '.$ComlainID.' is Completed. Please give us your FeedBack...';
		mail($to,$Subject,$Message);
		?>
        	<script>alert('Complain Status Updated');</script>
            <script>window.location='SolveComplains.php';</script>
		<?php
		die();
	}
	else
	{
		echo "<h3 class=\"text-center\">Please again Try To Update</h3>";
	}
	
}

if(isset($_GET['DeleteId']))
{
	$ComlainID = $_GET['DeleteId'];	
	
	$DeleteComlainQ = "delete from complain where ComplainId='$ComlainID';";
	
	$DeleteComlainQR = mysqli_query($con,$DeleteComlainQ);
	
	if($DeleteComlainQR)
	{
		?>
        	<script>alert('Complain Deleted');</script>
            <script>window.location='ComplainRequests.php';</script>
		<?php
		die();
	}
	else
	{
		echo "<h3 class=\"text-center\">Please again Delete</h3>";
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
					<li class="active">Complain Detail</li>
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
					if(isset($_GET['ViewDetail']))
					{
						$ComlainId = $_GET['ViewDetail'];
						
						$GetComplainQ = "select * from complain where ComplainId='$ComlainId' order by ComplainId desc";
						
						$GetComplainQR = mysqli_query($con,$GetComplainQ);
						
						if(mysqli_num_rows($GetComplainQR)>0)
						{
							$GetComplainRow = mysqli_fetch_assoc($GetComplainQR);
							$ComplainId = $GetComplainRow['ComplainId'];
							$ComplainUserId = $GetComplainRow['ComplainUserId'];
							$Title = $GetComplainRow['Title'];
							$SubCatId = $GetComplainRow['SubTitle'];
							$Description = $GetComplainRow['Description'];
							$ComplainImage = $GetComplainRow['ComplainImage'];
							$ComplainType = $GetComplainRow['ComplainType'];
							$Status = $GetComplainRow['Status'];
							$ComplainTime = $GetComplainRow['ComplainTime'];

							$ComplainCategoryID = $GetComplainRow['ComplainCategoryID'];
							
							/* Get Complain Category Information */
														
							$GetCategoryQ = "select * from category where 
							CategoryID=$ComplainCategoryID";
							
							$GetCategoryQR = mysqli_query($con,$GetCategoryQ);
							
							$GetCategoryRow = mysqli_fetch_assoc($GetCategoryQR);
							
							$CategoryName = $GetCategoryRow['CategoryName'];
							
							/* Get User Information */
							
							$getUserQ = "select * from users where Userid='$ComplainUserId';";
							
							$getUserQR = mysqli_query($con,$getUserQ);
							
							$getUserRow = mysqli_fetch_assoc($getUserQR);
							
							$Name = $getUserRow['Name'];
							$Cnic = $getUserRow['Cnic'];
							$Phone = $getUserRow['Phone'];
							$CityCouncil = $getUserRow['CityCouncil'];
							$Address = $getUserRow['Address'];
							$City = $getUserRow['City'];
							
							/* Get Sub Cat name by id */
							
							$SubCatQ= "select * from subcat where SubCatId='$SubCatId'";
							$SubCatQR = mysqli_query($con,$SubCatQ);
							$SubCatRow = mysqli_fetch_assoc($SubCatQR);
							$SubCatNam = $SubCatRow['SubCatNam'];
							
							
							?>
							<article>
								<div class="post-image">
									<div class="post-heading">
										<h3><a class="red-color-text"><?php echo $Title;?></a></h3>
									</div>
									<?php
									if(empty($ComplainImage))
									{
										?>
										<img src="../img/placeholder.jpg" alt="" class="img-responsive main-thumbail" />
										<?php
									}
									else
									{
										?>
										<img src="../ComplainImages/<?php echo $ComplainImage; ?>" alt="" class="img-responsive main-thumbail" />
										<?php
									}
									
									?>
									
								</div>
								
								<div class="bottom-article">
									<ul class="meta-post">
										<li><i class="fa fa-database"></i><a class="red-color-text"> <?php echo $ComplainId;?></a></li>
										<li><i class="fa fa-calendar"></i><a class="red-color-text"> <?php echo $ComplainTime;?></a></li>
										<li><i class="fa fa-tags"></i><a class="red-color-text"> <?php echo $CategoryName;?></a></li>
                                        <li><i class="fa fa-tags"></i><a class="red-color-text"> <?php echo $SubCatNam;?></a></li>
										
										<li><i class="fa fa-flag"></i><a class="red-color-text"> <?php echo $Status;?></a></li>
                                        <?php
											
											if($Status == 'Under Progress')
											{
												?>
                                                	<li><a href="complainDetail.php?ReviewId=<?php echo $ComplainId;?>" style="color:#fff;" class="btn btn-primary"> Submit For Review</a></li>
                                        <li><a href="complainDetail.php?DeleteId=<?php echo $ComplainId;?>" style="color:#fff;" class="btn btn-danger"> Deleted</a></li>
												<?php
											}
											else if($Status == 'Under Review')
											{
												?>
                                                <li><a href="complainDetail.php?CompleteId=<?php echo $ComplainId;?>" style="color:#fff;" class="btn btn-primary">Mark as Completed</a></li>
                                        <!--li><a href="complainDetail.php?DeleteId=<?php echo $ComplainId;?>" style="color:#fff;" class="btn btn-danger"> Deleted</a></li-->
												<?php
											}
											else
											{
												?>
                                                <li></li>
                                       
												<?php
											}
                                        ?>
                                       
							
									</ul>
									
								</div>
                                <hr>
                                <p>
                                 <?php 
                                    echo $Description;
                                 ?>
								</p>
                                <hr>
                                <ul class="meta-post">
                                    <li><i class="fa fa-user"></i><a class="red-color-text"> <?php echo $Name;?></a></li>
                                    <li><i class="fa fa-calendar"></i><a class="red-color-text"> <?php echo $Cnic;?></a></li>
                                    <li><i class="fa fa-phone"></i><a class="red-color-text"> <?php echo $Phone;?></a></li>
                                    <li><i class="fa fa-map-marker"></i><a class="red-color-text"> <?php echo $Address.' '.$City;?></a></li>
                                    <li><i class="fa fa-flag"></i>City Counsel<a class="red-color-text"> <?php echo $CityCouncil;?></a></li>
                                </ul>
							</article>
							<?php
						}
						else
						{
							//echo mysqli_error($con);
							echo "<h4 class=\"text-center\">No Complain Found</h4>";
						}
					}
					else
					{
						
					}
				?>
            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->

<?php include('footer.php')?>