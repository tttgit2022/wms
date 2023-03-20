<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');

	$name = $_POST['zone_name'];
	
	
	$query2=mysqli_query($con,"select * from zone where zone_name='$name' and branch_id='$branch'")or die(mysqli_error($con));
		$count=mysqli_num_rows($query2);

		if ($count>0)
		{
			echo "<script type='text/javascript'>alert('zoneuct already exist!');</script>";
			echo "<script>document.location='zoneuct.php'</script>";  
		}
		else
		{	

			$pic = $_FILES["image"]["name"];
			if ($pic=="")
			{
				$pic="default.gif";
			}
			else
			{
				$pic = $_FILES["image"]["name"];
				$type = $_FILES["image"]["type"];
				$size = $_FILES["image"]["size"];
				$temp = $_FILES["image"]["tmp_name"];
				$error = $_FILES["image"]["error"];
			
				if ($error > 0){
					die("Error uploading file! Code $error.");
					}
				else{
					if($size > 100000000000) //conditions for the file
						{
						die("Format is not allowed or file size is too big!");
						}
				else
				      {
					move_uploaded_file($temp, "../dist/uploads/".$pic);
				      }
					}
			}	

            $id=$_SESSION['id'];
            
			mysqli_query($con,"INSERT INTO zone(zone_name,branch_id,user_id)
			VALUES('$name','$branch','$id')")or die(mysqli_error($con));

			echo "<script type='text/javascript'>alert('Successfully added new zone!');</script>";
					  echo "<script>document.location='zone.php'</script>";  
		}
?>