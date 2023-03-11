<?php
if(isset($_SESSION['Admin_ID']) && isset($_SESSION['Admin_Email']))
{
	?>
    <script>window.location='dashboard.php'</script>
	<?php
	die();
}
?>