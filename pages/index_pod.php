<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
if(empty($_SESSION['branch'])):
header('Location:../index.php');
endif;
?>
<html>
  <head>
    <title>
      POD Detail
    </title>
    <head runat="server">

    <script type="text/javascript" language="javascript">
    function Jigsaw()
    {
        var first = document.getElementById("tq1");
        var sec = document.getElementById("deliver[]");
        
        var three=document.getElementById("rtern[]");

	var firstValue = isNaN(Number(first.value)) ? 0.0 : parseFloat(first.value);
	var secValue   = isNaN(Number(sec.value))   ? 0.0 : parseFloat(sec.value);
	var sumValue = firstValue - secValue;
        
        document.getElementById("rtern[]").value = sumValue;
        
  if (sec.value > first.value ) { sec.value=""; 
  alert("Deliverd QTY not greater than Quantity Sent");
  submitOK = "false";
  document.location.reload(true)
  document.getElementById("deliver[]").focus(); 
  }
  
        }
        
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"
    />
    <style type="text/css">
      #results {
        padding: 20px;
        border: 1px solid;
        background: #ccc;
      }
    </style>
  </head>
  <body>

<h1 align="center"> POD Detail Form</h1>
  <table width="90%"   border="0" cellspacing="4" cellpadding="4">
                                  
                                  <tr>
<form method="POST" action="" enctype="multipart/form-data" >


<td>Delivery Note No. <input type="text"  name="dnno"  placeholder="Delivery Note No." required> 
<button class="btn btn-success">Submit</button> </td> </form>

<th> Doc. Date </th>  <th> Sale Order # </th> <th> Dealer </th>   <th> Vechicle</th> 
                 

<?php
		include('../dist/includes/dbcon.php');
     $sno=1; $qtysum=0; $dlr=0; $dnno=$_POST['dnno'];
		$query=mysqli_query($con,"SELECT *,sum(stockout_qty) as qt FROM `stockout` WHERE `stockout_orderno`='$dnno' group by stockout_orderno")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){ 
?>
                      
		    
		<tr>
		<td> </td>
		<td><?php echo $row['stockout_dat'];?></td>
      <td><?php echo $row['stockout_orderno']; $dcno=$row['stockout_orderno']; 
            $dlr=$row['dealer_code']; ?></td> 
  <?          $query3=mysqli_query($con,"SELECT * FROM `customer` WHERE `cust_id`='$dlr'")or die(mysqli_error());
		while($row3=mysqli_fetch_array($query3)){ ?>
		<td><?php echo $row3['cust_name']; ?></td> <? } ?>
         
            
	    <td><?php echo $row['stockout_truckno'];} ?></td> 	
	    </td>

       

</table>





<hr>
<form method="POST" action="" enctype="multipart/form-data">	
<table width="90%"   border="0" cellspacing="4" cellpadding="4">
<th>S.No </th><th> ID </th> <th> Product </th> <th> Quantity Sent </th> 
<th> Deliver QTY</th> <th> Return QTY </th> <th> Return Reason </th>
 
<?php
		$sno=1; $qtysum=0; $snno=$_POST['snno'];
		$query=mysqli_query($con,"SELECT *,sum(stockout_qty) as qt FROM `stockout` WHERE `stockout_orderno`='$dnno' group by product_id")or die(mysqli_error()); $c=0;
		while($fetch=mysqli_fetch_array($query)){
        	$c++;
		
		// while($row=mysqli_fetch_array($query)){ 
?>
                      
		    
		<tr>


            <td><?php echo $sno; $pcod=0;?></td> 
            <td><?php echo $fetch["product_id"]; 
            $pcod=$fetch["product_id"]; ?></td>
   
   <? $query1=mysqli_query($con,"SELECT * FROM `product` WHERE  prod_id='$pcod' ")or die(mysqli_error()); $c=0;
		while($fetch1=mysqli_fetch_array($query1)){ ?>
            
            <td><?php echo $fetch1["prod_desc"]; }?></td>
            <td><?php echo $fetch["stockout_qty"]; $tq=$fetch["stockout_qty"]; ?></td>
            
            <input type="hidden" name="tq1" value="<? echo $tq; ?>" id="tq1"  onchange="javascript:Jigsaw();return false;">
            
            <td><input type="number" name="deliver[]"  placeholder="Deliver Qty" size="3"  id="deliver[]"  onchange="javascript:Jigsaw();return false;" required></td>
           	 
	        <td><input type="number" name="rtern[]"  placeholder="Return Qty" size="1" id="rtern[]"  required></td>
           	 	

            <td><input type="text" name="reason[]"  placeholder="Return Reason" required></td>
         
        <input type="hidden" name="slono" value="<? echo $slono; ?>">  	 
		<input type="hidden" name="dcno[]" value="<?php echo $fetch["out_productcode"]; ?>" >
		<input type="hidden" name="out_serial[]" value="<?php echo $fetch["out_serial"]; ?>">	
		<input type="hidden" name="id[]" value="<?php echo $fetch["out_id"]; ?>">	
		<input type="hidden" name="out_bbndid[]" value="<?php echo $fetch["out_bbnd"]; ?>">
		<input type="hidden" name="out_dealer[]" value="<?php echo $fetch["out_dealer"]; ?>">
		


</td> <tr> <?php $sno=$sno+1;} ?>

                                 </tr>
