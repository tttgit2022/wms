<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <style>
      
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
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-warning" href="homesub.php">Back</a>
              <a class="btn btn-lg btn-primary" href="#add" data-target="#add" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-plus text-blue"></i></a>
            </h1>
Download Item List <form action="index_product.php" method="POST" enctype="multipart/form-data">
<button type="submit" name="load_excel_data" class="btn btn-primary mt-3">Excel File</button>

</form>

            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Item</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
	     
            
            <div class="col-xs-12">
              <div class="box box-primary">
    
                <div class="box-header">
                  <h3 class="box-title">Item List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	
                        <th>Item Id</th>
                        <th>Item Code</th>
                        <th>Description</th>
						            <th>Item Qty</th>
            						<th>Zone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
		
		$query=mysqli_query($con,"select * from product  where branch_id='$branch' order by prod_name")or die(mysqli_error());
		while($row=mysqli_fetch_array($query)){
		
?>
                      <tr>
                      	<td><?php echo $row['prod_id'];?></td>
                        <td ><?php echo $row['prod_name'];?></td>
                        <td height="4"><?php echo 'Category= ' . $row['category'] . ' ' . 'UOM= ' . $row['uom'] .  "<br>" . 'Weight= ' . $row['weight'] . ' ' . 'Volume= ' . $row['volume'];?></td>
						            <td><?php echo $row['prod_qty'];?></td>
                        <td><?php echo $row['zone'];?></td>
            						
                        <td>
				<a href="#updateordinance<?php echo $row['prod_id'];?>" data-target="#updateordinance<?php echo $row['prod_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
			
						</td>
                      </tr>
<div id="updateordinance<?php echo $row['prod_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
	  <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Update Product Details</h4>
              </div>
              <div class="modal-body">
			  <form class="form-horizontal" method="post" action="product_update.php" enctype='multipart/form-data'>
        
                
				<div class="form-group">
					<label class="control-label col-lg-3" for="name">Product Name</label>
					<div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['prod_id'];?>" required>  
					  <input type="text" class="form-control" id="name" name="prod_name" value="<?php echo $row['prod_name'];?>" required>  
					</div>
				</div> 
        
        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Description</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="name" name="desc" value="<?php echo $row['prod_desc'];?>" required>  
          </div>
        </div> 

        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Category</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="name" name="cat_name" value="<?php echo $row['category'];?>" required>  
          </div>
        </div> 

        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Uom</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="name" name="uom" value="<?php echo $row['uom'];?>" required>  
          </div>
        </div> 

        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Weight</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="name" name="weight" value="<?php echo $row['weight'];?>" required>  
          </div>
        </div> 

        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Volume</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="name" name="volume" value="<?php echo $row['volume'];?>" required>  
          </div>
        </div> 

				
				
				
				
              </div><br><br><br><br><br><br><br>
              <div class="modal-footer">
		<button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
			  </form>
            </div>
			
        </div><!--end of modal-dialog-->
 </div>
 <!--end of modal-->                    
<?php }?>					  
                    </tbody>
                    <tfoot>
                      <tr>
                      	
                        <th>Item Id</th>
                        <th>Item <Code></Code></th>
                        <th>Description</th>
						           <th>Item Qty</th>
                       <th>Zone</th>
						
                        <th>Action</th>
                      </tr>					  
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
 
            </div><!-- /.col -->
			
			
          </div><!-- /.row -->
	  
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->
<div id="add" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" style="height:auto">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New Product</h4>
              </div>
              <div class="modal-body">
        <form class="form-horizontal" method="post" action="product_add.php" enctype='multipart/form-data'>
        
                
        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Product Name</label>
          <div class="col-lg-9"><input type="hidden" class="form-control" id="id" name="id" required>  
            <input type="text" class="form-control" id="name" name="prod_name" placeholder="Product Name" required>  
          </div>
        </div> 
        <div class="form-group">
          <label class="control-label col-lg-3" for="price">Product Description</label>
          <div class="col-lg-9">
            <textarea class="form-control" id="price" name="prod_desc" placeholder="Product Description"></textarea>  
          </div>
        </div>
        
        <div class="form-group">
        <label class="control-label col-lg-3" for="price">Category</label>
                    <div class="col-lg-9">
                      <select class="form-control select2" name="cat_name" required>     
      <?php
				$query2=mysqli_query($con,"select * from category order by cat_name ASC")or die(mysqli_error());
				  while($row=mysqli_fetch_array($query2)){
		      ?>
				    <option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></option>
		      <?php }?>
                    </select>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->


                  <div class="form-group">
          <label class="control-label col-lg-3" for="name">Uom</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="name" name="uom" value="0" required>  
          </div>
        </div> 

        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Weight</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="name" name="weight" value="0" required>  
          </div>
        </div> 

        <div class="form-group">
          <label class="control-label col-lg-3" for="name">Volume</label>
          <div class="col-lg-9">
            <input type="text" class="form-control" id="name" name="volume" value="0" required>  
          </div>
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
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
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
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
