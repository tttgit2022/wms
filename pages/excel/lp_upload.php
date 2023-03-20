<?php 
session_start();
$id=$_SESSION['id'];
include('dbconfig.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_POST['save_lp_data']))
{
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach($data as $row)
        { 
            if($count > 0)
            {
                $a = $row['0']; 
                $b = $row['1'];
                $c = $row['2'];
                $d = $row['3'];
                $e = $row['4'];
                $f = $row['5'];
                $g = $row['6'];
                $h = $row['7'];
                $i = $row['8'];
            
        
	
 $studentQuery = "INSERT INTO `stockin`(`rec_dnno`, `prod_id`, `qty`, `date`, `branch_id`, `whcode`, `rec_point`, `remarks`,user_id,transporter,final) 
 VALUES ('$a','$b','$c','$d','1', 'Store 14 E','S-14','0','$id','$f','1')";
                $result = mysqli_query($con, $studentQuery);
                
  
                $msg = true;
            } 
            else
            {
                $count = "1";
            }
        }


        if(isset($msg))
        {
            $_SESSION['message'] = "Successfully Imported";
            header('Location: ../final.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "LP Already Exist";
            header('lp.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid File";
        header('Location: lp_index.php');
        exit(0);
    }
}

?>