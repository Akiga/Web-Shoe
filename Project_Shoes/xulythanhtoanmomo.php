<?php
        session_start(); // Bắt đầu phiên làm việc của session
        include("../admincp/config/config.php");
        $id_khachhang = $_SESSION['id_khachhang'];
        $code_order = rand(0,9999);
        $shippingAddress = $_POST['shippingAddressInfo'];
        $payment = $_POST['payUrl'];
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
        // header("Location: history.php");


// <!-- Thanh toan MoMo-->
  function execPostRequest($url, $data)
  {
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'Content-Length: ' . strlen($data))
          );
      curl_setopt($ch, CURLOPT_TIMEOUT, 5);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
      //execute post
      $result = curl_exec($ch);
      //close connection
      curl_close($ch);
      return $result;
  }

  $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

  $partnerCode = 'MOMO4MUD20240115_TEST';
  $accessKey = 'Ekj9og2VnRfOuIys';
  $secretKey = 'PseUbm2s8QVJEbexsh8H3Jz2qa9tDqoa';
/*
  $partnerCode = 'MOMOBKUN20180529';
  $accessKey = 'klm05TvNBzhg7h7j';
  $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
*/
  $orderInfo = "Test Thanh toán qua MoMo";
  $amount = $_SESSION['totalPrice']; // Giá trị totalPrice
  $orderId = time() . ""; //hoặc random hay tuần tự
  $redirectUrl = "https://google.com";
  $ipnUrl = "https://google.com";
  $extraData = "";
  
  
      
      $requestId = time() . "";
      $requestType = "payWithATM";
      //$extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
      
      //before sign HMAC SHA256 signature
      $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
      $signature = hash_hmac("sha256", $rawHash, $secretKey);
      $data = array('partnerCode' => $partnerCode,
          'partnerName' => "Test",
          "storeId" => "MomoTestStore",
          'requestId' => $requestId,
          'amount' => $amount,
          'orderId' => $orderId,
          'orderInfo' => $orderInfo,
          'redirectUrl' => $redirectUrl,
          'ipnUrl' => $ipnUrl,
          'lang' => 'vi',
          'extraData' => $extraData,
          'requestType' => $requestType,
          'signature' => $signature);
      $result = execPostRequest($endpoint, json_encode($data));
      $jsonResult = json_decode($result, true);  // decode json
      
      //Just a example, please check more in there
      
      if (isset($jsonResult['payUrl'])) {
        header('Location: ' . $jsonResult['payUrl']);
        exit();
    } else {
        echo "Lỗi: Không thể tạo yêu cầu thanh toán. Vui lòng thử lại.";
    }

  //} // if
 ?>