<td> </td> <td> </td><td> </td><td> </td> <td> Return Date </td> <td> <input type="date" name="dt" ></td>
	    
                                </table>
<div class="col-md-12 text-center">
            <br />
            <button class="btn btn-success" name="saveBtn" id="saveBtn">Submit</button> 
          </div> 
</form>
<? /*
<hr>                            
		  
    <div class="container">
      <h1 class="text-center">
        Capture POD with webcam image
      </h1>
 
  
        <div class="row">
          <div class="col-md-6">
            <div id="my_camera"></div>
            <br />
            <input
              type="button"
              value="Take Snapshot"
              onClick="take_snapshot()"
            />
            <input type="hidden" name="image" class="image-tag" />
	    <input type="hidden" name="dcono" value="<?php echo $dcno; ?>" >
          </div>
          <div class="col-md-6">
            <div id="results">Your captured image will appear here...</div>
          </div>
          <div class="col-md-12 text-center">
            <br />
            <button class="btn btn-success" name="saveBtn" id="saveBtn">Submit</button> 
          </div>
        </div>
      </form>
    </div>
 
    <!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
      Webcam.set({
        width: 490,
        height: 390,
        image_format: "jpeg",
        jpeg_quality: 90,
      });
 
      Webcam.attach("#my_camera");
 
      function take_snapshot() {
        Webcam.snap(function (data_uri) {
          $(".image-tag").val(data_uri);
          document.getElementById("results").innerHTML =
            '<img src="' + data_uri + '"/>';
        });
      }
    </script>

<?php
if(isset($_POST["saveBtn"])){

       foreach($_POST["id"] as $rec=> $value){
         $out_serial = $_POST["out_serial"][$rec];
         $stt = $_POST["stt"][$rec];
         $dt = $_POST['dt'];
         $reason = $_POST["reason"][$rec];
         $userid=$_SESSION['id'];
         $out_bbndid = $_POST["out_bbndid"][$rec];
         
         $deliver=$_POST['deliver'][$rec];
         $rtern=$_POST['rtern'][$rec];
         $dcono=$_POST['dcno'][$rec];
         $tq=$_POST['tq1'][$rec];
         $slono=$_POST['slono'];
         $dcno=$_POST['dcono'];
         
         $sc = $_POST["score"][$rec];  
        $str='Deliver';
if($rtern>'0'){$str='retun';} 

$qty=0; $qt1=0;

    mysqli_query($con,"INSERT INTO `returntbl`(`return_docno`, `return_orderno`, `return_material`, `return_actualqty`, `return_deliverqty`, `return_returnqty`, `return_reason`, `return_dat`, `return_user`) VALUES ('$dcno','$slono','$dcono','$tq','$deliver','$rtern','$reason','$dt','$userid')")or die(mysqli_error($con));


	$query=mysqli_query($con,"SELECT * FROM `bbndtbl` WHERE `bbnd_id`='$out_bbndid'")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){ $qty=$row['qty']; } $qt1=$qty+$rtern;
		

mysqli_query($con,"UPDATE `bbndtbl` SET `type`='retrun',`qty`='$qt1' WHERE `bbnd_id`='$out_bbndid' AND `type`!='return'")or die(mysqli_error($con));
	
	echo $out_bbndid . ' - ' . $out_serial . ' - ' . $id;	
  
       }




    
    $img = $_POST['image'];
    $dcono = $_POST['dcono'];
    $folderPath = "uploads/";
    $name =123;
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = $dcono . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);
  
    print_r($fileName);
    
 $from='shokisial@gmail.com'; $from1=0;  
			$user_query2 = mysqli_query($con,"SELECT * FROM `outtbl` WHERE `out_dealer`='117752'")or die(mysqli_error());
			 while($row2 = mysqli_fetch_array($user_query2)){
			 $from1= $row2['email'];} 									

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "shokisial@gmail.com";
    $to = "shokisial@gmail.com";
    $subject = "File sended";
    $message = "You have returned 5 items";
    $headers = "From:" . $from;
    if(mail($to,$subject,$message, $headers)) {
		echo "The email message was sent.";
    } else {
    	echo "The email message was not sent.";
    }




  echo "<script type='text/javascript'>alert('Update Return and POD Image Successfully!');</script>";
  echo "<script>document.location='index_pod.php'</script>";  

}

*/ ?>

<hr>
<? echo "<script>document.location='https://royalwms.tlpk.com/pages/Scanner/scanner.html'</script>";   ?>
 </body>
</html>