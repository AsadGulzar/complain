<?php
//require_once('Session-set.php');
require_once('connection.php');

if(isset($_GET['CatId']))
{
	$CatId = CleanData($_GET['CatId']);
	
	$GetSubCatR = mysqli_query($con,"select * from subcat where 
		CatID='$CatId';");
		
	if(mysqli_num_rows($GetSubCatR)>0)
	{
		while($GetSubCatAssoc = mysqli_fetch_assoc($GetSubCatR))
		{
			$SubCatId = $GetSubCatAssoc['SubCatId'];
			$SubCategory = $GetSubCatAssoc['SubCatNam'];
			
			?>
            	<option value="<?php echo $SubCatId;?>"><?php echo $SubCategory;?></option>
			<?php
		}	
	}
}
?>