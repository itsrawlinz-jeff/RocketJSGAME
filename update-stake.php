<?php
session_start();
include 'connection.php';


$balance = $_SESSION['user_balance'];
$id = $_SESSION['user_id'];
//$pesa = $_POST['pesa'];
//$aco = $_POST['aco'];

//echo $balance;
//echo $pesa;
//echo $aco;
if (isset($_POST['value'])) {
    
    $realtimeValue = $_POST['value'];
    echo $realtimeValue;
    // Perform calculations and update account balances
    $multipliedValue = $realtimeValue * 2; // Example multiplication
    
    // Update the balances in the database or wherever you store them
    // ...
    $sql = "UPDATE user_status SET balance = balance + $realtimeValue WHERE user_id = $id";
    $con->query($sql);
    
    // Return a response back to the client
    echo "Account balances updated successfully.";
  }
  
        ?>