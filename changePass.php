<?php
session_start();
    include("connection.php");
    include("functions.php");
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // {something was posted}
        //collecting the required variables:
        $new_password = $_POST['new_password'];
        $old_password = $_POST['old_password'];
        $users_id = $_SESSION['user_id'];
        /*
        $query = "SELECT * FROM users WHERE user_name = '{$_SESSION['user_name']}'";
        $select_user_query = mysqli_query($con, $query);
        if(!$select_user_query){
            die("QUERY FAILED". mysqli_error($con));
        }
        while($row = mysqli_fetch_array($select_user_query)){
            $db_user_password = $row['user_password'];
        }
        */
        // Checking if not equal :
        if ($old_password !== $new_password){
            $query = "UPDATE users SET password = '$new_password' WHERE user_id = '$users_id'";
            $change_password_query = mysqli_query($con, $query);
            if(!$change_password_query){
                die("QUERY FAILED". mysqli_error($con));
            }
            //echo "<script>alert('Password Changed')</script>";
            die("<script>window.location.href = 'index.php'</script>");
        }
        else{
            die("<script>window.location.href = 'index.php'</script>");
        }
    }
?>