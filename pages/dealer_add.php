<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');

	$name = $_POST['cust_name'];
	$address = $_POST['cust_address'];
	
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	
	$id=0; $id=$_SESSION['id'];
	$query2=mysqli_query($con,"SELECT * FROM `customer` WHERE `cust_name`='$name'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Dealer already exist!');</script>";
			echo "<script>document.location='dealer.php'</script>";  
		}
		else
		{
		mysqli_query($con,"INSERT INTO `customer`(`cust_name`, `cust_address`, `cust_contact`, `cust_email`, `cust_branch`,user_id)
			VALUES('$name','$address','$contact','$email','$branch','$id')")or die(mysqli_error($con));

			echo "<script type='text/javascript'>alert('Successfully added new Dealer!');</script>";
					  echo "<script>document.location='dealer.php'</script>";  
		}
?>