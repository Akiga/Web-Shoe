<header class="Khoi_header">
        <div class="Khoi_container">
            <div class="Khoi_inner-wrap">
                <!-- Left -->
                <nav class="Khoi_inner-menu">
                    <ul>
                        <li>
                            <a class="Khoi_hover" href="#newdrops">New Drops 🔥</a>
                        </li>
                    </ul>
                </nav>


                <!-- Center -->

                <div class="Khoi_inner-logo">
                    <a href="index.php">
                        <img src="assets/images/logo.svg" alt="KICKS">
                    </a>
                </div>


                <!-- Right -->
                <div class="Khoi_inner-right">
                <ul class="Khoi_header-menu">
                    <!-- Menu người dùng -->
                    <li class="user-menu">
                            <?php
                            if (isset($_SESSION['email'])) {
                                echo '<a class="logo_login">';
                                $sql_user = "SELECT * FROM user WHERE email = '" . $_SESSION['email'] . "'";
                                $query_user = mysqli_query($mysqli, $sql_user);
                                while ($row_user = mysqli_fetch_array($query_user)) {
                                    echo '<i class="fa-solid fa-user-injured"></i>';
                                    echo '<span>' . substr($row_user['last_name'], 0, 10) . '</span>';
                                }
                                echo '</a>';
                            } else {
                                echo '<a href="login.php" class="logo_login">';
                                echo '<i class="fa-solid fa-user-injured"></i>';
                                echo '</a>';
                            }
                            ?>
                        <!-- Menu thả xuống khi hover -->
                        <ul class="user-dropdown">
                            <li>
                            <?php
                            if (isset($_SESSION['email'])) {
                                echo '<a href="history.php" class="logo_login">';
                                echo '<i class="fa-solid fa-cart-shopping"></i>';
                                echo '<span>Customer Order</span>';
                                echo '</a>';
                            }
                            ?>
                            </li>

                            <li>
                            <?php
                            if (isset($_SESSION['email'])) {
                                echo '<a href="Cart.php" class="Khoi_hover">';
                                echo '<i class="fa-solid fa-bag-shopping"></i>';
                                echo '<span>Shopping Cart</span>';
                                echo '</a>';
                            }
                            ?>
                            </li>

                            <li>
                            <?php
                            if (isset($_SESSION['email'])) {
                                echo '<a href="logout.php" class="Khoi_hover">';
                                echo '<i class="fa-solid fa-right-from-bracket"></i>';
                                echo '<span>Log Out</span>';
                                echo '</a>';
                            }
                            ?>
                            </li>
                        </ul>
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </header>

    <style>
        .Khoi_header-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        /* Menu đa cấp */
        
        .Khoi_header-menu li {
            position: relative;
            padding: 0 10px;
        }
        
        .Khoi_header-menu li ul {
            position: absolute;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            top: 0;
            left: 100%;
            list-style: none;
            margin: 0;
            padding: 10px 0;
            width: 150px;
            display: none;
        }
        
        .Khoi_header-menu>li>ul {
            top: 100%;
            left: 0;
        }
        
        .Khoi_header-menu li:hover>ul {
            display: inline-flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Chỉnh liên kết */
        .Khoi_header-menu a {
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: #232321;
            font-size: 16px;
            font-weight: 600;
            padding: 5px 10px; 
            border-radius: 10px;
            transition: all 0.3s ease; 
        }

        /* Hover đẹp mắt */
        .Khoi_header-menu a:hover {
            background-color: #f0f0f0; 
            color: #007bff; 
        }

        /* Chỉnh icon */
        .Khoi_header-menu a i {
            font-size: 22.7px; /* Kích thước icon */
            color: #232321; /* Màu icon */
            transition: all 0.3s ease; /* Hiệu ứng khi hover */
        }

        /* Hover icon */
        .Khoi_header-menu a:hover i {
            color: #007bff; /* Màu icon khi hover */
        }
        /* Hết Menu đa cấp */
    </style>

