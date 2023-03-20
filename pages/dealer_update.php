<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['id'];
	$name =$_POST['cust_name'];
	$add = $_POST['add'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
			
	mysqli_query($con,"UPDATE `customer` SET `cust_name`='$name',`cust_address`='$add',`cust_contact`='$contact',`cust_email`='$email' WHERE cust_id='$id'")or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Successfully updated Dealer details!');</script>";
	echo "<script>document.location='dealer.php'</script>";  

	
?>
