<?php

   include("db_config.php");
   $con = mysqli_connect(DB_HOSTNAME,DB_USERNAME,DB_PASSWORD,DB_NAME);
    if (!$con) {
      die('Could not connect: ' . mysqli_error($con));
    }
    session_start();
    $user = $_SESSION['loged_user'];

   if(isset($_POST['update_user'])){

    $old_user = $_POST['old_user'];
    $new_user = $_POST['new_user'];

    $get_user = mysqli_query($con,"SELECT * FROM user WHERE username = '$old_user' AND username='$user'");
    if(mysqli_num_rows($get_user) == 0){
        echo "Invalid Username.";

    }else{
        $row_1 = mysqli_fetch_assoc($get_user);
        $id = $row_1['user_id'];

        $user = "UPDATE user SET username = '$new_user' WHERE user_id = $id ";
        mysqli_query($con,$user);
        echo 1;
        }
    }

    ////////////////////////////////////////////////

    if(isset($_POST['update_pw'])){
        
        $old_pw     = md5($_POST['old_pw']);
        $new_pw     = md5( $_POST['new_pw']);
        $confirm_pw = md5($_POST['confirm_pw']);

        $get_pw = mysqli_query($con,"SELECT * FROM user WHERE password = '$old_pw' AND username='$user' ");

        if(mysqli_num_rows($get_pw) == 0){
            echo "Invalid Password.";

        }else if($new_pw != $confirm_pw){
            echo "Confirmation failed, Confirmation password does not match.";

        }else{
            $row = mysqli_fetch_assoc($get_pw);
            $id = $row['user_id'];
        
            $pw = "UPDATE user SET password = '$new_pw' WHERE user_id = $id ";
            mysqli_query($con,$pw);

            echo 1; 
        }
    }

    ?>


