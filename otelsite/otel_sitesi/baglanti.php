<?php

$host = 'localhost';
$database = 'db_otel';
$username = 'root';
$password = '';

$connection = mysqli_connect($host,$username,$password,$database);
if(mysqli_connect_errno($connection)){
    die("Şuanda hizmet veremiyoruz.");
}
mysqli_set_charset($connection, "UTF8");
?>