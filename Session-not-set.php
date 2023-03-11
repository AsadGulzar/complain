<?php
if(isset($_SESSION['User_ID']) && isset($_SESSION['User_Email']))
{
	?>
    <script>window.location='index.php'</script>
	<?php
	die();
}
?>