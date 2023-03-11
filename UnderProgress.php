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
					<li class="active">Complain Under Progress</li>
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
					
					$start=0;
					$limit=3;
					if(isset($_GET['page']))
					{
						$page=$_GET['page'];
						$start=($page-1)*$limit;
					}
							   
					else 
					{
						$page=1;
					}
						
					$GetComplainQ = "select * from complain where Status='Under Progress' and ComplainUserId='$UserID' order by ComplainId desc limit $start,$limit";
					$GetComplainQR = mysqli_query($con,$GetComplainQ);
					
					$GetNumQ = mysqli_query($con,"select * from complain where Status='Under Progress' and ComplainUserId='$UserID' order by ComplainId desc");
					$TotalComplain = mysqli_num_rows($GetNumQ);
					$total=ceil($TotalComplain/$limit);
						
					
					if(mysqli_num_rows($GetComplainQR)>0)
					{
						while($GetComplainRow = mysqli_fetch_assoc($GetComplainQR))
						{
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
							
							/* Get Sub Cat name by id */
							
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
                                        <li><i class="fa fa-tags"></i><a href="#"> <?php echo $SubCatNam;?></a></li>
										<li><i class="fa fa-flag"></i><a href="#"> <?php echo $ComplainType;?></a></li>
										<li><i class="fa fa-flag"></i><a href="#"> <?php echo $Status;?></a></li>
										<!--li><i class="fa fa-comments"></i><a href="#">4 Comments</a></li-->
									</ul>
									<a href="complainDetail.php?ViewDetail=<?php echo $ComplainId;?>" class="readmore pull-right">Read More <i class="fa fa-angle-right"></i></a>
								</div>
							</article>
							<?php
							}
						?>
                        <nav>
                              <ul class="pagination">
                                <?php
                                if($page>1)
                                { 
                                    ?>
                                    <li>
                                      <a href="?page=<?php echo $page-1;?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                      </a>
                                    </li>
                                    <?php 
                                } 
                                
                                for($i=1;$i<=$total;$i++)
                                {
									
                                    ?>
                                    
                                    <li><a href="?page=<?php echo $i  ?>"><?php echo $i;?></a></li>    
                                    <?php
                                }
                                
                                if($page<$total)
                                { 
                                 ?>
                                <li>
                                  <a href="?page=<?php echo $page+1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                  </a>
                                </li>
                                <?php
								}
								?>
                              </ul>
                            </nav>
						<?php	
						}
						else
						{
							//echo mysqli_error($con);
							echo "<h4 class=\"text-center\">No Complain Found</h4>";
						}
					?>
            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->

<?php include('footer.php')?>	