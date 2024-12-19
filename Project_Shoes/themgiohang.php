<?php
    session_start(); // Bắt đầu phiên làm việc của session
    include("../admincp/config/config.php"); // Kết nối tới file cấu hình của cơ sở dữ liệu

    //Thêm số lượng
    if(isset($_GET['cong'])) {
        $id = $_GET['cong'];
        $product = array(); // Khởi tạo lại mảng sản phẩm tạm thời
    
        // Duyệt qua giỏ hàng hiện tại
        foreach($_SESSION['cart'] as $cart_item) {
            if($cart_item['id'] != $id) {
                // Giữ nguyên sản phẩm không thay đổi
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'],
                    'id' => $cart_item['id'],
                    'soluong' => $cart_item['soluong'],
                    'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'],
                    'masp' => $cart_item['masp'],
                    'size'=> $cart_item['size'] // Lấy size từ giỏ hàng cũ
                );
            } else {
                // Tăng số lượng sản phẩm và giữ nguyên size
                $tangsoluong = $cart_item['soluong'] + 1;
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'],
                    'id' => $cart_item['id'],
                    'soluong' => $tangsoluong,
                    'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'],
                    'masp' => $cart_item['masp'],
                    'size'=> $cart_item['size'] // Giữ lại size
                );
            }
        }
    
        // Cập nhật lại giỏ hàng trong session
        $_SESSION['cart'] = $product;
    
        // Chuyển hướng về trang giỏ hàng
        header('Location: Cart.php');
    }
    
    

    // Trừ số lượng
    if(isset($_GET['tru'])) {
        $id = $_GET['tru'];
        $product = array(); // Khởi tạo lại mảng sản phẩm tạm thời
    
        // Duyệt qua giỏ hàng hiện tại
        foreach($_SESSION['cart'] as $cart_item) {
            if($cart_item['id'] != $id) {
                // Giữ nguyên sản phẩm không thay đổi
                $product[] = array(
                    'tensanpham' => $cart_item['tensanpham'],
                    'id' => $cart_item['id'],
                    'soluong' => $cart_item['soluong'],
                    'giasp' => $cart_item['giasp'],
                    'hinhanh' => $cart_item['hinhanh'],
                    'masp' => $cart_item['masp'],
                    'size'=> $cart_item['size'] // Lấy size từ giỏ hàng cũ
                );
            } else {
                // Giảm số lượng sản phẩm và giữ nguyên size
                if($cart_item['soluong'] > 1) {
                    $giamsoluong = $cart_item['soluong'] - 1;
                    $product[] = array(
                        'tensanpham' => $cart_item['tensanpham'],
                        'id' => $cart_item['id'],
                        'soluong' => $giamsoluong,
                        'giasp' => $cart_item['giasp'],
                        'hinhanh' => $cart_item['hinhanh'],
                        'masp' => $cart_item['masp'],
                        'size'=> $cart_item['size'] // Giữ lại size
                    );
                }
            }
        }
    
        // Cập nhật lại giỏ hàng trong session
        $_SESSION['cart'] = $product;
    
        // Chuyển hướng về trang giỏ hàng
        header('Location: Cart.php');
    }
    

    // Xóa sản phẩm khỏi giỏ hàng
    if(isset($_SESSION['cart']) && isset($_GET['xoa'])){
        $id = $_GET['xoa']; // Lấy ID của sản phẩm cần xóa
        $product = array(); // Khởi tạo mảng giỏ hàng mới
    
        foreach($_SESSION['cart'] as $cart_item){
            if($cart_item['id'] != $id){ // Nếu không phải sản phẩm cần xóa
                $product[] = $cart_item; // Thêm sản phẩm vào giỏ hàng mới
            }
        }
    
        $_SESSION['cart'] = $product; // Cập nhật giỏ hàng mới vào session
        header('Location: Cart.php'); // Chuyển hướng về trang giỏ hàng
    }
    
    // End Xóa sản phẩm khỏi giỏ hàng

    // Xóa tất cả sản phẩm khỏi giỏ hàng
    if(isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
        unset($_SESSION['cart']); // Xóa giỏ hàng khỏi session
        header('Location:Cart.php'); // Chuyển hướng về trang giỏ hàng
    }
    // End Xóa tất cả sản phẩm khỏi giỏ hàng

    // Thêm sản phẩm vào giỏ hàng
    if(isset($_POST['themgiohang'])){
        $id = $_GET['idsanpham']; // Lấy ID của sản phẩm cần thêm
        $soluong = 1; // Khởi tạo số lượng sản phẩm là 1
    
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        $row = mysqli_fetch_array($query);
    
        // Nếu sản phẩm tồn tại trong cơ sở dữ liệu
        if($row){
            $size = $_POST['size']; // Lấy size từ form
    
            // Tạo một mảng mới chứa thông tin sản phẩm
            $new_product = array(
                'tensanpham' => $row['tensanpham'],
                'id' => $id,
                'soluong' => $soluong,
                'giasp' => $row['giasp'],
                'hinhanh' => $row['hinhanh'],
                'masp' => $row['masp'],
                'size' => $size
            );
    
            // Kiểm tra xem giỏ hàng đã tồn tại chưa
            if(isset($_SESSION['cart'])){
                $found = false; // Biến kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
                $product = $_SESSION['cart']; // Lấy giỏ hàng hiện tại
    
                // Duyệt qua từng sản phẩm trong giỏ hàng
                foreach($product as $cart_item){
                    // Nếu sản phẩm đã tồn tại trong giỏ hàng, tăng số lượng lên
                    if($cart_item['id'] == $id && $cart_item['size'] == $size){
                        $cart_item['soluong'] += 1; // Tăng số lượng của sản phẩm
                        $found = true; // Đánh dấu sản phẩm đã tồn tại
                    }
                }
    
                // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm sản phẩm mới vào giỏ hàng
                if(!$found){
                    $product[] = $new_product; // Thêm sản phẩm mới vào giỏ hàng
                }
    
                // Cập nhật lại giỏ hàng vào session
                $_SESSION['cart'] = $product;
            } else {
                // Nếu giỏ hàng chưa tồn tại, tạo mới giỏ hàng
                $_SESSION['cart'] = array($new_product);
            }
    
            // Chuyển hướng đến trang giỏ hàng
            header('Location: Cart.php');
        }
    }
    
    // End Thêm sản phẩm vào giỏ hàng
?>
