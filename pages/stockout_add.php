<?php 
session_start();
$id=$_SESSION['id'];	
include('../dist/includes/dbcon.php');

	$dn_no = $_POST['dn_no'];
	$truck_no = $_POST['truck_no'];
	$name = $_POST['prod_name'];
	$qty = $_POST['qty'];
	date_default_timezone_set("Asia/Karachi"); 
	$date = date("Y-m-d");
	$dealer_name=$_POST['dealer_name'];
	$remarks=$_POST['remarks'];
	$trns_name = $_POST['trns_name'];

	mysqli_query($con,"INSERT INTO history_log(user_id,action,date) VALUES('$id','Stock Out','$date')")or die(mysqli_error($con));
		

	mysqli_query($con,"INSERT INTO `stockout`(`stockout_orderno`, `product_id`, `stockout_qty`, `stockout_dat`, `branch_id`, `stockout_truckno`, `stockout_remarks`, `dealer_code`,user_id,transporter)
	VALUES('$dn_no','$name','$qty','$date','1','$truck_no','$remarks','$dealer_name','$id','$trns_name')")or die(mysqli_error($con));

    mysqli_query($con,"UPDATE product SET prod_qty=prod_qty-'$qty' where prod_id='$name' and branch_id='1'") or die(mysqli_error($con)); 
	
		echo "<script type='text/javascript'>alert('Successfully disposed stocks!');</script>";
		echo "<script>document.location='stockout.php'</script>";  
	
?>