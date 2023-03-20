<?php 
session_start();
$id=$_SESSION['id'];	
include('../dist/includes/dbcon.php');

	
	date_default_timezone_set("Asia/Karachi"); 
	$date = date("d/m/Y");
	$cid=$_REQUEST['cid'];
	$branch=$_SESSION['branch'];
	$rec_dnno=$_POST['rec_dnno'];
	//$truckno=$_POST['truckno'];


	$query2=mysqli_query($con,"select * from stockin where rec_dnno='$rec_dnno' and branch_id='$branch'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('A.S.N $rec_dnno already exist!');</script>";
			echo "<script>document.location='inward_transaction.php'</script>";  
		}
		else
		{	

	$sales_id=mysqli_insert_id($con);
	$_SESSION['sid']=$sales_id;
	$query=mysqli_query($con,"select * from temp_trans where branch_id='$branch'")or die(mysqli_error($con));
		while ($row=mysqli_fetch_array($query))
		{
			$pid=$row['prod_id'];	
 			$qty=$row['qty'];
			$price=$row['price'];
			$sno=$row['serial_no'];
			
			
			mysqli_query($con,"INSERT INTO `stockin`(`rec_dnno`, `prod_id`, `qty`, `date`, `branch_id`, `final`, `whcode`, `rec_point`, `remarks`,serial_no,user_id) VALUES('$rec_dnno','$pid','$qty','$date','$branch', '1','Store 14 E','S-14','0','$sno','$id')")or die(mysqli_error($con));
			
		//	mysqli_query($con,"UPDATE product SET prod_qty=prod_qty+'$qty' where prod_id='$pid' and branch_id='$branch'") or die(mysqli_error($con)); 
		}
		
		
		$result=mysqli_query($con,"DELETE FROM temp_trans where branch_id='$branch'")	or die(mysqli_error($con));
		echo "<script>document.location='homerec.php'</script>";  	
	}
		
	
?>