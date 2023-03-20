<?php  
$conn = mysqli_connect('localhost','tlpkcom','yXI1zlLf2@2P2*','tlpkcom_royal_inventory')or die(mysqli_error());


if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
    mysqli_query("INSERT INTO `product`(`prod_name`, `prod_desc`, `prod_qty`) VALUES 
                ( 
                   '".addslashes($data[0])."', 
                   '".addslashes($data[1])."',
                   '".addslashes($data[2])."'
                   
		                ) 
            "); 
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
    header('Location:csv.php?success=1'); die; 

} 

?> 