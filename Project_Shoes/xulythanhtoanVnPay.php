<?php
session_start();
include("../admincp/config/config.php");
        $id_khachhang = $_SESSION['id_khachhang'];
        $code_order = rand(0,9999);
        $shippingAddress = $_POST['shippingAddressInfo'];
        $payment = $_POST['redirect'];
        $insert_cart = "insert into tbl_cart(userid, code_cart, cart_status, diachi, thanhtoan) value('".$id_khachhang."','".$code_order."', 1, '".$shippingAddress."', '".$payment."')";
        $cart_query = mysqli_query($mysqli, $insert_cart);
        if($cart_query){
            //Thêm giỏ hàng chi tiết
            foreach($_SESSION['cart' ] as $key => $value){
                $id_sanpham = $value['id'];
                $soluong = $value['soluong'];
                $size = $value['size'];
                $insert_order_details = "insert into tbl_cart_details(id_sanpham, code_cart, soluongmua, sizeOwn) value('".$id_sanpham."','".$code_order."', '".$soluong."','".$size."')";
                mysqli_query($mysqli, $insert_order_details);
            }
        }
        unset($_SESSION["cart"]);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

/**
 * Description of vnpay_ajax
 *
 * @author xonv
 */
require_once("./config.php");

$vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
$vnp_OrderInfo = 'Test thanh toan';
$vnp_OrderType = 'billpayment';
$vnp_Amount = $_SESSION['totalPrice'] *100;
$vnp_Locale = 'vn';
$vnp_BankCode = "NCB";
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version
$vnp_ExpireDate = $expire;  //Thời hạn thanh toán
$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
    "vnp_ExpireDate"=>$vnp_ExpireDate,

);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}


//var_dump($inputData);
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}
$returnData = array('code' => '00'
    , 'message' => 'success'
    , 'data' => $vnp_Url);
    if (isset($_POST['redirect'])) {
        header('Location: ' . $vnp_Url);
        die();
    } else {
        echo json_encode($returnData);
    }
?>