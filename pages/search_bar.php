<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$sno = $_POST['sno'];
	

    echo $sno; 

	$query0=mysqli_query($con,"select * from stockin  WHERE serial_no='$sno' and final='1' ")or die(mysqli_error());
		while($row0=mysqli_fetch_array($query0)){ $asn_qty=$row0['asn_qty']; $qty=$row0['qty']; }  $asn_qty=$asn_qty+1; $asn_balance=$qty-$asn_qty;

echo "<br>" . 'ASN = ' . $asn_qty . 'Balance = ' . $asn_balance;
	mysqli_query($con,"UPDATE `stockin` SET asn_qty='$asn_qty', asn_balance='$asn_balance' WHERE serial_no='$sno' and final='1' ")or die(mysqli_error($con));
	
	$idu=$_SESSION['id']; 
	//mysqli_query($con,"INSERT INTO `history_log`(`user_id`, `action`) VALUES ('$idu','ASN Id=$id ASN Received')")or die(mysqli_error($con));


	//echo "<script type='text/javascript'>alert('Successfully updated ASN details!');</script>";
	echo "<script>document.location='final_barcode.php'</script>";  


	
?>
