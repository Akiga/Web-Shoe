<?php
    include("../admincp/config/config.php");

if(isset($_POST["dangky"])) {
    if(!isset($_POST['agreements']) || $_POST['agreements'] == 'off'){
        // Lưu thông báo vào session
        session_start();
        $_SESSION['error'] = "Bạn chưa đồng ý với các điều khoản.";
        header("Location: register.php");
        exit();
    } 
    else { // Người dùng đã check vào checkbox
        if ($_POST['first-name'] != "" && $_POST['last-name'] != "" && $_POST['gender'] != "" && $_POST['email'] != "" && $_POST['password'] != "") {
            $firstname = $_POST['first-name'];
            $lastname = $_POST['last-name'];
            $gender = $_POST['gender'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);

            // Kiểm tra xem email đã được đăng ký chưa
            $check_email = mysqli_query($mysqli, "SELECT * FROM user WHERE email='$email'");
            if (mysqli_num_rows($check_email) > 0) {
                // Lưu thông báo vào session
                session_start();
                $_SESSION['error'] = "Email này đã được đăng ký! Vui lòng dùng email khác.";
                header("Location: register.php");
                exit();
            } 
            else { // Thực hiện đăng ký nếu email chưa được đăng ký
                $sql_dangky = mysqli_query($mysqli,"INSERT INTO user(first_name, last_name, gender, email, password) VALUES ('$firstname','$lastname','$gender','$email','$password')");
                if ($sql_dangky) {
                    // Lưu thông báo thành công vào session
                    session_start();
                    $_SESSION['success'] = "Bạn đã đăng ký thành công!";
                    header("Location: register.php");
                    exit();
                }
            }
        } 
        else { 
            // Lưu thông báo lỗi vào session
            session_start();
            $_SESSION['error'] = "Bạn chưa nhập đầy đủ thông tin! Vui lòng đăng ký lại.";
            header("Location: register.php");
            exit(); 
        }
    }
}

// Kiểm tra và hiển thị thông báo nếu có
session_start();
if (isset($_SESSION['error'])) {
    echo '<script>alert("' . $_SESSION['error'] . '");</script>';
    unset($_SESSION['error']); // Xóa thông báo sau khi hiển thị
}

if (isset($_SESSION['success'])) {
    echo '<script>alert("' . $_SESSION['success'] . '");
        window.location.href = "login.php"; // Chuyển hướng đến trang login
        </script>';
    unset($_SESSION['success']); // Xóa thông báo sau khi hiển thị
}
?>


<html lang="en">
<head>
    <title>Kicks Registration</title>

    <!-- Link font chữ chèn vào html -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">

    <!-- Link Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/css/register.css">
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
        <form class="Nhat_lFrame" id="form-dang-ky" action="" method="post">
            <div class="Nhat_contain-Register-SignUpWith">
                <div class="Nhat_register">Register</div>
            </div>

            <div class="Nhat_contain-yourName">
                <label for="first-name" class="Nhat_yourName-label">Your Name</label>
                <div id="Nhat_input-field-FN">
                    <div id="Nhat_firstName">
                        <input type="text" name="first-name" placeholder="First Name">
                        <div id="Nhat_helper-text-FN"></div>
                    </div>
                </div>
                <div id="Nhat_input-field-LN">
                    <div id="Nhat_lastName">
                        <input type="text" name="last-name" placeholder="Last Name">
                        <div id="Nhat_helper-text-LN"></div>
                    </div>
                </div>
            </div>
            
            <div class="Nhat_gender">
                <label class="Nhat_gender-label">Gender</label>
                <div>
                    <span class="Nhat_gender-div-span1">
                        <input type="radio" name="gender" id="male" value="male" class="pointer"> 
                        <label class="Nhat_each-gender-label"> Male</label>
                    </span>
                    <span class="Nhat_gender-div-span2">
                        <input type="radio" name="gender" id="female" value="female" class="pointer">
                        <label class="Nhat_each-gender-label">Female</label>
                    </span>
                    <span class="Nhat_gender-div-span3">
                        <input type="radio" name="gender" id="other" value="other" class="pointer">
                        <label class="Nhat_each-gender-label"> Other</label>
                    </span>
                </div>
            </div>
            
            <div class="Nhat_contain-LoginDetail">
                <label for="email" class="Nhat_LoginDetail-label">Login Details</label>
                <div id="Nhat_input-field-Email">
                    <div id="Nhat_Email">
                        <input type="email" name="email" id="email" placeholder="Email">
                        <div id="Nhat_helper-text-Email"></div>
                    </div>
                </div>
                <div id="Nhat_input-field-Password">
                    <div id="Nhat_Password">
                        <input type="password" name="password" id="password" placeholder="Password">
                        <div id="Nhat_helper-text-Password">Minimum 8 characters with at least one uppercase, one lowercase, one special character and a number.</div>
                    </div>
                </div>
            </div>

            <div class="Nhat_checkbox1">
                <input type="checkbox" name="agreements" class="pointer">
                <label>
                    By clicking 'Log In' you agree to our website 
                    <a href="#">KicksClub Terms & Conditions</a>, <a href="#">Kicks Privacy Notice</a> and <a href="#">Terms & Conditions</a>.
                </label>
            </div>

            <button type="submit" name="dangky" class="pointer Nhat_button-Register">
                <div>
                    <span>REGISTER</span>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </button>
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
            
            <a href="login.php" class="pointer Nhat_rFrame-button-Join" style="text-decoration: none;">
                <div>
                    <span>LOGIN</span>
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
                    <div style="position: absolute; left: 72px; top: 64px;" class="Khoi_top-left">
                        <div class="Khoi_content">
                            <div class="Khoi_content-1">JOIN OUR KICKSPLUS CLUB & GET 15% OFF</div>
                            <div class="Khoi_content-2">Sign up for free! Join the community.</div>
                        </div>

                        <div class="Khoi_form">
                            <!-- Button -->
                            <a href="login.php" class="Khoi_button">
                                LOGIN
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