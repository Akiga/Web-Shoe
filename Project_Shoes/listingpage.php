<?php
session_start();
include("../admincp/config/config.php");
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KICKS</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="./assets/css/list.css">
    <link rel="stylesheet" href="./assets/css/Khoi_header.css">
    <link rel="stylesheet" href="./assets/css/Khoi_footer.css">
</head>

<body>
    <?php
    // Lấy danh sách danh mục
    $sql_danhmuc = "SELECT * FROM tbl_danhmuc";
    $query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
    include("header.php");

    // Số sản phẩm mỗi trang
    $products_per_page = 8;
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($current_page - 1) * $products_per_page;

    // Xử lý tìm kiếm và phân trang
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search_term = mysqli_real_escape_string($mysqli, $_GET['search']);
        $sql_pro = "SELECT * FROM tbl_sanpham WHERE tensanpham LIKE '%$search_term%' LIMIT $products_per_page OFFSET $offset";
        $sql_total_products = "SELECT COUNT(*) as total FROM tbl_sanpham WHERE tensanpham LIKE '%$search_term%'";
        $row_title = ['tendanhmuc' => 'Search results'];
    } elseif (isset($_GET['id'])) {
        $sql_pro = "SELECT * FROM tbl_sanpham WHERE id_danhmuc = '$_GET[id]' LIMIT $products_per_page OFFSET $offset";
        $sql_total_products = "SELECT COUNT(*) as total FROM tbl_sanpham WHERE id_danhmuc = '$_GET[id]'";
        $sql_cate = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc = '$_GET[id]' LIMIT 1";
        $query_cate = mysqli_query($mysqli, $sql_cate);
        $row_title = mysqli_fetch_array($query_cate);
    } else {
        $sql_pro = "SELECT * FROM tbl_sanpham LIMIT $products_per_page OFFSET $offset";
        $sql_total_products = "SELECT COUNT(*) as total FROM tbl_sanpham";
        $row_title = ['tendanhmuc' => 'All Products'];
    }

    $query_pro = mysqli_query($mysqli, $sql_pro);
    $result_total_products = mysqli_query($mysqli, $sql_total_products);
    $total_products_row = mysqli_fetch_array($result_total_products);
    $total_products = $total_products_row['total'];
    $total_pages = ceil($total_products / $products_per_page);
    ?>

    <div class="slideshow-container">
        <div class="slide fade">
        <img src="assets/images/image14.png" alt="Ảnh 1">
        </div>
        <div class="slide fade">
        <img src="assets/images/image15.png" alt="Ảnh 2">
        </div>
    </div>

    <!-- Section Header -->
    <div class="Manh__section-header">
        <h2 class="Manh__section-title">Life Style Shoes</h2>
    </div>

    <!-- Main Content Section -->
    <div class="Manh__main-content">
        <!-- Filter Section -->
        <div class="Manh__filter-container">
            <h2 class="Manh__filter-title">DANH MỤC</h2>
            <div class="Manh__filter-section">
                <div class="Manh__filter-options">
                    <a href="listingpage.php?page=1">
                        <div class="Manh__filter-option">TẤT CẢ</div>
                    </a>
                    <?php while ($row_danhmuc = mysqli_fetch_array($query_danhmuc)) { ?>
                        <a href="listingpage.php?id=<?php echo $row_danhmuc['id_danhmuc']; ?>&page=1">
                            <div class="Manh__filter-option"><?php echo $row_danhmuc['tendanhmuc']; ?></div>
                        </a>
                    <?php } ?>
                </div>
            </div>

            <!-- Search Section -->
            <div class="Manh__search-container">
                <form action="listingpage.php" method="GET" class="Manh__search-form">
                    <input type="text" name="search" placeholder="TÌM KIẾM" class="Manh__search-input" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="Manh__search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Product Grid Section -->
        <div class="Manh__container">
            <h3 class="Manh__category-title">Danh mục sản phẩm: <?php echo $row_title['tendanhmuc']; ?></h3>
            <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
                <h4>KẾT QUẢ TÌM KIẾM: "<?php echo htmlspecialchars($_GET['search']); ?>"</h4>
            <?php endif; ?>

            <div class="Manh__product-grid">
                <?php while ($row_pro = mysqli_fetch_array($query_pro)) { ?>
                    <div class="Manh__product-card">
                        <img src="../admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh']; ?>" class="Manh__product-img">
                        <h3 class="Manh__product-title"><?php echo strtoupper($row_pro['tensanpham']); ?></h3>
                        <div class="Manh__price-bold"><?php echo number_format($row_pro['giasp']) . '₫'; ?></div>
                        <a class="Manh__view-product" href="product.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham']; ?>">
                            XEM SẢN PHẨM - <?php echo number_format($row_pro['giasp']) . '₫'; ?>
                        </a>
                    </div>
                <?php } ?>
            </div>

            <!-- Pagination -->
            <div class="Manh__pagination">
                <?php if ($current_page > 1): ?>
                    <a href="?<?php echo isset($_GET['id']) ? "id=" . $_GET['id'] . "&" : ""; ?>page=<?php echo $current_page - 1; ?>" class="Manh__pagination-btn">Prev</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?<?php echo isset($_GET['id']) ? "id=" . $_GET['id'] . "&" : ""; ?>page=<?php echo $i; ?>" class="Manh__pagination-btn <?php echo $i == $current_page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($current_page < $total_pages): ?>
                    <a href="?<?php echo isset($_GET['id']) ? "id=" . $_GET['id'] . "&" : ""; ?>page=<?php echo $current_page + 1; ?>" class="Manh__pagination-btn">Next</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>


</body>
<script>
    // script.js
let slideIndex = 0;

function showSlides() {
  let slides = document.querySelectorAll(".slide");
  
  // Ẩn tất cả ảnh
  slides.forEach(slide => slide.style.display = "none");

  slideIndex++;
  
  // Lặp lại từ đầu nếu là ảnh cuối cùng
  if (slideIndex > slides.length) slideIndex = 1;
  
  slides[slideIndex - 1].style.display = "block";

  // Chuyển ảnh mỗi 3 giây
  setTimeout(showSlides, 3000);
}

// Bắt đầu slideshow
showSlides();

</script>
</html>