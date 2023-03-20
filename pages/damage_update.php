<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['stock_id'];
	$name =$_POST['prod_name'];
	$pk_qty = $_POST['pk_qty'];
	$unit_qty = $_POST['unit_qty'];
	

    echo 'id=' . $id . 'pd='. $name . 'qt=' . $unit_qty . 'sno=' . $sno; $asn_qty=0; $asn_balance=0;


	//$query0=mysqli_query($con,"select * from stockin  WHERE `stockin_id`='$id' ")or die(mysqli_error());
	//	while($row0=mysqli_fetch_array($query0)){ $asn_qty=$row0['qty']; } $asn_balance=$qty-$asn_qty;

				
	mysqli_query($con,"UPDATE `stockin` SET `pk_damage`='$pk_qty', unit_damage='$unit_qty' WHERE `stockin_id`='$id'")or die(mysqli_error($con));
	
	$idu=$_SESSION['id']; 
	mysqli_query($con,"INSERT INTO `history_log`(`user_id`, `action`) VALUES ('$idu','Damage Item=$id Updated')")or die(mysqli_error($con));


	echo "<script type='text/javascript'>alert('Successfully updated Damage details!');</script>";
	echo "<script>document.location='damage.php'</script>";  


	
?>
