<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['id'];
	$name =$_POST['zone_name'];
		mysqli_query($con,"update zone set zone_name='$name' where zone_id='$id'")or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Successfully updated zone details!');</script>";
	echo "<script>document.location='zone.php'</script>";  

	
?>
