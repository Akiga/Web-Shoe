<?php
    session_start();
    
?>


<!DOCTYPE html><html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    
    <link rel="stylesheet" href="./assets/css/Khoi_header.css">
    <link rel="stylesheet" href="./assets/css/Khoi_footer.css">
    <link rel="stylesheet" href="assets/css/Khoi_index.css">
    <link rel="stylesheet" href="./assets/css/list.css">

</head>

<body>
<?php
    include("../admincp/config/config.php");
?>

    <?php
        $sql_danhmuc = "select * from tbl_danhmuc limit 2";
        $query_danhmuc = mysqli_query($mysqli,$sql_danhmuc);
        include("header.php")
    ?>
    

    <section class="Khoi_section-1">
        <div class="Khoi_container">
            <div class="Khoi_inner-wrap">
                <div class="tittle">
                    <img src="assets/images/do it right.svg" alt="DO IT RIGHT">
                </div>
            </div>
        </div>
    </section>

    <section class="Khoi_section-2">
        <div class="Khoi_container">
            <div class="Khoi_inner-wrap">
                <div class="Khoi_inner-top-left">
                    <div class="Khoi_content">
                        Nike product of the year
                    </div>
                </div>

                <div class="Khoi_inner-bot-left">
                    <div class="Khoi_inner-content">
                        <div class="Khoi_content-1">NIKE AIR MAX</div>
                        <div class="Khoi_content-2">Nike introducing the new air max for everyone's comfort</div>
                        <a href="listingpage.php?quanly=danhmucsanpham" class="Khoi_content-3">
                            <div class="Khoi_button">SHOP NOW</div >
                        </a>
                    </div>
                </div>

                <div class="Khoi_inner-bot-right">
                    <div class="Khoi_pic"><img src="assets/images/rectangle 2.svg" alt="Picture-1"></div>
                    <div class="Khoi_pic"><img src="assets/images/rectangle 1.svg" alt="Picture-2"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="Khoi_section-3">
        <div class="Khoi_container">
            <div class="Khoi_inner-wrap">
                <div class="Khoi_top">
                    <div class="Khoi_top-left" id="newdrops">
                        <div class="Khoi_content">DON'T MISS OUT NEW DROPS</div>
                    </div>
                    <a href="listingpage.php?quanly=danhmucsanpham" class="Khoi_bot-right">
                        <div class="Khoi_button">SHOP NEW DROPS</div>
                    </a>
                </div>
                    <?php
                        $sql_pro = "select * from tbl_sanpham  limit 4";
                        $query_pro = mysqli_query($mysqli,$sql_pro);
                    ?>
                <div class="Khoi_product">
                    <?php
                        while($row_pro = mysqli_fetch_array($query_pro)) 
                        {
                    ?>
                    <div class="Khoi_product-item">
                            <div class="Khoi_inner-image">
                            <img src="../admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh']?>" class="Manh__product-img">
                            </div>
                            <div class="Khoi_inner-content">
                                <div class="Khoi_inner-title">
                                    <h3 class="Khoi_title">
                                        <?php echo strtoupper($row_pro['tensanpham']) ?>
                                    </h3>
                                </div>
                                <a class="Khoi_inner-price" href="product.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham'] ?>">
                                    <div class="Khoi_cost">VIEW PRODUCT - <?php echo number_format($row_pro['giasp']).'$'?></div>
                                </a>
                            </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <section class="Khoi_section-4">
        <div class="Khoi_container">
            <div class="Khoi_inner-wrap">
                <div class="Khoi_top">
                    <div class="Khoi_inner-top-left">
                        <div class="Khoi_content">CATEGRORIES</div>
                    </div>
                </div>

                <div class="Khoi_bot">
                        <?php
                            while($row_danhmuc = mysqli_fetch_array($query_danhmuc)){
                        ?>
                    <div class="Khoi_bot-wrap">
                        <div class="Khoi_inner-bot Khoi_inner-bot-1">
                            <img src="assets/images/J97.jpg" alt="">
                            <a class="Khoi_title Khoi_title-1" href="listingpage.php?quanly=danhmucsanpham&id=<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></a>
                        </div>
                    </div>
                        <?php
                        }
                        ?>
                </div>
            </div>
        </div>
    </section>

    <section class="Khoi_section-5">
        <div class="Khoi_container">
            <div class="Khoi_inner-wrap">
                <div class="Khoi_top">
                    <div class="Khoi_top-left">
                        <div class="Khoi_content">REVIEWS</div>
                    </div>
                    <div onclick="toggleReviews()" class="Khoi_bot-right">
                        <div class="Khoi_button">SEE ALL</div>
                    </div>
                </div>
                <div class="Khoi_bot">
                    <div class="Khoi_box">
                        <div class="Khoi_person">
                            <div class="Khoi_p1">
                                <div class="Khoi_cmt">
                                    <div class="Khoi_good">Good Quality</div>
                                    <div class="Khoi_write">I highly recommend shopping from kicks.</div>
                                </div>
                                <div class="Khoi_photo">
                                    <img src="assets/images/Messi.png" alt="">
                                </div>
                            </div>
                            <div class="Khoi_p2">
                                <img src="assets/images/start 5.0.svg" alt="">
                            </div>
                        </div>
                        <div class="Khoi_image">
                            <img src="assets/images/img1.svg" alt="">
                        </div>
                    </div>


                    <div class="Khoi_box">
                        <div class="Khoi_person">
                            <div class="Khoi_p1">
                                <div class="Khoi_cmt">
                                    <div class="Khoi_good">Excellent Quality</div>
                                    <div class="Khoi_write">I bought shoes for 5 million, they are very beautiful.</div>
                                </div>
                                <div class="Khoi_photo">
                                    <img src="assets/images/Jack.png" alt="">
                                </div>
                            </div>
                            <div class="Khoi_p2">
                                <img src="assets/images/start 5.0.svg" alt="">
                            </div>
                        </div>
                        <div class="Khoi_image">
                            <img src="assets/images/img2.svg" alt="">
                        </div>
                    </div>


                    <div class="Khoi_box">
                        <div class="Khoi_person">
                            <div class="Khoi_p1">
                                <div class="Khoi_cmt">
                                    <div class="Khoi_good">High-Quality</div>
                                    <div class="Khoi_write">Khôi holds a special place in my heart ❤️.</div>
                                </div>
                                <div class="Khoi_photo">
                                    <img src="assets/images/falling3.png" alt="">
                                </div>
                            </div>
                            <div class="Khoi_p2">
                                <img src="assets/images/start 5.0.svg" alt="">
                            </div>
                        </div>
                        <div class="Khoi_image">
                            <img src="assets/images/img3.svg" alt="">
                        </div>
                    </div>
<!-- ......................................................................................................................................... -->

<div class="Khoi_box Khoi_none">
                        <div class="Khoi_person">
                            <div class="Khoi_p1">
                                <div class="Khoi_cmt">
                                    <div class="Khoi_good">Premium Quality</div>
                                    <div class="Khoi_write">My heart belongs to Khôi ❤️.</div>
                                </div>
                                <div class="Khoi_photo">
                                    <img src="assets/images/falling.png" alt="">
                                </div>
                            </div>
                            <div class="Khoi_p2">
                                <img src="assets/images/start 5.0.svg" alt="">
                            </div>
                        </div>
                        <div class="Khoi_image">
                            <img src="assets/images/shoe2.jpg" alt="">
                        </div>
                    </div>


                    <div class="Khoi_box Khoi_none">
                        <div class="Khoi_person">
                            <div class="Khoi_p1">
                                <div class="Khoi_cmt">
                                    <div class="Khoi_good">Top-Notch Quality</div>
                                    <div class="Khoi_write">I'm completely smitten by Khôi ❤️.</div>
                                </div>
                                <div class="Khoi_photo">
                                    <img src="assets/images/falling2.png" alt="">
                                </div>
                            </div>
                            <div class="Khoi_p2">
                                <img src="assets/images/start 5.0.svg" alt="">
                            </div>
                        </div>
                        <div class="Khoi_image">
                            <img src="assets/images/shoe.jpg" alt="">
                        </div>
                    </div>


                    <div class="Khoi_box Khoi_none">
                        <div class="Khoi_person">
                            <div class="Khoi_p1">
                                <div class="Khoi_cmt">
                                    <div class="Khoi_good">Superior Quality</div>
                                    <div class="Khoi_write">Khôi means the world to me ❤️.</div>
                                </div>
                                <div class="Khoi_photo">
                                    <img src="assets/images/falling1.png" alt="">
                                </div>
                            </div>
                            <div class="Khoi_p2">
                                <img src="assets/images/start 5.0.svg" alt="">
                            </div>
                        </div>
                        <div class="Khoi_image">
                            <img src="assets/images/shoe1.jpg" alt="">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php
        include('footer.php')
    
    ?>


<script>
    function toggleReviews() {
    // Lấy tất cả các box có class "Khoi_none"
    const hiddenBoxes = document.querySelectorAll('.Khoi_none');
    
    // Duyệt qua các box và thay đổi display
    hiddenBoxes.forEach(function(box) {
        if (box.style.display === "none") {
            box.style.display = "block"; // Hiển thị các box ẩn
        } else {
            box.style.display = "none"; // Ẩn lại các box khi đã hiển thị
        }
    });
}
</script>
</body>

</html>