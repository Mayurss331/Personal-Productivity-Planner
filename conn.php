<?php
 function sql_query($sql){
    $conn=mysqli_connect("localhost","root","","PPP");
    // Check connection 
    if ($conn->connect_error) { 
        die("Connection failure: " 
            . $conn->connect_error); 
    } else{
        return mysqli_query($conn,$sql);
    }
 }
?>