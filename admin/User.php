<?php include('top.php');
require_once('Session-set.php');
if(isset($_GET['DeleteUser']))
{
	$DeleteUserID = $_GET['DeleteUser'];
	$DUserQ = mysqli_query($con,"
		DELETE FROM users where UserId='$DeleteUserID'
	");
	if($DUserQ)
	{
		?>
        <script>window.location="User.php?Msg=Deleted";</script>
		<?php
	}
	else
	{
		?>
        <script>window.location="User.php?Msg=Error";</script>
		<?php
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
					<li class="active">User</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="content-wraper">
	<div class="container">
    	<div class="row">
            <div class="col-sm-12">
            	<h4 class="text-center">
                	<?php
                    	if(isset($_GET['Msg']))
						{
							if($_GET['Msg']=='Deleted')
							{
								echo "User Deleted Successfully";
							}
							else if($_GET['Msg']=='Error')
							{
								echo "Please Try Again";
							}
						}
					?>
                </h4><br>
            	<?php
                	$GetUserQR = mysqli_query($con,"select * from users order by 
								UserId desc");
					
					if(mysqli_num_rows($GetUserQR)>0)
					{
					?>
                    <table class="table table-striped tabled-bordered">
                    	<tr>
                        	<th>Sr Number</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Cnic</th>
                            <th>City Councli</th>
                            <th>City</th>
                            <th>Delete</th>
                        </tr>
					<?php
						$SrNumber = 1;
						while($UserRow = mysqli_fetch_assoc($GetUserQR))
						{
							$Name = $UserRow['Name'];
							$UserId = $UserRow['UserId'];
							$Email = $UserRow['Email'];
							$Cnic = $UserRow['Cnic'];
							$CityCouncil = $UserRow['CityCouncil'];
							$City = $UserRow['City'];
							?>
                        		<tr>
                                    <th><?php echo $SrNumber;?></th>
                                    <th><?php echo $Name;?></th>
                                    <th><?php echo $Email;?></th>
                                    <th><?php echo $Cnic;?></th>
                                    <th><?php echo $CityCouncil;?></th>
                                    <th><?php echo $City;?></th>
                                    <th><a href="User.php?DeleteUser=<?php echo $UserId;?>" class="btn btn-danger">Delete</a></th>
                                </tr>    	
							<?php
							$SrNumber++;
						}
						
						?>
                        </table>
                        <?php
					}
					else
					{
						echo "<h3 class=\"text-cenetr\">No User Found</h3>";	
					}
				?>
            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->

<?php include('footer.php')?>