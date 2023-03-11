<?php
include('top.php');
require('Session-not-set.php');
if(isset($_POST['Login']))
{
	$Email = CleanData($_POST['Email']);
	$Password = CleanData($_POST['Password']);
	
	$LoginQ = "select * from admin where email='$Email' and password='$Password';";
	
	$LoginQR = mysqli_query($con,$LoginQ);
	
	$LoginNR = mysqli_num_rows($LoginQR);
	
	if($LoginNR == 1 )
	{
		$LoginRow = mysqli_fetch_assoc($LoginQR);
		$_SESSION['Admin_ID'] = $LoginRow['AdminID'];
		$_SESSION['Admin_Email'] = $LoginRow['email'];
		$_SESSION['Amin_Password'] = $LoginRow['password'];
		
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
				<div class="col-xs-12 col-md-6">Don't have an account? <a href="register.php">Register</a></div>
			</div>
		</form>
	</div>
</div>

</div>
	</section>

<?php
include('footer.php');
?>