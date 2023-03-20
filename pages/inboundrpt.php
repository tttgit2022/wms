<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
if(empty($_SESSION['branch'])):
header('Location:../index.php');
endif;
?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<form action="inboundrpt.php" enctype="multipart/form-data" method="post" name="cat">
<table width="100%"  cellpadding="0" cellspacing="0" align="right"> 
   Select Date :
   <input type="date" name='start' >
   <input type="date" name='end' >
   
 <input name="submit" type="submit" value="Submit" /></td>
</tr></table></form>
<style type="text/css" media="screen">
    .printspan
    {
        display: none;
    }
</style>
<style type="text/css" media="print">
    .printspan
    {
        display: inline;
        font-family: Arial, sans-serif;
        font-size: 20 pt;
        color: red;
    }
</style>
<style> 
body,td,th {
	font-size: 15px;
}
</style> 

<style type="text/css" media="print,screen" >
table td {
	border-bottom:1px solid gray;
}
th {
font-family:Arial;
color:black;

}
thead {
	display:table-header-group;
}
tbody {
	display:table-row-group;
}
</style>
</head>

<body>

 

<? 	

$start=$_POST['start']; $end=$_POST['end'];  
            $start=date("d-M-Y",strtotime($start));
			$end=date("d-M-Y",strtotime($end));
		
 ?>
<table  width="1000" border="1" cellpadding="0" cellspacing="0"  align="center"> 
	
 <td align="center" class="path"> <h1> TAQ-Royal Fan Warehouse, LAHORE</h1>
   <h2>Inbound Report from <? echo $start; ?> To  <? echo $end; ?>  </h2></td> 
</table> 

<table width="100%" border="1" cellpadding="0" cellspacing="0"   > 
<thead>
		
		                     <th> S#</th>							
                            <th>    Documnet No.  </th>
                             
	                        <th>  Product </th>						
                             <th> Description.</th>
	            			 <th> Quantity</th>		
                              <th>Received Date </th>
	                            <th>  Truck No </th>
                             
	           </thead>
		     
	                           	
                             
 

<?php 
include('../dist/includes/dbcon.php');
 $sno=1;
 
	$query=mysqli_query($con,"SELECT * FROM `stockin` INNER JOIN product on product.prod_id=stockin.prod_id where stockin.date >='$start' and stockin.date <= '$end' order by stockin.date ASC")or die(mysqli_error($con));
		$qty=0;$grand=0;$discount=0;$sno=1; 
								while($row=mysqli_fetch_array($query)){ ?>
                
            <tr>
            <td><?php echo $sno; ?></td>  
            <td><?php echo $row['rec_dnno'];;?></td>
            <td><?php echo $row['prod_name'];?></td>
            <td><?php echo $row['prod_desc'];?></td>
            <td align="right"><?php echo $row['qty']; $grand=$grand+$row['qty']; ?></td>  
			<td align="right"><?php echo $row['date']; ?></td>  
			<td><?php echo $row['truck_no'];?></td>
			
		
 <?php $sno=$sno+1; }  ?>                       
                      </tr>
                         <td> </td> <td> </td> <td> </td> <td><b> Total Products Recive </b></td> <td> <b><?php echo $grand;?></b></td> <td> </td> <td> </td>  <td> </td> 
 </table>					 
        
 
  
</body>
</html>
