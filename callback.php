<?php
include 'connection.php';

 		header("Content-Type: application/json");

    $response = '{
        "ResultCode": 0, 
        "ResultDesc": "Confirmation Received Successfully",
    }';
     // DATA
     $mpesaResponse = file_get_contents('php://input');
     // log the response
     $logFile = "M_PESAConfirmationResponse.txt";
 
     // write to file
     $log = fopen($logFile, "a");
 
     fwrite($log, $mpesaResponse);
     fwrite($log, "\n");
     fclose($log);

$jsonResponse = json_decode($mpesaResponse, true);


if($jsonResponse !== null){
if($jsonResponse['Body']['stkCallback']['ResultCode'] == 0){
    $amount = $jsonResponse['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
    $phone = $jsonResponse['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];

    $sql = "UPDATE user_status SET balance = balance + $amount, deposite = deposite + $amount WHERE phone = $phone";
    $con->query($sql);
}
}

     echo $response;
?>
