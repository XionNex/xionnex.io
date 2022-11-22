<?php
// $conn = new mysqli($mysql_host, $mysql_user, $mysql_pass, $mysql_database)or die('Cannot open database');	
// $con=mysqli_connect("localhost", "id13019632codeastro.com", "PASS=word@codeastro.com", "id13019632_attendance");

$con=mysqli_connect("localhost", "root", "", "studentmsdb");
if(mysqli_connect_errno()){
    echo "Connection Fail".mysqli_connect_error(); 
}

    // $con=mysqli_connect("localhost", "root", "codeastro.com", "amsys");
    // if(mysqli_connect_errno()){
    // echo "Connection Fail".mysqli_connect_error();
    // }

?><!-- Log on to codeastro.com for more projects! -->