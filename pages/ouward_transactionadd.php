<?php 
session_start();
$id=$_SESSION['id'];
$branch=$_SESSION['branch'];	

include('../dist/includes/dbcon.php');

	$cid = $_POST['cid'];
	$name = $_POST['prod_name'];
	$qty = $_POST['qty'];
	$sno = $_POST['sno'];

		
			
		
		$query1=mysqli_query($con,"select * from temp_trans_out where prod_id='$name' and branch_id='$branch'")or die(mysqli_error());
		$count=mysqli_num_rows($query1);
		
		//$total=$price*$qty;
		
		if ($count>0){
			mysqli_query($con,"update temp_trans_out set qty=qty+'$qty' where prod_id='$name' and branch_id='$branch'")or die(mysqli_error());
	
		}
		else{
			mysqli_query($con,"INSERT INTO temp_trans_out(prod_id,qty,branch_id,serial_no) VALUES('$name','$qty','$branch','$sno')")or die(mysqli_error($con));
		}

	
		echo "<script>document.location='outward_transaction.php?cid=$cid'</script>";  
	
?>