<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');


	$name =$_POST['name'];
	$owner =$_POST['owner'];
	$contact =$_POST['contact'];

	
	$query2=mysqli_query($con,"SELECT * FROM `transporter` WHERE `trns_name`='$name' and branch_id='$branch'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('Transporter already exist!');</script>";
			echo "<script>document.location='trns.php'</script>";  
		}
		else{

            $id=$_SESSION['id'];
            
			mysqli_query($con,"INSERT INTO `transporter`(`trns_name`, `trns_owner`, `trns_contact`, `user_id`) VALUES ('$name','$owner','$contact','$id')")or die(mysqli_error($con));

			echo "<script type='text/javascript'>alert('Successfully added new Transporter!');</script>";
					  echo "<script>document.location='trns.php'</script>";  
		}
?>