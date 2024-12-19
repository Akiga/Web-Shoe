<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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


<?php
    $sql_lietke_dh = "select * from  tbl_cart_details, tbl_sanpham where tbl_cart_details.id_sanpham = tbl_sanpham.id_sanpham 
    and tbl_cart_details.code_cart = '$_GET[code]'";
    $query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh)

?>
<h1 style="width:100%; text-align:center;font-size:40px; margin:12px 0px">Order Details</h1>
<table border="1" style="border-collapse:collapse; width:50%; margin:auto;">
    <tr>
        <th>ID</th>
        <th>Order Code</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Shoe Size</th>
        <th>Unit Price</th>
        <th>Total Price</th>
    </tr>
   <?php
   $i = 0;
   $totalPrice = 0;
   while($row = mysqli_fetch_array($query_lietke_dh))    {
    $i++;
    $itemTotal = $row['giasp'] * $row['soluongmua'];
    $totalPrice += $itemTotal;
   ?>
   <tr>
       <td><?php echo $i?></td>
       <td><?php echo $row['code_cart']?></td>
       <td><?php echo $row['tensanpham']?></td>
       <td><?php echo $row['soluongmua']?></td>
       <td><?php echo $row['sizeOwn']; ?></td>
       <td><?php echo '$' . number_format($row['giasp']) ?></td>
       <td><?php echo '$' . number_format($row['giasp'] * $row['soluongmua']) ?></td>
   </tr>
   <?php
    }
    ?>

    <tr>
        <td colspan="7">
            <p class="cartInTable" style="float: left; width:25%;">Total: <?php echo '$' . number_format($totalPrice, 0, '.', ','); ?></p> 
        </td>
    </tr>
</table>

<style>
    /* Tiêu đề */
h1 {
    text-align: center;
    font-size: 40px;
    margin: 12px 0px;
    color: #333;
    font-family: "Rubik", sans-serif;
}

/* Bảng */
table {
    width: 80%;
    margin: 30px auto;
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

</table>
</body>
</html>