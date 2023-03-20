<?php 
session_start();
$id=$_SESSION['id'];	
include('../dist/includes/dbcon.php');

	
	date_default_timezone_set("Asia/Karachi"); 
	$date = date("d/m/Y");
	$cid=$_REQUEST['cid'];
	$branch=$_SESSION['branch'];
	$rec_dnno=$_POST['rec_dnno'];
	$cons_name=$_POST['cons_name'];
	//$truckno=$_POST['truckno'];
		

	$query2=mysqli_query($con,"SELECT * FROM `stockout` WHERE `stockout_orderno`='$rec_dnno' and branch_id='$branch'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Delivery Number $rec_dnno already exist!');</script>";
			echo "<script>document.location='outward_transaction.php'</script>";  
		}
		else
		{	

	$sales_id=mysqli_insert_id($con);
	$_SESSION['sid']=$sales_id;
	$query=mysqli_query($con,"select * from temp_trans_out where branch_id='$branch'")or die(mysqli_error($con));
		while ($row=mysqli_fetch_array($query))
		{
			$pid=$row['prod_id'];	
 			$qty=$row['qty'];
			$price=$row['price'];
			$sno=$row['serial_no'];
			
			
			mysqli_query($con,"INSERT INTO `stockout`(`stockout_orderno`, `product_id`, `stockout_dnqty`, `stockout_dat`, `branch_id`, `dealer_code`, `user_id`, `final`)
			                            VALUES('$rec_dnno','$pid','$qty','$date','$branch', '$cons_name','$id','1')")or die(mysqli_error($con));
			
		//	mysqli_query($con,"UPDATE product SET prod_qty=prod_qty+'$qty' where prod_id='$pid' and branch_id='$branch'") or die(mysqli_error($con)); 
		}
		
		
		$result=mysqli_query($con,"DELETE FROM temp_trans_out where branch_id='$branch'")	or die(mysqli_error($con));
		echo "<script>document.location='homedn.php'</script>";  	
		
		
	}	
?>