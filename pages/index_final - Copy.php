<?php
include 'DBController.php';
$db_handle = new DBController();
$productResult = $db_handle->runQuery("SELECT * FROM `stockin` INNER JOIN product on product.prod_id=stockin.prod_id where `final`='1'");

if (isset($_POST["export"])) {
  
  $filename = "Export_excel.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
   
 $isPrintHeader = false;
   $sno=0;  if (! empty($productResult)) {
        foreach ($productResult as $row) {
            if (! $isPrintHeader) {
               
 echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }

    exit();
}
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style>
body {
    font-size: 0.95em;
    font-family: arial;
    color: #212121;
}

th {
    background: #E6E6E6;
    
border-bottom: 1px solid #000000;
}

#table-container {
    width: 850px;
    margin: 50px auto;
}

table#tab {
    border-collapse: collapse;
  
  width: 100%;
}

table#tab th, table#tab td {
    border: 1px solid #E0E0E0;
    padding: 8px 15px;
    text-align: left;
    font-size: 0.95em;
}

.btn {
    
padding: 8px 4px 8px 1px;
}
#btnExport {
    padding: 10px 40px;
    background: #499a49;
    border: #499249 1px solid;
    color: #ffffff;
    font-size: 0.9em;
   
 cursor: pointer;
}
</style>
</head>

<head>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Product Inventory Report | <?php include('../dist/includes/title.php');?></title>
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
		  
          
      }
    </style>
 </head>
</head>
<body>
    
    <h5><b><?php echo $row['branch_name'];?></b> </h5>  
                  		  <h5><b> TAQ-Royal Fan Warehouse ASN List as on, <?php echo date("M d, Y");?></b></h5>
                  
				  <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
							<a class = "btn btn-primary btn-print" href = "home.php"><i class ="glyphicon glyphicon-arrow-left"></i> Back to Homepage</a>   
	
                            
    <div >
        <table id="tab">
            <thead>
                <tr>
                   
 <th>Doc ID</th>
 <th>Item Name</th>
    <th>Description</th>
 	<th>Doc Qty</th>
     <th>Physical Qty</th>
           
     </tr>
            </thead>
            <tbody>
 
            <?php $qt=0;
            if (! empty($productResult)) {
                foreach ($productResult as $key => $value) {
                    ?>
                 
                     <tr>
<td><?php echo $productResult[$key]["rec_dnno"]; ?> </td>    
 <td><?php echo $productResult[$key]["prod_name"]; ?></td>                   
 <td><?php echo $productResult[$key]["prod_desc"]; ?></td>  
<td><?php echo $productResult[$key]["qty"];  
$qt=$qt+$productResult[$key]["qty"];?></td>
<td> </td>    

 
</tr>
             <?php
                }
            }
            ?>
<tr> <td></td><td></td><td><b> Total Items </b></td> <td><b><?php echo $qt; ?> </b></td> <td></td> </tr>               
            
      </tbody>
        </table>
      </tbody>
      <br><br>
        </table>

        
    </div>
</body>
</html>