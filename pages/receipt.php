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
    <title>Receipt | <?php include('../dist/includes/title.php');?></title>
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
    
    <style type="text/css">
      tr td{
        padding-top:-10px!important;
        border: 1px solid #000;
      }
      @media print {
          .btn-print {
            display:none !important;
          }
      }
    </style>
    
 </head>
 
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
      
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div >

          <section class="content">
            <div class="row">
	      <div class="col-md-12">
              <div class="col-md-12">

              </div>
                
                <div class="box-body">

                  <!-- Date range -->
                  <form method="post" action="">
                      <form action="" name="rptgrn" >
        <input type="text" name="rcdoc" placeholder="Document No." required>
        <input type="text" name="gtpass" placeholder="Gate Pass No." required>
        <input type="submit" value="submit" name="sub">
    </form>
<?php
include('../dist/includes/dbcon.php');
$id=$_SESSION['id'];
$branch=$_SESSION['branch'];
$rcdoc=$_POST['rcdoc'];   
$gtpass=$_POST['gtpass']; 
    $queryb=mysqli_query($con,"select * from branch where branch_id='$branch'")or die(mysqli_error());
  
        $rowb=mysqli_fetch_array($queryb);
        
?>			
                 
<?php

    $branch=$_SESSION['branch']; $dcno=0;
    
        $query1=mysqli_query($con,"SELECT * FROM `stockin` JOIN product where `rec_dnno`='$rcdoc'")or die(mysqli_error($con));
      
        $row1=mysqli_fetch_array($query1); $dcno= $row1['rec_dnno'];

?>    
         

                   <table class="table">
                    <thead>
                      <tr>
                        <th colspan="3"><h5><b><?php echo $rowb['branch_name'];?></b></h5></th>
                        <th><b><u>Goods Receipt Note</u></b></th>
                      </tr>
                      <tr>
                        <th colspan="3"><h4> Received From:  Royal Fan</h4></th>
                        <th><span style="font-size: 16px;color: red">GRN No. <?php echo $row1['rec_dnno'];?></span></th>
                      </tr>
                      
                    </thead>
                    <thead>

                      <tr>
                        <th>Gate Pass #</th>
                        <th><u><?php echo $gtpass;?></u></th><th></th>
                        <th>Date</th>
                        <th><u><?php echo $row1['date'];?> </u></th>
                      </tr>
                      
                    </thead>
                  </table>
                  <table class="table">
                    <thead>
                        
                      <tr style="border: solid 1px #000">
                        <th>Item ID</th>
                        <th>Item Code</th>
                        <th>Description</th>
                        <th>Unit</th>
            						<th>Qty Rece.</th>
            						<th>Qty to be Rece.</th>
            						<th class="text-right">Zone</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		$query=mysqli_query($con,"SELECT * FROM `stockin` inner join product on product.prod_id=stockin.prod_id where rec_dnno='$dcno' order by `rec_dnno`")or die(mysqli_error($con));
			$grand=0;
		while($row=mysqli_fetch_array($query)){
				//$id=$row['temp_trans_id'];
				//$total= $row['qty']*$row['price'];
				//$grand=$grand+$total;
        
?>
                      <tr>
            						<td><?php echo $row['stockin_id'];?></td>
                    
                        <td class="record"><?php echo $row['prod_name'];?></td>
                        <td><?php echo $row['prod_desc'];?></td>
                        <td>PCS</td>
                        
            						<td><?php echo number_format($row['qty'],2);?></td>
            						<td><?php echo number_format($row['qty'],2);?></td>
            						<td style="text-align:right"><?php echo number_format($total,2);?></td>
                                    
                      </tr>
					  

<?php }?>			   		
                      <p></p> <p></p> <p></p> <p></p>
                      <tr>
                        <th>Inbound Supervisor:</th>
                        
                        <th>_________________________</th>
                       
<?php
    $query=mysqli_query($con,"select * from user where user_id='$id'")or die(mysqli_error($con));
    $row=mysqli_fetch_array($query);
 
?>                      
                      
                        
                        <th></th>
                        <th></th>
                        <th>Checked By:</th> <th><?php echo $row['name'];?></th>
                      </tr>  
                    </tbody>
                    
                  </table>
                </div><!-- /.box-body -->
				</div>  
				</form>	
                </div><!-- /.box-body -->
                <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
                <a class = "btn btn-primary btn-print" href = "home.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Homepage</a>
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
           
          </div><!-- /.row -->
	  
             
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
     
    </div><!-- ./wrapper -->
	
	
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
   
  </body>
</html>
