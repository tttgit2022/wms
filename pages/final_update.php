<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['stock_id'];
	$name =$_POST['prod_name'];
	$qty = $_POST['qty'];
	$sno = $_POST['sno'];
	$zone = $_POST['zone'];
	$pk_damage= $_POST['pk_damage'];
	$unit_damage= $_POST['unit_damage'];
	

    echo 'id=' . $id . 'pd='. $name . 'qt=' . $qty . 'sno=' . $sno; $asn_qty=0; $asn_balance=0;


	$query0=mysqli_query($con,"select * from stockin  WHERE `stockin_id`='$id' ")or die(mysqli_error());
		while($row0=mysqli_fetch_array($query0)){ $asn_qty=$row0['qty']; } $asn_balance=$qty-$asn_qty;

				
	mysqli_query($con,"UPDATE `stockin` SET `serial_no`='$sno', asn_qty='$qty', asn_balance='$asn_balance', zone='$zone', pk_damage='$pk_damage',  unit_damage='$unit_damage' WHERE `stockin_id`='$id'")or die(mysqli_error($con));
	
	$idu=$_SESSION['id']; 
	mysqli_query($con,"INSERT INTO `history_log`(`user_id`, `action`) VALUES ('$idu','ASN Id=$id Updated')")or die(mysqli_error($con));


	echo "<script type='text/javascript'>alert('Successfully updated ASN details!');</script>";
	echo "<script>document.location='final_barcode.php'</script>";  


	
?>
