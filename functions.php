<?php
session_start();
$user_id = $_SESSION['user_id'];

function check_login($con){
    if(isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1";

        //$result = mysqli_query($con,$query);
        $result = $con->query($query);
        if($result && $result->num_rows > 0){
            $user_data = $result->fetch_assoc();
            
            return $user_data;
        }
        
    }
    
    echo "You are not logged in. Please login to continue.";
    //header("location: index.php"); 
    die;
}
function random_num($length){
    $text = "";
    if($length < 5 )
    {
        $length = 5 ;
    }
    $len = rand(4,$length);
    for($i=0; $i < $len; $i++)
    {
        $text .= rand(0,9);
    }
    return $text;
}
function update_status($con,$amount){
    $sql = "UPDATE user_status ".
    "SET balance = balance + " .$amount.
    " WHERE user_id  = $user_id";

    $result = $con -> query($sql);
    if(!$result){
        echo"Error". $con->error;
        die;
    }
    else{
        echo "Updated successfully";
    }
}