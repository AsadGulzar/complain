<?php include('top.php');
require_once('Session-set.php');
$Admin_ID = CleanData($_SESSION['Admin_ID']);

if(isset($_POST['UpdatePassword']))
{
	$Password = CleanData($_POST['Password']);
	
	$UpdateQ = "update admin set password='$Password' where AdminID='$Admin_ID'";
	if(mysqli_query($con,$UpdateQ))
	{
		echo "<h3 class=\"text-center\">Password Updated</h3>";
	}
	else
	{
		echo "<h3 class=\"text-center\">please try Again</h3>";
	}
}
?>
<script>
function Validate()
{
	var p1 = document.getElementById("password1").value;
	var p2 = document.getElementById("password2").value;
	if(p1=='' || p2=='')
	{
		document.getElementById("Msg").innerHTML="Please Write New Password" ;
		return false;
	}
	else if(p1!=p2)
	{
		document.getElementById("Msg").innerHTML="Password Does Not Match" ;
		return false;
	}
}
</script>
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
            	
                <form class="form-horizontal" action="" method="post">
                  <h2>Update Password</h2>
                  <hr class="colorgraph">
                  	<h4 class="text-center text-danger" style="min-height:40px; " id="Msg"></h4>
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">New Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" id="password1" placeholder="New Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">Repeat Password</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="Password" id="password2" placeholder="Repeat Password">
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" onClick="return Validate()" name="UpdatePassword" class="btn btn-primary">Update Password</button>
                    </div>
                  </div>
                </form>
            	
            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->

<?php include('footer.php')?>	
