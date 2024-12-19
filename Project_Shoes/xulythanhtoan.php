<?php
        session_start(); // Bắt đầu phiên làm việc của session
        include("../admincp/config/config.php");
        $id_khachhang = $_SESSION['id_khachhang'];
        $code_order = rand(0,9999);
        $shippingAddress = $_POST['shippingAddressInfo'];
        $payment = $_POST['choice'];
        $insert_cart = "insert into tbl_cart(userid, code_cart, cart_status, diachi, thanhtoan) value('".$id_khachhang."','".$code_order."', 1, '".$shippingAddress."', '".$payment."')";
        $cart_query = mysqli_query($mysqli, $insert_cart);
        if($cart_query){
            //Thêm giỏ hàng chi tiết
            foreach($_SESSION['cart' ] as $key => $value){
                $id_sanpham = $value['id'];
                $soluong = $value['soluong'];
                $size = $value['size'];
                $insert_order_details = "insert into tbl_cart_details(id_sanpham, code_cart, soluongmua, sizeOwn) value('".$id_sanpham."','".$code_order."', '".$soluong."','".$size."')";
                mysqli_query($mysqli, $insert_order_details);
            }
        }
        echo"<script>alert('Cảm ơn bạn đã mua hàng')</script>";
        unset($_SESSION["cart"]);
        header("Location: history.php");
    ?>