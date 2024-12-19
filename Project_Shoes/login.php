
<?php
    include("../admincp/config/config.php");

 session_start();

 if ($mysqli->connect_error) {
     die("Connection failed: " . $mysqli->connect_error);
}
 if (isset($_POST["login"])) {
{
    $email = $_POST['email'];

    $password = md5($_POST['password']);
    $sql = "SELECT * FROM user WHERE email = '$email' and  password = '$password' limit 1 ";
    $row=mysqli_query($mysqli,$sql);
    $count = mysqli_num_rows($row);
    if($count >0){
        $row_data = mysqli_fetch_array($row);
        $_SESSION['email'] = $email;
        $_SESSION['id_khachhang'] = $row_data['userid'];
         echo'<script>alert("  Ban đã đăng nhập thành công");</script>';
       header("Location: index.php");
 
     }else{
         echo'<script>alert("  Tai khoan hoac Mat khau khong dung, vui long nhap lai.");</script>';
    }
    }
}
?>
<!DOCTYPE HTL>
<html lang="en">
<head>
    <title>Kicks Login</title>

    <!-- Link font chữ chèn vào html -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <!-- Link Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="./assets/css/Nhat_login.css">
    <link rel="stylesheet" href="./assets/css/Khoi_header.css">
    <link rel="stylesheet" href="./assets/css/Khoi_footer.css">
</head>
<body>
    <header class="Khoi_header">
        <div class="Khoi_container">
            <div class="Khoi_inner-wrap">
                

                <!-- Center -->

                <div class="Khoi_inner-logo">
                    <a href="index.php">
                        <img src="assets/images/logo.svg" alt="KICKS">
                    </a>
                </div>
                </div>
            </div>
        </div>
    </header>

<!-- <main> -->
    <main class="Nhat_contain-lFrame-rFrame">

        <form class="Nhat_lFrame"  method="post">

            <label for="login" class="Nhat_title">
                <div class="Nhat_title1">Login</div>
            </label>

            <div id="Nhat_input-field-Email">
                <div id="Nhat_Email">
                    <input type="email" name="email" id="email" placeholder="Email">
                    <div id="Nhat_helper-text-Email"></div>
                </div>
            </div>
            <div id="Nhat_input-field-Password">
                <div id="Nhat_Password">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <div id="Nhat_helper-text-Password"></div>
                </div>
            </div>

            <a href="">Quên mật khẩu</a>


            <button type="submit" name="login" class="pointer Nhat_button-Login">
                <div>
                    <span>EMAIL LOGIN</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </button>

            <div class="Nhat_Agreement">
                <label>
                    By clicking 'Log In' you agree to our website 
                    <a href="#">KicksClub Terms & Conditions</a>, <a href="#">Kicks Privacy Notice</a> and <a href="#">Terms & Conditions</a>.
                </label>
            </div>
        </form>
            

        <div class="Nhat_rFrame">
            <div class="Nhat_rFrame-content">
                <div class="Nhat_rFrame-content-h">
                    <div class="Nhat_rFrame-content-h-">Join Kicks Club Get Rewarded Today.</div>
                </div>

                <p class="Nhat_rFrame-content1">As kicks club member you get rewarded with what you love for doing what you love. Sign up today and receive immediate access to these Level 1 benefits:</p>
                
                <div class="Nhat_rFrame-content2">
                    <ul class="Nhat_rFrame-content2-">
                        <li>Free shipping</li>
                        <li>A 15% off voucher for your next purchase</li>
                        <li>Access to Members Only products and sales</li>
                        <li>Access to adidas Running and Training apps</li>
                        <li>Special offers and promotions</li>
                    </ul>
                </div>
                    
                <p class="Nhat_rFrame-content3">Join now to start earning points, reach new levels and unlock more rewards and benefits from adiClub.</p>
            </div>
            
            <a href="register.php" class="pointer Nhat_rFrame-button-Join" style="text-decoration: none;">
                <div>
                    <span>Register</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        </div>
    </main>
<!-- </main> -->

    <footer class="Khoi_footer">
        <div class="Khoi_container">
            <div class="Khoi_inner-wrap">
                <div class="Khoi_top">
                    <div style="position: absolute; left: 72px; top: 64px;" class="Khoi_top-left" class="Khoi_top-left">

                        <div class="Khoi_content">
                            <div class="Khoi_content-1">JOIN OUR KICKSPLUS CLUB & GET 15% OFF</div>
                            <div class="Khoi_content-2">Sign up for free! Join the community.</div>
                        </div>

                        <div class="Khoi_form">
                            <!-- Button -->
                            <a href="register.php" class="Khoi_button">
                                REGISTER
                            </a>
                        </div>
                    </div>

                    <div class="Khoi_top-right">
                        <img src="./assets/images/logo 2.svg" alt="KICKS">
                    </div>
                </div>

                <div class="Khoi_bot">
                    <div class="Khoi_box-1">
                        <div class="Khoi_content-1">About us</div>
                        <div class="Khoi_content-2">We are the biggest hyperstore in the universe. We got you all cover
                            with our exclusive collections and latest drops.</div>
                    </div>


                    <div class="Khoi_box-2">
                        <div class="Khoi_left">
                            <div class="Khoi_content-1">Categories</div>
                            <div class="Khoi_content-2">
                                <a href="#" class="Khoi_block">Runners</a>
                                <a href="#" class="Khoi_block">Sneakers</a>
                                <a href="#" class="Khoi_block">Basketball</a>
                                <a href="#" class="Khoi_block">Outdoor</a>
                                <a href="#" class="Khoi_block">Golf</a>
                                <a href="#" class="Khoi_block">Hiking</a>
                            </div>
                        </div>

                        <div class="Khoi_center">
                            <div class="Khoi_content-1">Company</div>
                            <div class="Khoi_content-2">
                                <a href="#" class="Khoi_block">About</a>
                                <a href="#" class="Khoi_block">Contact</a>
                                <a href="#" class="Khoi_block">Blogs</a>
                            </div>
                        </div>

                        <div class="Khoi_right">
                            <div class="Khoi_content-1">Follow us</div>
                            <div class="Khoi_social">
                                <a href="https://www.facebook.com/profile.php?id=100020776870191" class="Khoi_net"> <i
                                        class="fa-brands fa-facebook"></i></a>
                                <a href="https://www.instagram.com/skuukzky?igsh=MXUwZGp6YXBocmRsdg=="
                                    class="Khoi_net"><i class="fa-brands fa-instagram"></i></a>
                                <a href="https://gaigu31.tv/gai-goi" class="Khoi_net"><i
                                        class="fa-brands fa-x-twitter"></i></a>
                                <a href="https://vt.tiktok.com/ZSjM46ch5/" class="Khoi_net"><i
                                        class="fa-brands fa-tiktok"></i></a>
                            </div>
                        </div>
                    </div>


                    <div class="Khoi_box-3">
                        <img src="./assets/images/logo 3.svg" alt="Logo">
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>