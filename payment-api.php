<?php
//session_start();
include 'connection.php';
include("functions.php");

$consumer_key = 'AIXvNPzpT16hn8VWvA07vJNtmsAdrhD6';
$consumer_secret = 'CKNF0mWAUAOkcOWQ';
$Business_Code = '6349648';
$partyB = '8417702';
$Passkey = 'b569361cdfc585af16d2cdb19ee3ab30c8081f2804eff3aa460cf7d2f91d87a3';
$Type_of_Transaction = 'CustomerBuyGoodsOnline';
$Token_URL = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$phone_number = $_POST['phone_number'];
$OnlinePayment = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$total_amount = $_POST['amount'];
// $CallBackURL = 'https://us-central1-rocket-f1c0e.cloudfunctions.net/rocket/rocket'; 
$CallBackURL = 'https://350e-41-220-235-223.ngrok-free.app/RocketJSGame/callback.php'; // ngrok url for development
$Time_Stamp = date("Ymdhis");
$password = base64_encode($Business_Code . $Passkey . $Time_Stamp);

$curl_Tranfer = curl_init();
curl_setopt($curl_Tranfer, CURLOPT_URL, $Token_URL);
$credentials = base64_encode($consumer_key . ':' . $consumer_secret);
curl_setopt($curl_Tranfer, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));
curl_setopt($curl_Tranfer, CURLOPT_HEADER, false);
curl_setopt($curl_Tranfer, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_Tranfer, CURLOPT_SSL_VERIFYPEER, false);
$curl_Tranfer_response = curl_exec($curl_Tranfer);

$token = json_decode($curl_Tranfer_response)->access_token;

$curl_Tranfer2 = curl_init();
curl_setopt($curl_Tranfer2, CURLOPT_URL, $OnlinePayment);
curl_setopt($curl_Tranfer2, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $token));

$curl_Tranfer2_post_data = [
    'BusinessShortCode' => $Business_Code,
    'Password' => $password,
    'Timestamp' =>$Time_Stamp,
    'TransactionType' =>$Type_of_Transaction,
    'Amount' => $total_amount,
    'PartyA' => $phone_number,
    'PartyB' => $partyB,
    'PhoneNumber' => $phone_number,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => 'Clinton',
    'TransactionDesc' => 'test',
];

$data2_string = json_encode($curl_Tranfer2_post_data);

curl_setopt($curl_Tranfer2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_Tranfer2, CURLOPT_POST, true);
curl_setopt($curl_Tranfer2, CURLOPT_POSTFIELDS, $data2_string);
curl_setopt($curl_Tranfer2, CURLOPT_HEADER, false);
curl_setopt($curl_Tranfer2, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl_Tranfer2, CURLOPT_SSL_VERIFYHOST, 0);
$curl_Tranfer2_response = json_decode(curl_exec($curl_Tranfer2));

// this one looks if the stk push was processed
echo json_encode($curl_Tranfer2_response, JSON_PRETTY_PRINT);

//header("location:/RocketJSGame/index.php");
//exit;

?>
<!-- <form class="contact2-form validate-form" action="callback.php" method="post">
   <input type="hidden" name="Check_request_ID" value="<?php 
   //echo $curl_Tranfer2_response->Check_request_ID
    ?>
   ">
   </br></br>
   <button class="contact2-form-btn" style="margin-bottom: 30px;">Confirm Payment is Complete</button>
</form> -->