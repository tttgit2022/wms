<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
if(empty($_SESSION['branch'])):
header('Location:../index.php');
endif;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Outound GDN | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
      <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <script type="text/javascript" src="../dist/js/jquery.min.js"></script>
<script type="text/javascript" src="../dist/js/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="../dist/css/bootstrap.css" />
 
<!-- Include Date Range Picker -->
<script type="text/javascript" src="../plugins/daterangepicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="../plugins/daterangepicker/daterangepicker.css" />
    <style type="text/css">
      h5,h6{
        text-align:center;
      }
		

      @media print {
          .btn-print {
            display:none !important;
		  }
		  .main-footer	{
			display:none !important;
		  }
		  .box.box-primary {
			  border-top:none !important;
		  }
		  .angel{
			  display:none !important;
		  }
          
      }
    </style>
    
    
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div >
          <!-- Content Header (Page header) -->
          

          
        </div>


		<?php 
		if (isset($_POST['sub']))
	{
		include('../dist/includes/dbcon.php');
$id=$_SESSION['id'];
$branch=$_SESSION['branch'];
include('createbarcode.php');

//}

    $queryb=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());
  
        $rowb=mysqli_fetch_array($queryb); 
        $branch_add=$rowb['branch_address']; 
        
  ?>			
                 
<?php  

    $branch=$_SESSION['branch'];  
  
    $rcdoc=$_POST['gdn_no'];  
  
   // $gtpass=$_POST['gtpass'];  

     echo 'RDC No' . $rcdoc;
    //$rcdoc='0987oiuy';
    //JOIN product inner JOIN customer on customer.cust_id=stockout.dealer_code inner join transporter on stockout.transporter=transporter.trns_id
      $query1=mysqli_query($con,"SELECT * FROM `stockout` inner JOIN customer on customer.cust_id=stockout.dealer_code where stockout.gatepass_id='$rcdoc'")or die(mysqli_error($con));
      
        $row1=mysqli_fetch_array($query1); $dcno= $row1['stockout_orderno']; 
        
echo $dcno;
?>    
      <table width="700" border="1" align="center">
  
    <td width="180" align="center"><img src="taqlogo.png" width="120" height="80" alt=""/></td>
        <td width="200" align="center"><strong> Delivery Information </strong></td>
      <td width="220" align="center"><?php echo bar128(stripslashes($dcno));?></td>
    </tr>

</table>
<p>
                   <table  bodrder="1">
                      
                          <th>Warehouse:</th>
                        <td><?php echo $branch_add;?></td>
                        
                     
                        <th align="right"> Deliver to Location:  </th> 
                        
                        <td><?php echo $row1['cust_id']  . ' - '. $row1['cust_name'];?> </td>
                        </tr>
                        
                        <tr>
                        <th> Document Date:  </th> <td><?php echo $row1['stockout_dat'] ;?> </td> 
                        <th> Gate Pass No:  </th> 
                        
                        <td><?php echo $rcdoc ;?> </td>
                        </tr>
                        </thead>
               </table>
                  <table class="table">
                      <thead>
                      <tr >
                        
                        <th>Item Code</th>
                        <th>Description</th>
                        <th>Quantity</th>
            			
            						
                      </tr>
                    </thead>
                    <tbody>

                    <?php /*

		$query1=mysqli_query($con,"SELECT * FROM `stockout` where stockout.stockout_orderno='$dcno'")or die(mysqli_error($con));
		while($row1=mysqli_fetch_array($query1)){
				$d_id=0; $d_id=$row1['dealer_code']; $d_name=0; $d_name=$row1['cust_name'];
*/       		
?>
 <tr>
        <th> <?php echo $d_name;?> </th>
      </tr>  
<?php 
//inner join gatepass_out on gatepass_out.gatepass_id=stockout.gatepass_id
//inner join transporter on stockout.transporter=transporter.trns_id
		$query=mysqli_query($con,"SELECT * FROM `stockout` inner join product on product.prod_id=stockout.product_id   inner join gatepass_out on gatepass_out.gatepass_id=stockout.gatepass_id where stockout_orderno='$dcno'  ")or die(mysqli_error($con));
			$grand=0;
		while($row=mysqli_fetch_array($query)){
				//$id=$row['temp_trans_id'];
				//$total= $row['qty']*$row['price'];
				//$grand=$grand+$total;
        
?>
                    
                      <tr>
            						
                        <td ><?php echo $row['prod_name'];?></td>
                        <td><?php echo $row['prod_desc'];?></td>
                        <td><?php echo $row['stockout_qty'];?></td>
            					</tr>
   
   <?php 

		$query2=mysqli_query($con,"SELECT * FROM `gatepass_out` inner join transporter on gatepass_out.trns_name=transporter.trns_id WHERE `dn_no`='$dcno'")or die(mysqli_error($con));
		while($row2=mysqli_fetch_array($query2)){$trns=0; 
    $trns=$row2['trns_name']; }
?>

    <?php $veh=0; $veh=$row['vehicle_no']; 
  
  $dr=0; $dr=$row['driver'];  $mobile=0; $mobile=$row['mobile'];}  ?>		

</table>

<br>
<table width="98%">
                      
             <tr>
             <td>Issued by:</td> <td></td><td>_________________________</td>
     
             <td >Sign:</td><th></th>     <td>_________________________</td> 
             </tr>
             
             </table>
             
<br><p>
<table width="98%">
                      
             <tr>
             <td>Checket by:</td><td>__________________________</td>
     
             <td >Sign:</td><th></th>     <td>___________________________</td> 
             </tr>
             
             </table>
             
             
           
<br><p>
<table width="76%">
                      
             <tr>
             <td>Hand over to</td><td><?php echo $trns;?> </td>
     
             <td>Vehicle No.</td>
                        <td ><u><?php echo  $veh ; ?> </u></td>
             </tr>
             
             </table>
             <br>
             <table width="105%">
            <tr>
                        <td>Driver Name:</td><td></td>
                        <td align="left"><u><?php echo  $dr ; ?> </u></td>
                        <td>Sign.</td>
                        <td>______________________</td>
                        </tr>
                        </table>
                        <br>
            <table width="140%">
                        <tr>
                        <td>Cell No.</td>
                        <td align="left"><u><?php echo  $mobile ; }?> </u></td>
                      
            
                        <td>Date & Time: ___________________</td>
                        
                        
                      </tr>
                    </tbody>
                    
                  </table> 
                </div><!-- /.box-body -->
				</div>  
				</form>	
                </div><!-- /.box-body --> <?  ?>
                <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
                <a class = "btn btn-primary btn-print" href = "home.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Homepage</a>
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
           
          </div><!-- /.row -->
	  
             
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
     
    </div><!-- ./wrapper -->
	
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

    <script src="../plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<!-- Select2 -->
	<script src="../plugins/select2/select2.full.min.js"></script>
	<!-- InputMask -->
	<script src="../plugins/input-mask/jquery.inputmask.js"></script>
	<script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
	<!-- date-range-picker -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="../plugins/daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap datepicker -->
	<script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- bootstrap color picker -->
	<script src="../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
	<!-- bootstrap time picker -->
	<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- SlimScroll 1.3.0 -->
	<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- iCheck 1.0.1 -->
	<script src="../plugins/iCheck/icheck.min.js"></script>
	<!-- FastClick -->
	<script src="../plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="../dist/js/app.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="../dist/js/demo.js"></script>
    <script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
  </body>
</html>
