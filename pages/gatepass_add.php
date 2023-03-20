<?php 
session_start();
$branch=$_SESSION['branch'];
include('../dist/includes/dbcon.php');

	$grn_no = $_POST['grn_no'];
	$trns_name= $_POST['trns_name'];
	$cnic = $_POST['cnic'];
    $driver=$_POST['driver'];
	$vehicle_no = $_POST['vehicle_no'];
	$indate = $_POST['indate'];
	$outdate = $_POST['outdate'];
    $veh_size=$_POST['vehicle_type'];
    $mobile=$_POST['mobile'];
	$remarks=$_POST['remarks'];
	
    $id=$_SESSION['id'];
            
    if($grn_no===0){
        echo 'No ASN Found Select ASN First!';
        history.back();
    }
	mysqli_query($con,"INSERT INTO `gatepass`(`grn_no`, `trns_name`, `cnic`, `driver`, `vehicle_no`, `indate`, `outdate`, `user_id`,veh_size,mobile,remarks)
     VALUES ('$grn_no','$trns_name','$cnic','$driver','$vehicle_no','$indate','$outdate','$id','$veh_size','$mobile','$remarks')")or die(mysqli_error($con));

$gid=0;
	$query2=mysqli_query($con,"SELECT gatepass_id FROM `gatepass` ")or die(mysqli_error());
	while($row2=mysqli_fetch_array($query2)){ $gid=$row2['gatepass_id']; } echo  $gid;

mysqli_query($con,"UPDATE `stockin` SET `gatepass_id`='$gid',transporter='$vehicle_no' WHERE `rec_dnno`='$grn_no'")or die(mysqli_error($con));
	
	echo "<script type='text/javascript'>alert('Successfully added new Gate Pass! $gid');</script>";
	echo "<script>document.location='gatepass.php'</script>";  
		
?>