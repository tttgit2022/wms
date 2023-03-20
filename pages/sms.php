
<html>
 
    <body>
    

<?php 
                         $phone = "923419301402"; echo $phone;
                         $message = "SMS Service"; echo $message;
                         $tempurl =
"https://connect.jazzcmt.com/sendsms_url.html?Username=03028501452&Password=Taqgln?4n&From=TAQ&To=$phone&Message=$message";
                         

// create a new cURL resource
                         $ch = curl_init();
                         // set URL and other appropriate options
                         curl_setopt($ch, CURLOPT_URL, $tempurl);
                         // grab URL and pass it to the browser
                         curl_exec($ch);
                         // close cURL resource, and free up system resources
                         curl_close($ch);
                         echo 'Message Sent';
                         ?>
</body>
</html>