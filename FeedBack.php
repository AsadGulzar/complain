<?php include('top.php');
require_once('Session-set.php');
?>
<script>
function feedback()
{
	var FeedBackText = document.getElementById("FeedBackText").value;
	var stars = document.getElementById("stars").value;
	var ComplainIDF = document.getElementById("ComplainIDF").value;
	
	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
		 
     document.getElementById("FeedBackResponce").innerHTML = xhttp.responseText;
    }
  };

  	xhttp.open("GET", "SendFeedBack.php?ComplainID="+ComplainIDF+"&FeedBacK="+FeedBackText+"&stars="+stars, true);
  
 	xhttp.send();
  
}
$(document).ready(function() {
	
	$('#feedbackButton').click(function() {
        $('#FeedBackWraper').css('display','none');
    });
    
});
</script>
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
            	<article>
            	<?php 
					if(isset($_GET['ComplainId']))
					{
						$ComplainId = $_GET['ComplainId'];
						
						/* Get Detail Of Complain */
						
						$GetComplainQ = "select * from complain where 
						ComplainId='$ComplainId' and Status='Completed';";
						
						$GetComplainQR = mysqli_query($con,$GetComplainQ);
						
						$GetComplainRow = mysqli_fetch_assoc($GetComplainQR);
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
                                            <input type="hidden" id="ComplainIDF" value="<?php echo $ComplainId; ?>" />
                                            <div class="form-group">
                                                <textarea id="FeedBackText" rows="6" placeholder="Your Feed Back" name="FeedBackText" class="form-control input-lg" tabindex="1"></textarea>
                                            </div>
                                            <div class="form-group " style="min-height:40px;">
                                                <input type="text" id="stars"  class="kv-uni-star rating-loading" value="1" data-size="sm" tabindex="2" title="">
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-12 col-md-6"><input type="button" onClick="feedback()" id="feedbackButton" value="Submit Feedback" class="btn btn-primary btn-block btn-lg" tabindex="3"></div>
                                                
                                            </div>
                                        </div><!-- FeedBackWraper end here -->
                                        <div id="FeedBackResponce">
                                        
                                        </div>
									<?php
								}
								else
								{
									echo "<h3>Feed Back Given</h3>";
									?>
                                    	<p><?php echo $FeedBack?></p>
                                        <input readonly type="text" id="stars"  class="kv-uni-star rating-loading" value="<?php echo $Rating;?>" data-size="sm" tabindex="2" title="">
									<?php
								}
							
						
					}
					
				?>
                
                </article>
            </div><!-- col-sm-9 end here -->
        </div>
    </div><!-- container end here -->
</section><!-- content-wraper end here -->
<script>
    $(document).on('ready', function () {
        $('.kv-gly-star').rating({
            containerClass: 'is-star'
        });
        $('.kv-gly-heart').rating({
            containerClass: 'is-heart',
            defaultCaption: '{rating} hearts',
            starCaptions: function (rating) {
                return rating == 1 ? 'One heart' : rating + ' hearts';
            },
            filledStar: '<i class="glyphicon glyphicon-heart"></i>',
            emptyStar: '<i class="glyphicon glyphicon-heart-empty"></i>'
        });
        $('.kv-fa').rating({
            theme: 'krajee-fa',
            filledStar: '<i class="fa fa-star"></i>',
            emptyStar: '<i class="fa fa-star-o"></i>'
        });
        $('.kv-fa-heart').rating({
            defaultCaption: '{rating} hearts',
            starCaptions: function (rating) {
                return rating == 1 ? 'One heart' : rating + ' hearts';
            },
            theme: 'krajee-fa',
            filledStar: '<i class="fa fa-heart"></i>',
            emptyStar: '<i class="fa fa-heart-o"></i>'
        });
        $('.kv-uni-star').rating({
            theme: 'krajee-uni',
            filledStar: '&#x2605;',
            emptyStar: '&#x2606;'
        });
        $('.kv-uni-rook').rating({
            theme: 'krajee-uni',
            defaultCaption: '{rating} rooks',
            starCaptions: function (rating) {
                return rating == 1 ? 'One rook' : rating + ' rooks';
            },
            filledStar: '&#9820;',
            emptyStar: '&#9814;'
        });
        $('.kv-svg').rating({
            theme: 'krajee-svg',
            filledStar: '<span class="krajee-icon krajee-icon-star"></span>',
            emptyStar: '<span class="krajee-icon krajee-icon-star"></span>'
        });
        $('.kv-svg-heart').rating({
            theme: 'krajee-svg',
            filledStar: '<span class="krajee-icon krajee-icon-heart"></span>',
            emptyStar: '<span class="krajee-icon krajee-icon-heart"></span>',
            defaultCaption: '{rating} hearts',
            starCaptions: function (rating) {
                return rating == 1 ? 'One heart' : rating + ' hearts';
            },
            containerClass: 'is-heart'
        });

        $('.rating,.kv-gly-star,.kv-gly-heart,.kv-uni-star,.kv-uni-rook,.kv-fa,.kv-fa-heart,.kv-svg,.kv-svg-heart').on(
                'change', function () {
                    console.log('Rating selected: ' + $(this).val());
                });
    });
	
</script>
<?php include('footer.php')?>