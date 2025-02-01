<?php
    session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    
    <link rel="stylesheet" href="./assets/css/Khoi_header.css">
    <link rel="stylesheet" href="./assets/css/Khoi_footer.css">
    <link rel="stylesheet" href="./assets/css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
          integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
          crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>

<?php
    include("../admincp/config/config.php");
    include("header.php");
?>
    


    <div class="Manh_body">
    <?php
        $sql_chitiet = "select * from tbl_sanpham, tbl_danhmuc where tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc and tbl_sanpham.id_sanpham = '$_GET[id]' limit 1";
        $query_chitiet = mysqli_query($mysqli,$sql_chitiet);
        while($row_chitiet = mysqli_fetch_array($query_chitiet)) {
    ?>
        <div class="Manh_content">
            <div class="Manh_img">
                <img src="../admincp/modules/quanlysp/uploads/<?php echo $row_chitiet['hinhanh']?>" class="Manh_shoe">
            </div>
            <div class="Manh_desc">
                <p class="Manh_NR">Phiên bản mới</p>
                <h1><?php echo strtoupper($row_chitiet['tensanpham']) ?></h1>
                <p class="Manh_price"><?php echo number_format($row_chitiet['giasp']).'₫'?></p>

                
                <p class="Manh_size">SIZE</p>
    <form method="POST" action="themgiohang.php?idsanpham=<?php echo $row_chitiet['id_sanpham'] ?>">

                <div class="Size_container">
                <label class="<?php echo $row_chitiet['size'] == 0 ? 'Size_item-off' : 'Size_item'; ?>" for="size1">
                    <input type="radio" id="size1" name="size" value="<?php echo $row_chitiet['size']; ?>" <?php echo $row_chitiet['size'] == 0 ? 'disabled' : ''; ?>>
                    <?php echo $row_chitiet['size']; ?>
                </label>
                <label class="<?php echo $row_chitiet['size1'] == 0 ? 'Size_item-off' : 'Size_item'; ?>" for="size2">
                    <input type="radio" id="size2" name="size" value="<?php echo $row_chitiet['size1']; ?>" <?php echo $row_chitiet['size1'] == 0 ? 'disabled' : ''; ?>>
                    <?php echo $row_chitiet['size1']; ?>
                </label>

                <label class="<?php echo $row_chitiet['size2'] == 0 ? 'Size_item-off' : 'Size_item'; ?>" for="size3">
                    <input type="radio" id="size3" name="size" value="<?php echo $row_chitiet['size2']; ?>" <?php echo $row_chitiet['size2'] == 0 ? 'disabled' : ''; ?>>
                    <?php echo $row_chitiet['size2']; ?>
                </label>

                <label class="<?php echo $row_chitiet['size3'] == 0 ? 'Size_item-off' : 'Size_item'; ?>" for="size4">
                    <input type="radio" id="size4" name="size" value="<?php echo $row_chitiet['size3']; ?>" <?php echo $row_chitiet['size3'] == 0 ? 'disabled' : ''; ?>>
                    <?php echo $row_chitiet['size3']; ?>
                </label>
                </div>

            
                <?php
if(isset($_SESSION['email'])) {
?>
    <!-- thêm giỏ hàng -->
        <div class="Cart">
            <input style="cursor: pointer;" name="themgiohang" type="submit" value="ADD TO CART" class="Manh__addCart Manh_chung">
        </div>
    </form>
    <!-- end thêm giỏ hàng -->
<?php
} else {
    echo '<p>Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng</p>';
}
?>
                <p style="font-size: 20px; font-weight: 600; margin-top: 36px;">Về sản phẩm</p>
                <p style="opacity: 80%; font-size: 20px; margin-top: 32px;">
                Sản phẩm này không được áp dụng cho mọi chương trình giảm giá và khuyến mại.</p>
                <ul style="margin-left: 30px; margin-top: 32px">
                    <li style="opacity: 80%;font-size: 18px;">
                        <?php echo strtoupper($row_chitiet['noidung'])?>
                    </li>
                    <li style="opacity: 80%; font-size: 18px; margin-top: 12px">
                    Tham gia adiClub để được miễn phí không giới hạn dịch vụ giao hàng, trả hàng và đổi hàng tiêu chuẩn.
                    </li>
                </ul>
            </div>
        </div>
            <?php
        }
        ?>
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
    </div>

    <?php
        include('footer.php');
    ?>
    <script src="./assets/javascript/products.js"></script>
</body>
</html>