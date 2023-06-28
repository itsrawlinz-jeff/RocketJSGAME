<?php
include 'connection.php';
// Initialize the variables
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
$CallBackURL = 'https://us-central1-mybike-57a88.cloudfunctions.net/ussd';
$Time_Stamp = date("Ymdhis");
$password = base64_encode($Business_Code . $Passkey . $Time_Stamp);


//generate authentication token.

$curl_Tranfer = curl_init();
curl_setopt($curl_Tranfer, CURLOPT_URL, $Token_URL);
$credentials = base64_encode($consumer_key . ':' . $consumer_secret);
curl_setopt($curl_Tranfer, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));
curl_setopt($curl_Tranfer, CURLOPT_HEADER, false);
curl_setopt($curl_Tranfer, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl_Tranfer, CURLOPT_SSL_VERIFYPEER, false);
$curl_Tranfer_response = curl_exec($curl_Tranfer);

$token = json_decode($curl_Tranfer_response)->access_token;

// another section
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

echo json_encode($curl_Tranfer2_response, JSON_PRETTY_PRINT);


// update the database
// Assuming you have established a connection to your database in the connection.php file

// Check if the payment was successful
if (isset($curl_Tranfer2_response->ResultCode) && $curl_Tranfer2_response->ResultCode == 0) {
  // Payment successful, update the balance in the database

  // Retrieve the user's phone number and amount from the payment form
  $phone_number = $_POST['phone_number'];
  $total_amount = $_POST['amount'];

  // Prepare the SQL statement to update the balance
  // $sql = "UPDATE user_status SET balance = 7000 WHERE id = 4";
  // update $_SESSION['user_balance'] = $total_amount + $_SESSION['user_balance'];
  $sql = 
  $stmt = $con->prepare($sql);

  // Check if the statement preparation was successful
  if ($stmt) {
      $stmt->bind_param("ss", $total_amount, $phone_number);

      // Execute the statement
      $stmt->execute();

      // Check if the update was successful
      if ($stmt->affected_rows > 0) {
          echo "Payment successful. Balance updated in the database.";
      } else {
          echo "Payment successful, but failed to update balance in the database.";
      }

      // Close the statement
      $stmt->close();
  } else {
      echo "Failed to prepare the SQL statement.";
  }
} else {
  // Payment not successful or ResultCode is undefined
  echo "Payment failed. Please try again.";
}

?>