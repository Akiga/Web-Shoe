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
    <style>
        .Manh__pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .Manh__pagination-btn {
            margin: 0 5px;
            padding: 8px 12px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #333;
            border-radius: 4px;
        }

        .Manh__pagination-btn.active {
            background-color: #333;
            color: #fff;
            font-weight: bold;
        }

        .Manh__pagination-btn:hover {
            background-color: #555;
            color: #fff;
        }

        .Manh__search-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .Manh__search-form {
            display: flex;
            align-items: center;
            width: 100%;
            gap: 10px;
        }

        .Manh__search-input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 10px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .Manh__search-input:focus {
            border-color: #333;
        }

        .Manh__search-button {
            padding: 10px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .Manh__search-button:hover {
            background-color: #555;
        }

        .Manh__search-button i {
            font-size: 18px;
        }

        .Manh__search-input::placeholder {
            color: #555;
        }

        /* Lưới sản phẩm */
.Manh__product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
    padding: 0 15px;
}

/* Thẻ sản phẩm */
.Manh__product-card {
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

/* Hiệu ứng hover cho sản phẩm */
.Manh__product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Thẻ tag "New" */
.Manh__product-tag {
    position: absolute;
    top: 15px;
    left: 15px;
    background-color: #ff6600;
    color: white;
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
}

/* Hình ảnh sản phẩm */
.Manh__product-img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease-in-out;
}

/* Hiệu ứng hover cho hình ảnh */
.Manh__product-card:hover .Manh__product-img {
    transform: scale(1.05);
}

/* Tiêu đề sản phẩm */
.Manh__product-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 10px;
    text-transform: uppercase;
    color: #333;
    text-align: center;
}

/* Giá sản phẩm */
.Manh__price-bold {
    font-size: 1.2rem;
    font-weight: bold;
    color: #ff6600;
    text-align: center;
    margin: 10px;
}

/* Nút "VIEW PRODUCT" */
.Manh__view-product {
    display: block;
    background-color: #ff6600;
    color: white;
    text-align: center;
    padding: 12px;
    text-decoration: none;
    font-weight: 600;
    border-radius: 5px;
    margin-bottom: 15px;
    transition: background-color 0.3s ease-in-out;
}

/* Hiệu ứng hover cho nút "VIEW PRODUCT" */
.Manh__view-product:hover {
    background-color: #e65c00;
}

.slideshow-container {
  position: relative;
  margin: auto;
  overflow: hidden;
}

.slide {
  display: none;
  width: 100%;
}

.slideshow-container img {
    width: 100%;
    border-radius: 10px;
    height: 500px;
}



    </style>

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
            <h2 class="Manh__filter-title">Category</h2>
            <div class="Manh__filter-section">
                <div class="Manh__filter-options">
                    <a href="listingpage.php?page=1">
                        <div class="Manh__filter-option">All Products</div>
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
                    <input type="text" name="search" placeholder="Search products" class="Manh__search-input" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="Manh__search-button">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Product Grid Section -->
        <div class="Manh__container">
            <h3 class="Manh__category-title">Product Categories: <?php echo $row_title['tendanhmuc']; ?></h3>
            <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
                <h4>Search results for: "<?php echo htmlspecialchars($_GET['search']); ?>"</h4>
            <?php endif; ?>

            <div class="Manh__product-grid">
                <?php while ($row_pro = mysqli_fetch_array($query_pro)) { ?>
                    <div class="Manh__product-card">
                        <div class="Manh__product-tag">New</div>
                        <img src="../admincp/modules/quanlysp/uploads/<?php echo $row_pro['hinhanh']; ?>" class="Manh__product-img">
                        <h3 class="Manh__product-title"><?php echo strtoupper($row_pro['tensanpham']); ?></h3>
                        <div class="Manh__price-bold"><?php echo number_format($row_pro['giasp']) . '$'; ?></div>
                        <a class="Manh__view-product" href="product.php?quanly=sanpham&id=<?php echo $row_pro['id_sanpham']; ?>">
                            VIEW PRODUCT - <?php echo number_format($row_pro['giasp']) . '$'; ?>
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

    <style>
        .Manh__filter-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            margin: 0 12px 20px;
        }

        .Manh__filter-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
            font-family: 'Be Vietnam Pro', sans-serif;
        }

        .Manh__filter-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .Manh__filter-option {
            padding: 10px 15px;
            font-size: 16px;
            font-family: 'Be Vietnam Pro', sans-serif;
            color: #555;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            background-color: white;
        }

        .Manh__filter-option:hover {
            background-color: #333;
            color: white;
            border-color: #333;
        }

        .Manh__filter-option a {
            text-decoration: none;
            color: inherit;
        }

        /* Life Style Shoes */
        .Manh__section-title {
            font-size: 28px;
            font-weight: bold;
            text-align: center;
            color: #333;
            margin-top: 20px;
            font-family: 'Be Vietnam Pro', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Danh mục sản phẩm */
        .Manh__category-title {
            font-size: 22px;
            font-weight: 500;
            color: #555;
            margin-bottom: 20px;
            font-family: 'Be Vietnam Pro', sans-serif;
            padding-left: 10px;
            border-left: 4px solid #333;
        }
    </style>
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