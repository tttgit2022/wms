<?php $rfno='123';
echo 'show';
include('createbarcode.php');
echo bar128(stripslashes($rfno)); 
echo 'chk ok'; ?>