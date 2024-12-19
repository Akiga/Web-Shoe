<?php
include("../../config/config.php");

    if(isset($_GET["cart_status"]) && isset($_GET["code"])) {
        $status = $_GET['cart_status'];
        $code =$_GET['code'];
        $sql = mysqli_query($mysqli, "update tbl_cart set cart_status=0 where code_cart = '".$code."'");

        if ($status == 0) {
            // Cập nhật trạng thái thành "Đã chấp nhận"
            $sql = "UPDATE tbl_cart SET cart_status = 0 WHERE code_cart = '$code'";
        } elseif ($status == 2) {
            // Cập nhật trạng thái thành "Giao hàng"
            $sql = "UPDATE tbl_cart SET cart_status = 2 WHERE code_cart = '$code'";
        }elseif ($status == 3) {
            // Cập nhật trạng thái thành "Hủy"
            $sql = "UPDATE tbl_cart SET cart_status = 3 WHERE code_cart = '$code'";
        }
        elseif ($status == 4) {
            // Cập nhật trạng thái thành "Hoàn trả"
            $sql = "UPDATE tbl_cart SET cart_status = 4 WHERE code_cart = '$code'";
        }elseif ($status == 5) {
            // Cập nhật trạng thái thành "Hoàn trả"
            $sql = "UPDATE tbl_cart SET cart_status = 5 WHERE code_cart = '$code'";
        }

        mysqli_query($mysqli, $sql);
        header("Location:../../index.php?action=quanlydonhang&query=lietke");
    }

    // if(){

    // }

?>