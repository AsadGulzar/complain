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
					
					$GetComplainQ = "select * from complain where Status='Completed'
									order by ComplainId desc limit $start,$limit;";
					$GetComplainQR = mysqli_query($con,$GetComplainQ);
					
					
					$GetNumQ = mysqli_query($con,"select * from complain where
						 Status='Completed' order by ComplainId desc ");
						
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
							$Rating = $GetComplainRow['Rating'];
							$FeedBack = $GetComplainRow['FeedBack'];
		
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
							<div class="post-heading">
								<h3><a class="red-color-text"><?php echo $Title;?></a></h3>
							</div>
							<hr>
							
							<div class="bottom-article">
								<ul class="meta-post">
									<li><i class="fa fa-database"></i><a class="red-color-text"> <?php echo $ComplainId;?></a></li>
									<li><i class="fa fa-calendar"></i><a class="red-color-text"> <?php echo $ComplainTime;?></a></li>
									<li><i class="fa fa-tags"></i><a class="red-color-text"> <?php echo $CategoryName;?></a></li>
                                    <li><i class="fa fa-tags"></i><a class="red-color-text"> <?php echo $SubCatNam;?></a></li>
									<li><i class="fa fa-flag"></i><a class="red-color-text"> <?php echo $ComplainType;?></a></li>
									<li><i class="fa fa-flag"></i><a class="red-color-text"> <?php echo $Status;?></a></li>
									
								</ul>
									
							</div>
							<?php
								if(empty($Rating))
								{
									?>
										<div id="FeedBackWraper">
											<h3>No Feed Back Given</h3>
										</div><!-- FeedBackWraper end here -->
										<div id="FeedBackResponce">
										
										</div>
										<hr class="colorgraph">
									<?php
								}
								else
								{
									echo "<h3>Feed Back Given</h3>";
									?>
										<p><?php echo $FeedBack?></p>
										<input readonly type="text" id="stars"  class="kv-uni-star rating-loading" value="<?php echo $Rating;?>" data-size="sm" tabindex="2" title="">
										<hr class="colorgraph">
									<?php
								}
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
				?>
            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->

<?php include('footer.php')?>