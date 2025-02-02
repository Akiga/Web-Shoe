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
    $id_khachhang = $_SESSION['id_khachhang'];
    $sql_lietke_dh = "select * from tbl_cart, user where tbl_cart.userid = user.userid and tbl_cart.userid = '$id_khachhang'";
    $query_lietke_dh = mysqli_query($mysqli,$sql_lietke_dh)

?>
<h1 style="width:100%; text-align:center; font-size:40px; margin:12px 0px">Đơn hàng</h1>
<table border="1" style="border-collapse:collapse; width:80%; margin:auto;">

    <tr>
        <th>ID</th>
        <th>Mã đơn hàng</th>
        <th>Địa chỉ</th>
        <th>Email</th>
        <th>Phương thức thanh toán</th>
        <th>Trạng thái</th>
        <th>Chi tiết</th>
    </tr>
   <?php
   $i=0;
   while($row = mysqli_fetch_array($query_lietke_dh))    {
    $i++;
   ?>
   <tr>
       <td><?php echo $i?></td>
       <td><?php echo $row['code_cart']?></td>
       <td><?php echo $row['diachi']?></td>
       <td><?php echo $row['email']?></td>
       <td><?php echo $row['ThanhToan']?></td>
       <td>
        <?php if($row['cart_status']==1){
            echo 'Đang chờ xác nhận';
        }elseif ($row['cart_status'] == 0) {
            echo 'Đang chờ giao hàng';
        } elseif ($row['cart_status'] == 2) {
            echo '<p class="tranfer">Đã giao hàng</p>';
            echo '<a href="#" onclick="alert(\'Vui lòng liên hệ 0123456789 để báo cáo sự cố.\')">Trả lại sản phẩm</a>';
        }elseif ($row['cart_status'] == 3) {
            echo '<p class="huy">Đơn hàng đã hủy</p>';
        }elseif ($row['cart_status'] == 4) {
            echo '<p class="huy">Đã trả lại</p>';
        }elseif ($row['cart_status'] == 5) {
            echo '<p class="green">Hoàn thành</p>';
        }
        ?>
        </td>

       <td>
           <a href="xemdonhang.php?code=<?php echo$row['code_cart']?>">Xem đơn hàng</a>
       </td>
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
    margin: 12px 0px;
    color: #333;
    font-family: "Rubik", sans-serif;
}

/* Bảng */
table {
    border-collapse: collapse;
    width: 80%;
    margin: 20px auto;
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

/* Liên kết */
table a {
    text-decoration: none;
    color: #4A69E2;
    font-weight: bold;
    transition: color 0.3s;
}

table a:hover {
    color: #1d4ed8;
}

/* Tình trạng đơn hàng */
table .tranfer {
    color: #007BFF;
    font-weight: bold;
}

table .huy {
    color: #FF4D4F;
    font-weight: bold;
}

table .green {
    color: #28A745;
    font-weight: bold;
}

</style>

<div class="Manh_Related-Products">
            <section class="product-suggestions">
                <h2 style="font-size: 48px;">Bạn cũng có thể thích</h2>
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
                      <a href="product.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham']?>"><button class="view-button">XEM SẢN PHẨM - <?php echo number_format($row_pro['giasp']).'$'?></button></a>
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