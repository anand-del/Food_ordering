<?php
//$con=mysqli_connect('localhost','root','','online_food');

 define("DB_HOST", "localhost");
 define("DB_USER", "root");
 define("DB_PASS", "");
 define("DB_NAME", "online_food");

   $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if (!$con) {
    	
    	die("connection not established" . mysqli_error($con));
    }/*else{
    	echo "Connection established";
    }*/
?>