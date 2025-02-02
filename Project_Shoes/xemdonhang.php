<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/Khoi_header.css">
    <link rel="stylesheet" href="./assets/css/Khoi_footer.css">
    <link rel="stylesheet" href="assets/css/cart.css">
    <link rel="stylesheet" href="assets/css/chitietdonhang.css">
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
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Kích thước giày</th>
        <th>Đơn giá</th>
        <th>Tổng giá</th>
       <th>Đánh giá</th>
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
       <td><?php echo $row['tensanpham']?></td>
       <td><?php echo $row['soluongmua']?></td>
       <td><?php echo $row['sizeOwn']; ?></td>
       <td><?php echo '$' . number_format($row['giasp']) ?></td>
       <td><?php echo '$' . number_format($row['giasp'] * $row['soluongmua']) ?></td>
       <td><a href="">Click</a></td>
   </tr>
   <?php
    }
    ?>

    <tr>
        <td colspan="8">
            <p class="cartInTable" style="float: left; width:25%;">Total: <?php echo '$' . number_format($totalPrice, 0, '.', ','); ?></p> 
        </td>
    </tr>
</table>

<div class="bg_cmt">
    <form action="">
        <div class="fir">
            <h1>ĐÁNH GIÁ</h1>
            <p>Name</p>
        </div>
        <label for="tinhtrang">Star: </label>
            <select id="tinhtrang" name="tinhtrang">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <br>
        <label for="noidung">Nội dung</label><br>
        <textarea id="noidung" rows="5" style="resize: none;" name="noidung" required class="cmt"></textarea>
        <input type="submit" value="GỬI" name="addCmt">
    </form>
</div>

</table>
<?php
include('footer.php');
?>
</body>
</html>