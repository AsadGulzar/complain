<?php include('top.php');
require_once('Session-set.php');

?>
<script>
function SearchComplain()
{
	var ComplainNumber = document.getElementById("ComplainNumber").value;
	
	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
		 
     document.getElementById("SearchData").innerHTML = xhttp.responseText;
    }
  };

  	xhttp.open("GET", "SearchData.php?ComplainID="+ComplainNumber, true);
  
 	xhttp.send();
  
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
            	    <h2>Search Complain Number <small>Enter Your Complain Id</small></h2>
                    <hr class="colorgraph">
        
                    <div class="form-group">
                        <input type="number" name="ComplainNumber" id="ComplainNumber" class="form-control input-lg" placeholder="Complain Number" tabindex="1">
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6"><input type="button" name="SearchComplain" value="Search Complain" onClick="SearchComplain()" class="btn btn-primary btn-block btn-lg" tabindex="2"></div>
                       
                    </div>
                <div id="SearchData"></div>

            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->

<?php include('footer.php')?>	
<script>

</script>