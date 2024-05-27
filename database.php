<?php

$hostName = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbName = "project";
$conn= mysqli_connect($hostName, $dbuser, $dbpassword,  $dbName );

 if (!$conn){

    die("something is wrong:");
   
} 

?>