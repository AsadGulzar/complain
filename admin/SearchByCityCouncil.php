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
					<li class="active">Complain Requests</li>
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
                    	if(isset($_POST['SearchComplain']))
						{
							$CityCouncil = CleanData($_POST['CityCouncil']);
							
							$GetUserQ = "select * from users where CityCouncil=
							'$CityCouncil' order by UserId desc";
							
							$GetUserQR = mysqli_query($con,$GetUserQ);
							
							if(mysqli_num_rows($GetUserQR)>0)
							{
								while($GetUserRow = mysqli_fetch_assoc($GetUserQR))
								{
									
									$UserId = $GetUserRow['UserId'];
									
									$GetComplainQ = "select * from complain where 
									ComplainUserId='$UserId' order by ComplainId desc";
									
									$GetComplainQR = mysqli_query($con,$GetComplainQ);
									echo mysqli_num_rows($GetComplainQR);
									exit();
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
										
										$GetCategoryQ = "select * from category where 
										CategoryID=$ComplainCategoryID";
										
										$GetCategoryQR = mysqli_query($con,$GetCategoryQ);
										
										$GetCategoryRow = mysqli_fetch_assoc($GetCategoryQR);
										
										$CategoryName = $GetCategoryRow['CategoryName'];
	
										
										$SubCatQ= "select * from subcat where SubCatId='$SubCatId'";
										$SubCatQR = mysqli_query($con,$SubCatQ);
										$SubCatRow = mysqli_fetch_assoc($SubCatQR);
										$SubCatNam = $SubCatRow['SubCatNam'];
										
										?>
										<article>
											<div class="post-image">
												<div class="post-heading">
													<h3><a href="#"><?php echo $Title;?></a></h3>
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
											<p>
												 <?php 
												 echo substr($Description,0,200);
												 ?>
											</p>
											<div class="bottom-article">
												<ul class="meta-post">
													<li><i class="fa fa-database"></i><a href="#"> <?php echo $ComplainId;?></a></li>
													<li><i class="fa fa-calendar"></i><a href="#"> <?php echo $ComplainTime;?></a></li>
													<li><i class="fa fa-tags"></i><a href="#"> <?php echo $CategoryName;?></a></li>
													<li><i class="fa fa-tags"></i><a class=""> <?php echo $SubCatNam;?></a></li>
													<li><i class="fa fa-flag"></i><a href="#"> <?php echo $ComplainType;?></a></li>
													<li><i class="fa fa-flag"></i><a href="#"> <?php echo $Status;?></a></li>
													
												</ul>
												<a href="complainDetail.php?ViewDetail=<?php echo $ComplainId;?>" class="readmore pull-right">Read More <i class="fa fa-angle-right"></i></a>
											</div>
										</article>
									<?php
										
									}
									else
									{
										echo "<h3 class=\"text-center\">No User Found.</h3>";
									}
									
									
									
											
								}
							die();
							}
							else
							{

								echo "<h3 class=\"text-center\">No Record Found</h3>";
								die();
							}
							
						}
					?>
            	<form action="" method="post">
            	    <h2>Search City Council Wise<small>Select City Council</small></h2>
                    <hr class="colorgraph">
        			<div class="col-sm-12">
                    	<div class="form-group">
                        	<select required class="form-control input-lg" name="CityCouncil" >
                            	<?php
                                	$GetCouncilQ = "select distinct CityCouncil
										from users";
									$GetCouncilQR = mysqli_query($con,$GetCouncilQ);
									
									if(mysqli_num_rows($GetCouncilQR)>0)
									{
										while($row = mysqli_fetch_assoc($GetCouncilQR))
										{
											?>
                                            <option><?php echo $row['CityCouncil'];?></option>
											<?php	
										}
										
									}
								?>
                            </select>
                        	
                    	</div>
                    </div>
                    
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                        	<input type="submit" name="SearchComplain" value="Search Complain" class="btn btn-primary btn-block btn-lg" tabindex="3">
                        </div>
                       
                    </div>
                    </form>
            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->

<?php include('footer.php')?>	
