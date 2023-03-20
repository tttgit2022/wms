<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['id'];
	$name =$_POST['name'];
	$owner =$_POST['owner'];
	$contact =$_POST['contact'];

	
			
	mysqli_query($con,"UPDATE `transporter` SET `trns_name`='$name',`trns_owner`='$owner',`trns_contact`='$contact' where trns_id='$id'")or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Successfully updated Transporter details!');</script>";
	echo "<script>document.location='trns.php'</script>";  

	
?>
