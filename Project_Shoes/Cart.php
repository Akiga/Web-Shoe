<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="./assets/css/Khoi_header.css">
    <link rel="stylesheet" href="./assets/css/Khoi_footer.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

<?php
    include("../admincp/config/config.php");
    session_start();
?>

    <?php
    include("header.php");
    ?>
<h1 style="width:100%; text-align:center;font-size:40px; margin:12px 0px">Shopping Cart</h1>

<table style="width: 1320px; text-align: center; border-collapse: collapse; margin:auto; margin-top:15px;" border="1">
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Image</th>
        <th>Quantity</th>
        <th>Size</th>
        <th>Product Price</th>
        <th>Total Price</th>
        <th>Actions</th>
    </tr>

    <?php
        if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
            $i = 0;
            $totalPrice = 0;
            foreach($_SESSION['cart'] as $cart_item){
                $itemTotal = $cart_item['soluong'] * $cart_item['giasp'];
                $totalPrice += $itemTotal;
                $i++;
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $cart_item['tensanpham']; ?></td>
        <td><img src="../admincp/modules/quanlysp/uploads/<?php echo $cart_item['hinhanh']; ?>" alt="Product Image"></td>
        <td>
            <a href="themgiohang.php?cong=<?php echo $cart_item['id'] ?>"><i class="fa-solid fa-plus"></i></a>
            <?php echo $cart_item['soluong']; ?>
            <a href="themgiohang.php?tru=<?php echo $cart_item['id'] ?>"><i class="fa-solid fa-minus"></i></a>
        </td>
        <td><?php echo $cart_item['size']; ?></td>
        <td><?php echo '$' . number_format($cart_item['giasp'], 0, '.', ','); ?></td> 
        <td><?php echo '$' . number_format($itemTotal, 0, '.', ','); ?></td>
        <td><a href="themgiohang.php?xoa=<?php echo $cart_item['id'] ?>">Delete</a></td>
    </tr>
    <?php
            }
    ?>
    <tr>
        <td colspan="8">
            <p class="cartInTable" style="float: left; width:25%;">Total: <?php echo '$' . number_format($totalPrice, 0, '.', ','); ?></p> 
            <a class="cartInTable" style="float: left; width:50%;" href="checkout.php">Proceed to Checkout</a>
            <p class="cartInTable" style="float: right;width:25%;"><a href="themgiohang.php?xoatatca=1">Delete All</a></p>
        </td>
    </tr>

    <?php
        } else {
    ?>
    <tr>
        <td colspan="8"><p>Your cart is empty</p></td>
    </tr>
    <?php
        }
    ?>
</table>


<style>
 /* Tiêu đề */
h1 {
    text-align: center;
    font-size: 40px;
    margin: 12px 0px; /* Giảm khoảng cách trên và dưới tiêu đề */
    color: #333;
    font-family: "Rubik", sans-serif;
}

/* Bảng Giỏ hàng */
table {
    width: 80%; /* Giảm độ rộng bảng nếu cần */
    margin: 15px auto; /* Giảm khoảng cách giữa bảng và các phần tử xung quanh */
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    font-size: 16px;
    color: #555;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow: hidden;
}

/* Hàng đầu tiên */
table th {
    background-color: #4A69E2;
    color: #fff;
    padding: 12px;
    text-align: center;
    font-weight: bold;
}

/* Hàng dữ liệu */
table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

/* Hình ảnh trong bảng */
table td img {
    max-width: 80px;
    height: auto;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Hàng lẻ - màu nền khác nhau */
table tr:nth-child(odd) {
    background-color: #f9f9f9;
}

table tr:nth-child(even) {
    background-color: #fff;
}

/* Hiệu ứng hover */
table tr:hover {
    background-color: #f1f5fc;
    cursor: pointer;
}

/* Tổng tiền và các hành động */
.cartInTable {
    font-size: 18px;
    text-align: center;
    color: #555;
    font-weight: bold;
    text-decoration: none;
}

/* Tùy chỉnh tổng tiền */
.cartInTable {
    font-size: 20px;
    font-weight: bold;
    color: #333;
}

.cartInTable a {
    color: #4A69E2;
    text-decoration: none;
    transition: color 0.3s;
}

.cartInTable a:hover {
    color: #1d4ed8;
}

</style>


<div class="Manh_Related-Products">
            <section class="product-suggestions">
                <h2 style="font-size: 48px;">You may also like</h2>
                <div class="carousel">
                  <button class="carousel-control prev" onclick="scrollCarousel(-1)">❮</button>
                  <?php
                        $sql_pro = "select * from tbl_sanpham";
                        $query_pro = mysqli_query($mysqli,$sql_pro);
                    ?>
                  <div class="carousel-inner">
                    <?php
                        while($row_pro = mysqli_fetch_array($query_pro))
                        {
                    ?>
                    <div class="product-card">
                      <img src="../admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh']?>" alt="Adidas Shoe 1">
                      <h3><?php echo strtoupper($row_pro['tensanpham']) ?></h3>
                      <a href="product.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham']?>"><button class="view-button">VIEW PRODUCT - <?php echo number_format($row_pro['giasp']).'$'?></button></a>
                    </div>
                    <?php
                    }
                    ?>
                  </div>
                  <button class="carousel-control next" onclick="scrollCarousel(1)">❯</button>
                </div>
              </section>
        </div>

    <?php
    include('footer.php');
    ?>

    
    <script src="./assets/javascript/products.js"></script>

</body>
</html>