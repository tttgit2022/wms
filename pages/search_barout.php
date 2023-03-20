<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$sno = $_POST['sno'];
	

    echo $sno; $pd=0;

	$query0=mysqli_query($con,"SELECT * FROM stockout INNER JOIN product on product.prod_id=stockout.`product_id` where final='1' and product.sno='$sno' ")or die(mysqli_error());
		while($row0=mysqli_fetch_array($query0)){ $dn_qty=$row0['stockout_dnqty']; $qty=$row0['stockout_qty']; $pd=$row0['prod_id']; }  $qty=$qty+1; $dn_balance=$dn_qty-$qty;

echo "<br>" . 'DN Qty= ' . $dn_qty . 'Balance = ' . $dn_balance;
	mysqli_query($con,"UPDATE `stockout` SET stockout_qty='$qty', stockout_balance='$dn_balance' WHERE  final='1' and product_id='$pd'")or die(mysqli_error($con));
	
	$idu=$_SESSION['id']; 
	//mysqli_query($con,"INSERT INTO `history_log`(`user_id`, `action`) VALUES ('$idu','ASN Id=$id ASN Received')")or die(mysqli_error($con));


	//echo "<script type='text/javascript'>alert('Successfully updated ASN details!');</script>";
	echo "<script>document.location='final_out.php'</script>";  


	
?>
