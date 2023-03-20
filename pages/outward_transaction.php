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
    <title>Home | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <script src="../dist/js/jquery.min.js"></script>
    <script language="JavaScript"><!--
javascript:window.history.forward(1);
//--></script>

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

 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-<?php echo $_SESSION['skin'];?> layout-top-nav" onload="myFunction()">
    <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div >
          <!-- Content Header (Page header) -->
          <section class="content-header">
            
              <a class="btn btn-lg btn-warning" href="homedn.php">Back</a>
              <a class="btn btn-lg btn-warning" href="index7.php">D.N Format</a>
              

            

            <h5 class="box-title">Delivery Note (D.N) File Upload   </h5> 
                  <form action="excel/outbound_upload.php" method="POST" enctype="multipart/form-data">

<input type="file" name="import_file"  />
<button type="submit" name="save_out_data" class="btn btn-primary mt-3">Import</button>

</form> 

<div>
              <form class="form-horizontal" method="post" action="outward_add.php" name="autoSumForm" enctype='multipart/form-data'>
               
              <input type="text"  id="name" name="rec_dnno" size="20" placeholder ="Document No." required>  
             Consignee
                <select  name="cons_name" tabindex="6"  required>
								<?php
               						 
									 $query5=mysqli_query($con,"SELECT * FROM `customer` ORDER by `cust_name` ASC")or die(mysqli_error());
									    while($row5=mysqli_fetch_array($query5)){
								?>
										<option value="<?php echo $row5['cust_id'];?>"><?php echo $row5['cust_name'];?></option>
								  <?php }?>
								</select>
              <button type="submit" name="cash" class="btn btn-primary mt-3">Save D.N</button>

</form>
</div>

<?php /*              
<div>
              <form class="form-horizontal" method="post" action="finalize_out.php" enctype='multipart/form-data'>
               
              <input type="text"  id="name" name="asn_no" size="20" placeholder ="Enter Delivery Note" required>  
     <button type="submit" name="load_excel_data" class="btn btn-primary mt-3">Fianalize</button>

</form>
</div>

*/ ?>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Product</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
	      <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Delivery Note (D.N) </h3>
                </div>


                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="ouward_transactionadd.php">
				  <div class="row" style="min-height:400px">
					
					 <div class="col-md-6">
						  <div class="form-group">
							<label for="date">Item Name</label>
							 
								<select class="form-control select2" name="prod_name" tabindex="1" autofocus required>
								<?php
                  $branch=$_SESSION['branch'];
                  $cid=$_REQUEST['cid'];
								  include('../dist/includes/dbcon.php');
									 $query2=mysqli_query($con,"select * from product order by prod_name")or die(mysqli_error());
									    while($row=mysqli_fetch_array($query2)){
								?>
										<option value="<?php echo $row['prod_id'];?>"><?php echo $row['prod_name']." (".$row['prod_qty'].")"; ?></option>
                    
                    <?php }?>
                    
								</select>
                
						    
						  </div><!-- /.form group -->
					</div>
          
          <div class=" col-md-2">
						<div class="form-group">
							<label for="date">Quantity</label>
							<div class="input-group">
							  <input type="number" class="form-control pull-right" id="date" name="qty" placeholder="Quantity" tabindex="2" value="1"  required>
							</div><!-- /.input group -->
						</div><!-- /.form group -->
					 </div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="date"></label>
							<div class="input-group">
								<button class="btn btn-lg btn-primary" type="submit" tabindex="3" name="addtocart">+</button>
							</div>
						</div>	
					</form>	

          
					</div>

        

					<div class="col-md-12">
<?php /*
$queryb=mysqli_query($con,"select balance from customer where cust_id='$cid'")or die(mysqli_error());
     $rowb=mysqli_fetch_array($queryb);
        $balance=$rowb['balance'];

        if ($balance>0) $disabled="disabled=true";else{$disabled="";}
*/ ?>
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        
						                 
                        <th>Item Name</th>
                        <th>Description</th>
                        <th>Zone</th>
                        <th>Qty</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		$query=mysqli_query($con,"select * from temp_trans_out natural join product where branch_id='$branch'")or die(mysqli_error());
			$grand=0;
		while($row=mysqli_fetch_array($query)){
				$id=$row['temp_trans_id'];
				$total= $row['qty']*$row['price'];
				$grand=$grand+$total;
		
?>
                      <tr >
						
                        <td class="record"><?php echo $row['prod_name'];?></td>
                        <td height="4"><?php echo 'Category= ' . $row['category'] . ' ' . 'UOM= ' . $row['uom'] .  "<br>" . 'Weight= ' . $row['weight'] . ' ' . 'Volume= ' . $row['volume'];?></td>
						            <td><?php echo $row['zone'];?></td>
                        <td><?php echo $row['qty'];?></td>
						 <td>
							
							<a href="#updateordinance<?php echo $row['temp_trans_id'];?>" data-target="#updateordinance<?php echo $row['temp_trans_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>

              <a href="#delete<?php echo $row['temp_trans_id'];?>" data-target="#delete<?php echo $row['temp_trans_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-trash text-red"></i></a>
              
						</td>
                      </tr>
					  <div id="updateordinance<?php echo $row['temp_trans_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Outbound Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="outward_update.php" enctype='multipart/form-data'>
					<input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>" required>  	
					<input type="hidden" class="form-control" id="price" name="id" value="<?php echo $row['temp_trans_id'];?>" required>  
				
          <div class="form-group">
					<label class="control-label col-lg-3" for="price">Qty</label>
					<div class="col-lg-9">
					  <input type="text" class="form-control" id="price" name="qty" value="<?php echo $row['qty'];?>" required>  
          </div>
				</div>

        
              </div><p>
                <div>
    </div>
              <div class="modal-footer">
		            <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			  </form>
            </div>
			
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->  
<div id="delete<?php echo $row['temp_trans_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Delete Item</h4>
              </div>
              <div class="modal-body">
        <form class="form-horizontal" method="post" action="outward_transactiondel.php" enctype='multipart/form-data'>
          <input type="hidden" class="form-control" name="cid" value="<?php echo $cid;?>" required>   
          <input type="hidden" class="form-control" id="price" name="id" value="<?php echo $row['temp_trans_id'];?>" required>  
        <p>Are you sure you want to remove <?php echo $row['prod_name'];?>?</p>
        
              </div><br>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
        </form>
            </div>
      
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->  
<?php }?>					  
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->

				</div>	
               
                  
                  
				</form>	
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
            
            
			
			
          </div><!-- /.row -->
	  
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->
	<script>
  
    
      $("#cash").click(function(){
          $("#tendered").show('slow');
          $("#change").show('slow');
      });

    $(function() {

      $(".btn_delete").click(function(){
      var element = $(this);
      var id = element.attr("id");
      var dataString = 'id=' + id;
      if(confirm("Sure you want to delete this item?"))
      {
	$.ajax({
	type: "GET",
	url: "temp_trans_del.php",
	data: dataString,
	success: function(){
		
	      }
	  });
	  
	  $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
	  .animate({ opacity: "hide" }, "slow");
      }
      return false;
      });

      });
    </script>
	
	<script type="text/javascript" src="autosum.js"></script>
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
	<script src="../dist/js/jquery.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/select2/select2.full.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,x`
          "info": true,
          "autoWidth": false
        });
      });
    </script>
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
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

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
