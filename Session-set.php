<?php
if(!isset($_SESSION['User_ID']) && !isset($_SESSION['User_Email']))
{
	?>
    <script>window.location='login.php'</script>
	<?php
	die();
}
$UserID = $_SESSION['User_ID'];
?>