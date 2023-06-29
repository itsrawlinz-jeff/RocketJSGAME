<?php
include 'connection.php';
 		header("Content-Type: application/json");

     $response = '{
         "ResultCode1": 0, 
         "ResultDesc": "Confirmation Received Successfully"
     }';
 
     // DATA
     $mpesaResponse = file_get_contents('php://input');



// Parse the JSON response
$jsonResponse = json_decode($mpesaResponse, true);

// Check if the transaction was successful
if (isset($jsonResponse['Body']['stkCallback']['ResultCode']) && $jsonResponse['Body']['stkCallback']['ResultCode'] == 0) {
    if (isset($jsonResponse['Body']['stkCallback']['CallbackMetadata']['Item'])) {
        $amount = 0;
        foreach ($jsonResponse['Body']['stkCallback']['CallbackMetadata']['Item'] as $item) {
            if ($item['Name'] == 'Amount') {
                $amount = $item['Value'];
                break;
            }
        }

        //TODO: update database here of successful transaction.. add hio amount kwa user ako logged in
        // *** was testing with this below that if the mpesa payment is confirmed then it should create a table called tests


    // $sql = "CREATE TABLE IF NOT EXISTS tests (
    //     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    //     firstname VARCHAR(30) NOT NULL,
    //     lastname VARCHAR(30) NOT NULL,
    //     email VARCHAR(50),
    //     reg_date TIMESTAMP
    // )";
    // $con->query($sql);
    // echo "Table created successfully";
    }
}



     // log the response
     $logFile = "M_PESAConfirmationResponse.txt";
 
     // write to file
     $log = fopen($logFile, "a");
 
     fwrite($log, $mpesaResponse);
     fwrite($log, "\n");
     fclose($log);

//      $callbackData = json_decode($mpesaResponse);
//      echo "callbackData: ".$callbackData."\n";

//      if (isset($callbackData->Body->stkCallback->ResultCode)) {
//       if ($callbackData->Body->stkCallback->ResultCode == 0) {
//       echo "ResultCode: ".$callbackData->Body->stkCallback->ResultCode."\n";
//     // create a new table called test
//     $sql = "CREATE TABLE IF NOT EXISTS tests (
//         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//         firstname VARCHAR(30) NOT NULL,
//         lastname VARCHAR(30) NOT NULL,
//         email VARCHAR(50),
//         reg_date TIMESTAMP
//     )";
//     $con->query($sql);
//     echo "Table created successfully";
// } else {
//     // create a new table called test
//     $sql = "CREATE TABLE IF NOT EXISTS errortests (
//         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//         firstname VARCHAR(30) NOT NULL,
//         lastname VARCHAR(30) NOT NULL,
//         email VARCHAR(50),
//         reg_date TIMESTAMP
//     )";
//     $con->query($sql);
//     echo "Table created successfully";
//   }
//      }
     echo $response;

?>