<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$asn_no=$_POST['asn_no'];  echo 'Asn=' . $asn_no;

$query=mysqli_query($con,"select * from stockout  where  final='1' and stockout_orderno='$asn_no' ")or die(mysqli_error());
while($row=mysqli_fetch_array($query)){
$pd=0; $pd=$row['product_id']; $qtz=0; $qtz=$row['stockout_qty']; $qt=0; $pid=0; $qt1=0; echo 'product=' . $pd. 'qtz=' . $qtz;

$query0=mysqli_query($con,"SELECT * FROM `product` WHERE `prod_id`='$pd'")or die(mysqli_error());
while($row0=mysqli_fetch_array($query0)){ $qt=$row0['prod_qty']; 
$pid=$row0['prod_id']; $qt1=$qt-$qtz; } echo 'Qty=' . $pid . 'qt=' . $qt1 ;


	mysqli_query($con,"UPDATE `product` SET `prod_qty`='$qt1' WHERE `prod_id`='$pid'")or die(mysqli_error($con));
}
	mysqli_query($con,"UPDATE `stockout` SET `final`='0' WHERE `final`='1' and stockout_orderno='$asn_no'")or die(mysqli_error($con));
    $idu=$_SESSION['id']; 
	mysqli_query($con,"INSERT INTO `history_log`(`user_id`, `action`) VALUES ('$idu','Fial=$id Updated')")or die(mysqli_error($con));

	
	echo "<script type='text/javascript'>alert('Successfully Finilized details!');</script>";
	echo "<script>document.location='homedn.php'</script>";  

	
?>
