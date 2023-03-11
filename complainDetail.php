<?php include('top.php');
require_once('Session-set.php');
?>
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
            	<?php 
					if(isset($_GET['ViewDetail']))
					{
						$ComlainId = $_GET['ViewDetail'];
						
						$GetComplainQ = "select * from complain where ComplainUserId='$UserID'   and ComplainId='$ComlainId' order by ComplainId desc";
						
						$GetComplainQR = mysqli_query($con,$GetComplainQ);
						
						if(mysqli_num_rows($GetComplainQR)>0)
						{
							$GetComplainRow = mysqli_fetch_assoc($GetComplainQR);
							$ComplainId = $GetComplainRow['ComplainId'];
							$Title = $GetComplainRow['Title'];
							$SubCatId = $GetComplainRow['SubTitle'];
							$Description = $GetComplainRow['Description'];
							$ComplainImage = $GetComplainRow['ComplainImage'];
							$ComplainType = $GetComplainRow['ComplainType'];
							$Status = $GetComplainRow['Status'];
							$ComplainTime = $GetComplainRow['ComplainTime'];

							$ComplainCategoryID = $GetComplainRow['ComplainCategoryID'];
							/* Get Cay Name by id */							
							$GetCategoryQ = "select * from category where 
							CategoryID=$ComplainCategoryID";
							
							$GetCategoryQR = mysqli_query($con,$GetCategoryQ);
							
							$GetCategoryRow = mysqli_fetch_assoc($GetCategoryQR);
							
							$CategoryName = $GetCategoryRow['CategoryName'];
							
							
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
									
								</div>
								
								<div class="bottom-article">
									<ul class="meta-post">
										<li><i class="fa fa-database"></i><a class="red-color-text"> <?php echo $ComplainId;?></a></li>
										<li><i class="fa fa-calendar"></i><a class="red-color-text"> <?php echo $ComplainTime;?></a></li>
										<li><i class="fa fa-tags"></i><a class="red-color-text"> <?php echo $CategoryName;?></a></li>
                                        <li><i class="fa fa-tags"></i><a class="red-color-text"> <?php echo $SubCatNam;?></a></li>
										<li><i class="fa fa-flag"></i><a class="red-color-text"> <?php echo $ComplainType;?></a></li>
										<li><i class="fa fa-flag"></i><a class="red-color-text"> <?php echo $Status;?></a></li>
										<!--li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li-->
									</ul>
									
								</div>
                                
                                <hr>
                                <p>
                                 <?php 
                                    echo $Description;
                                 ?>
								</p>
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