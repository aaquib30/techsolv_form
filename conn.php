<?php
$conn = new mysqli('localhost','root','','tech_solve');

if($conn->connect_error){
    die('connection fail'.
    $conn->connect_error);
}else{
    // echo 'connection succesfully';
}

?>