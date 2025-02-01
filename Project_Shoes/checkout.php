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
        <form action="xulythanhtoanmomo.php" method="POST" class="container" enctype="application/x-www-form-urlencoded">
            <div class="Nhat_CD-title1">Contact Details</div>
            <div class="Nhat_CD-title2">We will use these details to keep you inform about your delivery.</div>
            <div class="email">Your email: <?php echo $_SESSION['email']?></div>
            <label for="shippingAddressInfo">Shipping Address</label>
                <div id="Nhat_SA-input-field-DA">
                    <div id="Nhat_SA-DA">
                        <input type="text" name="shippingAddressInfo" id="address" placeholder="Find Delivery Address*" required>
                        <div class="hint">Start typing your street address or zip code for suggestion</div>
                    </div>
                </div>

            <label for="">Payment method</label>
                <button type="submit" name="payUrl" value="MoMo" class="checkout-button">MoMo</button>
        </form>

        <form action="" method="POST" class="container" enctype="application/x-www-form-urlencoded" onsubmit="return validateForm()">
            <input type="hidden" name="shippingAddressInfo" value="<?php echo $shippingAddressInfo; ?>">
            <button type="submit" name="payUrl" value="VnPay" class="checkout-button">VnPay</button>
        </form>

        <form action="" method="POST" class="container" enctype="application/x-www-form-urlencoded" onsubmit="return validateForm()">
            <button type="submit" name="payUrl" value="PayPal" class="checkout-button">PayPal</button>
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