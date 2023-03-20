<?php 
session_start();
include('../dist/includes/dbcon.php');
	$branch=$_SESSION['branch'];
	$name = $_POST['prod_name'];
	$qty = $_POST['qty'];
	$rec_dnno = $_POST['dn_no'];
	$truck_no = $_POST['truck_no'];
	$trns_name = $_POST['trns_name'];
	
	date_default_timezone_set('Asia/Karachi');

	$date = date("d/M/Y");
	$id=$_SESSION['id']; 
	
	$query=mysqli_query($con,"select prod_name from product where prod_id='$name'")or die(mysqli_error());
  
        $row=mysqli_fetch_array($query);
		$product=$row['prod_name'];
	$remarks="added $qty of $product";  
	
		mysqli_query($con,"INSERT INTO history_log(user_id,action,date) VALUES('$id','$remarks','$date')")or die(mysqli_error($con));
		
		
	mysqli_query($con,"UPDATE product SET prod_qty=prod_qty+'$qty' where prod_id='$name' and branch_id='$branch'") or die(mysqli_error($con)); 
			
			mysqli_query($con,"INSERT INTO stockin(prod_id,qty,date,branch_id,rec_dnno,truck_no,user_id,transporter) VALUES('$name','$qty','$date','$branch','$rec_dnno','$truck_no','$id','$trns_name')")or die(mysqli_error($con));

			echo "<script type='text/javascript'>alert('Successfully added new stocks!');</script>";
					  echo "<script>document.location='stockin.php'</script>";  
	
?>