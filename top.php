<?php
session_start();
include('connection.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Complain Management System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Bootstrap 3 template for corporate business" />
<meta name="author" content="http://iweb-studio.com" />
<!-- css -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="plugins/flexslider/flexslider.css" rel="stylesheet" media="screen" />	
<link href="css/cubeportfolio.min.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" />
<!-- star rating css files-->
<link rel="stylesheet" href="css/star-rating.css" media="all" type="text/css"/>
<link rel="stylesheet" href="css/theme-krajee-fa.css" media="all" type="text/css"/>
<link rel="stylesheet" href="css/theme-krajee-svg.css" media="all" type="text/css"/>
<link rel="stylesheet" href="css/theme-krajee-uni.css" media="all" type="text/css"/>

<!-- Theme skin -->
<link id="t-colors" href="skins/default.css" rel="stylesheet" />

	<!-- boxed bg -->
	<link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />
    <!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="plugins/flexslider/jquery.flexslider-min.js"></script> 
<script src="plugins/flexslider/flexslider.config.js"></script>
<script src="js/jquery.appear.js"></script>
<script src="js/stellar.js"></script>
<script src="js/classie.js"></script>
<script src="js/uisearch.js"></script>
<script src="js/jquery.cubeportfolio.min.js"></script>
<script src="js/google-code-prettify/prettify.js"></script>
<script src="js/animate.js"></script>
<script src="js/custom.js"></script>
<!-- star rating js file -->
<script src="js/star-rating.js" type="text/javascript"></script>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>



<div id="wrapper">
	<!-- start header -->
	<header>
			<div class="top">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<ul class="topleft-info">
								<li><i class="fa fa-phone"></i> 0345 7034103</li>
								<li><i class="fa fa-phone"></i> 0300 6297233</li>
							</ul>
						</div>
						<div class="col-md-6">
						<div id="sb-search" class="sb-search">
							<form>
								<input class="sb-search-input" placeholder="Enter your search term..." type="text" value="" name="search" id="search">
								<input class="sb-search-submit" type="submit" value="">
								<span class="sb-icon-search" title="Click to start searching"></span>
							</form>
						</div>


						</div>
					</div>
				</div>
			</div>	
			
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">Complain Management System</a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">
                    	<li><a href="index.php">Home</a></li>
                        <?php 
						if(!isset($_SESSION['User_ID']) && !isset($_SESSION['User_Email']))
						{
							?>
                                <li><a href="login.php">Login</a></li>
                                <li><a href="register.php">Registration</a></li>
							<?php
						}
						else
						{
							?>
                            	<li><a href="dashboard.php">Dashboard</a></li>
                                <li><a href="create-complain.php">Create Complain</a></li>
                                <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">My Complains <span class="caret"></span></a>
                                  <ul class="dropdown-menu">
                                  	<li><a href="EditComplains.php">Edit Complains</a></li>
                                    <li><a href="UnderProgress.php">Under Progress</a></li>
                                    <li><a href="UnderReview.php">Reviewed Complains </a></li>
                                    <li><a href="SolvedComplains.php">Solved Complains</a></li>
                                  </ul>
                                </li>
                                <li><a href="UpdatePassword.php">Change Password</a></li>
                                <li><a href="logout.php">Logout</a></li>
							<?php
						}
						?>
                        
                        
                    </ul>
                </div>
            </div>
        </div>
	</header>