<?php
    $mysqli = mysqli_connect("localhost","root","","webbangiay");

    if (mysqli_connect_errno()) {
        echo"Lỗi". mysqli_connect_error();
        exit();
    }
?>