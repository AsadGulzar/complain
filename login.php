<?php
include('top.php');
require('Session-not-set.php');
if(isset($_POST['Login']))
{
	$Email = CleanData($_POST['Email']);
	$Password = CleanData($_POST['Password']);
	
	$LoginQ = "select * from users where Email='$Email' and Password='$Password';";
	
	$LoginQR = mysqli_query($con,$LoginQ);
	
	$LoginNR = mysqli_num_rows($LoginQR);
	
	if($LoginNR == 1 )
	{
		$LoginRow = mysqli_fetch_assoc($LoginQR);
		$_SESSION['User_ID'] = $LoginRow['UserId'];
		$_SESSION['User_Email'] = $LoginRow['Email'];
		$_SESSION['User_Password'] = $LoginRow['Password'];
		
		?>
        	<script>window.location='dashboard.php'</script>
		<?php
		die();
		
	}
	else
	{
		echo "<h3 class=\"text-center\">Please Try Again </h3>";
	}
	
	
}
if(isset($_POST['ForgotPass']))
{
	$ForgotEmail = CleanData($_POST['ForgotEmail']);
	
	$CheckUserQ = "select * from users where Email='$ForgotEmail'";
	
	$CheckUserQR = mysqli_query($con,$CheckUserQ);
	
	if(mysqli_num_rows($CheckUserQR)>0)
	{
		$CheckUserRow =  mysqli_fetch_assoc($CheckUserQR);
		$Email = $CheckUserRow['Email'];
		$Password = $CheckUserRow['Password'];
		$to = $Email;
		$Subject = "Recover Password ";
		$Msg = "Your Password is".$Password ;
		$Mail = mail($to,$Subject,$Msg);
		
		if($Mail)
		{
			echo "<h3 class=\"text-center\">Your Password Send to Your Email.</h3>";
		}
	}
	else
	{
		echo "<h3 class=\"text-center\">This email not associated with any account.</h3>";
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
					<li class="active">Login</li>
				</ul>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
<div class="container">

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form" class="register-form" method="post" action="">
			<h2>Sign in <small>manage your account</small></h2>
			<hr class="colorgraph">

			<div class="form-group">
				<input type="email" name="Email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="1">
			</div>
			<div class="form-group">
				<input type="password" name="Password" class="form-control input-lg" id="exampleInputPassword1" tabindex="2" placeholder="Password">
			</div>

			<div class="row">
				<div class="col-xs-4 col-sm-3 col-md-3">
					<span class="button-checkbox">
						<button type="button" class="btn" data-color="info" tabindex="7">Remember me</button>
                        <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" value="1">
					</span>
				</div>
			</div>
			
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6"><input type="submit" name="Login" value="Sign in" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
				<div class="col-xs-12 col-md-6"> <a href="#" data-toggle="modal" data-target="#myModal">Forgot Password?</a></div>
			</div>
		</form>
	</div>
</div>

</div>
	</section>

<?php
include('footer.php');
?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Please Enter Your Email Address</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="ForgotEmail" class="form-control" id="exampleInputEmail1" placeholder="Email">
          </div>
         
          <button type="submit" name="ForgotPass" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>