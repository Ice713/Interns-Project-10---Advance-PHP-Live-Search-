<?php
    $conn=new mysqli("localhost", "root", "", "crud");
    if($conn->connect_error){
        die("Connect Failed".$conn->connect_error);
    }
?>