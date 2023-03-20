<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;

include('../dist/includes/dbcon.php');
	$id = $_POST['stock_id'];
	$name =$_POST['prod_name'];
	$qty = $_POST['qty'];
	$sno = $_POST['sno'];
	$dnqty=$_POST['dnqty'];
	$bls = $_POST['bls'];


	$balance=0; $balance=$dnqty-$qty;

    echo 'id=' . $id . 'pd='. $name . 'qt=' . $qty . 'sno=' . $balance;
				
	mysqli_query($con,"UPDATE `stockout` SET `stockout_qty`='$qty',`stockout_balance`='$balance' WHERE `stockout_id`='$id'")or die(mysqli_error($con));
	
	$idu=$_SESSION['id']; 
	mysqli_query($con,"INSERT INTO `history_log`(`user_id`, `action`) VALUES ('$idu','D.N Id=$id Updated')")or die(mysqli_error($con));


	echo "<script type='text/javascript'>alert('Successfully updated DN details!');</script>";
	echo "<script>document.location='final_out.php'</script>";  


	
?>
