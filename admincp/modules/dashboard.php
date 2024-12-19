<!-- dashboard.php -->
<?php
    $sql = 'select count(*) AS total_products from tbl_sanpham';
    $query = mysqli_query($mysqli, $sql);

    $row = mysqli_fetch_assoc($query);
    $total_products = $row['total_products'];


    $sql_cate = 'select count(*) AS total_cate from tbl_danhmuc';
    $query_cate = mysqli_query($mysqli, $sql_cate);

    $row_cate = mysqli_fetch_assoc($query_cate);
    $total_cate = $row_cate['total_cate'];


    $sql_cart = 'select count(*) AS total_cart from tbl_cart';
    $query_cart = mysqli_query($mysqli, $sql_cart);

    $row_cart = mysqli_fetch_assoc($query_cart);
    $total_cart = $row_cart['total_cart'];


    // Xây dựng biểu đồ
    $sql_orders_per_month = "
        SELECT MONTH(ngay_tao) AS month, COUNT(*) AS total_orders 
        FROM tbl_cart 
        GROUP BY MONTH(ngay_tao)
        ORDER BY MONTH(ngay_tao)
    ";
    $query_orders_per_month = mysqli_query($mysqli, $sql_orders_per_month);

    $orders_data = [];
    $months = [];

    // Lưu dữ liệu vào mảng PHP để sử dụng trong biểu đồ
    while ($row = mysqli_fetch_assoc($query_orders_per_month)) {
        $months[] = "Tháng " . $row['month'];
        $orders_data[] = $row['total_orders'];
    }

    // Chuyển mảng thành chuỗi để dùng trong JavaScript
    $months_js = json_encode($months);
    $orders_data_js = json_encode($orders_data);
?>

<div class="dashboard">
    <h1>Admin Dashboard</h1>

    <!-- Statistics Section -->
    <div class="stats">
        <div class="stat-box">
            <h2><?php echo $total_cate ?></h2>
            <p>Categories</p>
        </div>
        <div class="stat-box">
            <h2><?php echo $total_products ?></h2>
            <p>Total Products</p>
        </div>
        <div class="stat-box">
            <h2><?php echo $total_cart ?></h2>
            <p>Total Orders</p>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="chart-container" style="width: 50%; margin: 0 auto;">
        <canvas id="dashboardChart"></canvas>
    </div>

    <!-- Quick Links Section -->
    <div class="quick-links">
        <h3>Quick Links</h3>
        <ul>
            <li><a href="index.php?action=quanlydanhmucsp&query=them">Manage Product Categories</a></li>
            <li><a href="index.php?action=quanlysp&query=them">Manage Products</a></li>
            <li><a href="index.php?action=quanlydonhang&query=lietke">Manage Orders</a></li>
        </ul>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Chuyển đổi dữ liệu PHP sang JSON để sử dụng trong JavaScript
    const labels = <?php echo $months_js; ?>; // Các tháng trong năm
    const ordersData = <?php echo $orders_data_js; ?>; // Số lượng đơn hàng theo tháng

    const data = {
        labels: labels, 
        datasets: [{
            label: 'Orders Over Time',
            data: ordersData, 
            fill: false,
            borderColor: 'rgba(54, 162, 235, 1)',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderWidth: 2,
            tension: 1
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Orders Over Time'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Orders'
                    }
                }
            }
        },
    };

    // Render Chart
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        new Chart(ctx, config);
    });
</script>
