<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['id'];
	$qty =$_POST['qty'];
	$cid =$_POST['cid'];
	$sno=$_POST['sno'];
	
	
	mysqli_query($con,"update temp_trans set qty='$qty', serial_no='$sno' where temp_trans_id='$id'")or die(mysqli_error());
	
	
	echo "<script>document.location='inward_transaction.php?cid=$cid'</script>";  

	
?>
