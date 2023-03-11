<?php
require('connection.php');
if(isset($_GET['ComplainID']))
{
	$ComplainId =  CleanData($_GET['ComplainID']);
	
	
	$GetComplainQ = "select * from complain where ComplainId='$ComplainId';";
					
					
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
		else
		{
			//echo mysqli_error($con);
			echo "<h4 class=\"text-center\">No Complain Found</h4>";
		}
	
}
?>