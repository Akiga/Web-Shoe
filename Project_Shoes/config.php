<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    
    
    $vnp_TmnCode = "KCUBW93F"; //Website ID in VNPAY System
    $vnp_HashSecret = "40K89E85LJXP01UGGQSHOYOLRU5O26J3"; //Secret key
    $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    $vnp_Returnurl = "http://localhost/Webshoe/Project_Shoes/history.php";
    $vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";
    //Config input format
    //Expire
    $startTime = date("YmdHis");
    $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));


?>