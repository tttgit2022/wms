<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');

$asn_no=$_POST['asn_no'];  echo 'Asn=' . $asn_no;

$query=mysqli_query($con,"select * from stockin  where  final='1' and rec_dnno='$asn_no' ")or die(mysqli_error());
while($row=mysqli_fetch_array($query)){
$pd=0; $pd=$row['prod_id'];  $g_pass=0; $g_pass=row['gatepass_id']; $qtz=0; $qtz=$row['qty']; $qt=0; $pid=0; $qt1=0; echo 'product=' . $pd. 'qtz=' . $qtz;

if($g_pass=== '0') {
	echo 'Gate Pass not Created! Create Gate Pass' ;
	exit();
	echo "<script>document.location='gatepass.php'</script>";  

}
$query0=mysqli_query($con,"SELECT * FROM `product` WHERE `prod_id`='$pd'")or die(mysqli_error());
while($row0=mysqli_fetch_array($query0)){ $qt=$row0['prod_qty']; 
$pid=$row0['prod_id']; $qt1=$qtz+$qt; } echo 'Qty=' . $pid . 'qt=' . $qt1 ;


	mysqli_query($con,"UPDATE `product` SET `prod_qty`='$qt1' WHERE `prod_id`='$pid'")or die(mysqli_error($con));
}
	mysqli_query($con,"UPDATE `stockin` SET `final`='0' WHERE `final`='1' and rec_dnno='$asn_no'")or die(mysqli_error($con));
    $idu=$_SESSION['id']; 
	mysqli_query($con,"INSERT INTO `history_log`(`user_id`, `action`) VALUES ('$idu','Fial=$id Updated')")or die(mysqli_error($con));

	
	echo "<script type='text/javascript'>alert('Successfully Finilized details!');</script>";
	echo "<script>document.location='home.php'</script>";  

	
?>
