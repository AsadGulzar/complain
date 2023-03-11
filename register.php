<?php
include('top.php');
require('Session-not-set.php');
if(isset($_POST['Register']))
{
	$FirstName = CleanData($_POST['FirstName']);
	$LastName = CleanData($_POST['LastName']);
	$Email = CleanData($_POST['Email']);
	$Password = CleanData($_POST['Password']);
	$Cnic = CleanData($_POST['Cnic']);
	$Phone = CleanData($_POST['Phone']);
	$CityCounsle = CleanData($_POST['CityCounsle']);
	$City = CleanData($_POST['City']);
	$Address = CleanData($_POST['Address']);
	$FullName = $FirstName.' '.$LastName;
	
	$RegQ = "insert into users(Name,Email,Password,Cnic,Phone,CityCouncil,Address,City) 
			values('$FullName','$Email','$Password','$Cnic','$Phone','$CityCounsle','$Address','$City' )";
	$RegQR = mysqli_query($con,$RegQ);
	
	if($RegQR)
	{
		?>
        	<script>window.location='login.php';</script>
		<?php
		die();
	}
	else
	{
		//echo mysqli_error($con);
		echo "<h3 class=\"text-center\">Please Try Again</h3>";
	}
	
}
?>
<script>
//alert();
function validateForm(){
	
	//alert();
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaExp2 = /^[0-9]+$/;
	var FN = document.getElementById("first_name").value;
	//alert(FN);
	if (!FN.match(alphaExp))
	{
		alert("Invalid First name. Only A-Z a-z charachters are acceptable");
		return false;
	}
	
	var LN = document.getElementById("last_name").value;
	//alert(LN);
	if (!LN.match(alphaExp))
	{
		alert("Invalid Last name. Only A-Z a-z charachters are acceptable");
		return false;
	}
	
	var CNIC = document.getElementById("cnic").value;
	//alert(CNIC);
	if (!CNIC.match(alphaExp2))
	{
		alert("Invalid CNIC. Only 0-9 numbers are acceptable");
		return false;
	}
	
	var PH = document.getElementById("phone").value;
	//alert(PH);
	if (!PH.match(alphaExp2))
	{
		alert("Invalid Last name. Only A-Z a-z charachters are acceptable");
		return false;
	}
	
	return true;
}
</script>
<section id="inner-headline">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<ul class="breadcrumb">
					<li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
					<li><a href="#">Features</a><i class="icon-angle-right"></i></li>
					<li class="active">Register</li>
				</ul>
			</div>
		</div>
	</div>
	</section>
	<section id="content">
<div class="container">

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form role="form" class="register-form" onsubmit="return validateForm()"; action="" method="post">
			<h2>Please Sign Up <small>It's free and always will be.</small></h2>
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                        <input type="text" name="FirstName" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="LastName" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="2">
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="email" name="Email" id="email" class="form-control input-lg" placeholder="Email" tabindex="3">
			</div>
			<div class="form-group">
				<input type="password" name="Password" id="password" class="form-control input-lg" placeholder="Password" tabindex="4">
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="number" name="Cnic" id="cnic" class="form-control input-lg" placeholder="CNIC" tabindex="5">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="number" name="Phone" id="phone" class="form-control input-lg" placeholder="Phone" tabindex="6">
					</div>
				</div>
			</div>
            <div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="CityCounsle" id="citycounsel" class="form-control input-lg" placeholder="City Counsel" tabindex="7">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="City" id="city" class="form-control input-lg" placeholder="City" tabindex="8">
					</div>
				</div>
			</div>
            <div class="form-group">
				<input type="text" name="Address" id="address" class="form-control input-lg" placeholder="Address" tabindex="9">
			</div>
			<div class="row">
				<div class="col-xs-4 col-sm-3 col-md-3">
					<span class="button-checkbox">
						<button type="button" class="btn" data-color="info" tabindex="10">I Agree</button>
                        <input type="checkbox" name="t_and_c" id="t_and_c" class="hidden" value="1">
					</span>
				</div>
				<div class="col-xs-8 col-sm-9 col-md-9">
					 By clicking <strong class="label label-primary">Register</strong>, you agree to the <a href="#" data-toggle="modal" data-target="#t_and_c_m">Terms and Conditions</a> set out by this site, including our Cookie Use.
				</div>
			</div>
			
			<hr class="colorgraph">
			<div class="row">
				<div class="col-xs-12 col-md-6"><input type="submit" value="Register" class="btn btn-theme btn-block btn-lg" tabindex="11" name="Register"></div>
				<div class="col-xs-12 col-md-6">Already have an account? <a href="login.php">Sign In</a></div>
			</div>
		</form>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
			</div>
			<div class="modal-body">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
	</section>
<?php
include('footer.php');
?>
