<!DOCTYPE html>
<html lang="en">

<head>
    <title>Kicks Checkout</title>

    <!-- Link font chữ chèn vào html -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    <!-- Link Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="assets/css/Nhat_checkout.css">
    <link rel="stylesheet" href="assets/css/Khoi_header.css">
    <link rel="stylesheet" href="assets/css/Khoi_footer.css">
</head>

<body>

<?php
    include("../admincp/config/config.php");
    require_once("./config.php");            

    session_start();
?>
    <!-- <header> -->
    <?php
        include("header.php");
        if (isset($_GET['totalPrice'])) {
            $totalPrice = $_GET['totalPrice'];
        }
        $_SESSION['totalPrice'] = $totalPrice;

    ?>
    <!-- </header> -->
    <div class="divH"></div>
    <!-- <main> -->
    <script>
    function copyAddress() {
        var address = document.getElementById("address").value;
        document.getElementById("address2").value = address;

        // Kiểm tra nếu địa chỉ trống, không cho submit
        if (address.trim() === "") {
            alert("Vui lòng nhập địa chỉ giao hàng trước khi thanh toán.");
            return false;
        }
        return true;
    }
    </script>

    <form action="xulythanhtoanmomo.php" method="POST" class="container">
        <div class="Nhat_CD-title1">Chi tiết liên lạc</div>
        <div class="email">Email của bạn: <?php echo $_SESSION['email']?></div>
        
        <label for="shippingAddressInfo">Địa chỉ giao hàng</label>
        <input type="text" name="shippingAddressInfo" id="address" placeholder="Nhập địa chỉ*" required>

        <label>Phương thức thanh toán</label>
        <button type="submit" name="payUrl" value="MoMo" class="checkout-button">MoMo</button>
    </form>

    <form action="xulythanhtoanVnPay.php" method="POST" class="container" onsubmit="return copyAddress()">
        <input type="text" name="shippingAddressInfo" id="address2" hidden>
        <input class="form-control" id="order_id" name="order_id" type="hidden" value="<?php echo date("YmdHis") ?>"/>
        <button type="submit" name="redirect" value="VnPay" class="checkout-button">VnPay</button>
    </form>


    <!-- </main> -->
<div class="divH"></div>
    <?php
        include("footer.php");
    ?>
    

    
</body>

</html>

<script>
        function validateForm() {
            const address = document.getElementById('address').value;
            if (!address) {
                alert('Vui lòng nhập địa chỉ giao hàng trước khi tiếp tục!');
                return false; // Ngăn không cho form được gửi
            }
            return true; // Cho phép form được gửi
        }
</script>