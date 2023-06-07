<?php
    $con = mysqli_connect("localhost","root","","fruit_shop1");
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>