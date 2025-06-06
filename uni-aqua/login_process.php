<?php
session_start();
require('./conn.php');

$response = array(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $userEmail = isset($_POST['user_email']) ? trim($_POST['user_email']) : '';
    $userPassword = isset($_POST['user_password']) ? trim($_POST['user_password']) : '';

    if (empty($userEmail) || empty($userPassword)) {
        $response['error'] = "Please fill up all fields"; 
    } else { 
        $userEmail = mysqli_real_escape_string($conn, $userEmail); 

        $queryValidate = "SELECT * FROM ua_users WHERE user_email=? AND user_password = MD5(?)";
        $stmt = mysqli_prepare($conn, $queryValidate);

        mysqli_stmt_bind_param($stmt, 'ss', $userEmail, $userPassword);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['user_password'] == md5($userPassword)) {
                $_SESSION['status'] = 'valid';
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['email'] = $row['user_email'];
                $_SESSION['userfullname'] = $row['user_fullname'];
                $_SESSION['usercontactnumber'] = $row['user_contactnumber'];
                $_SESSION['useraddress'] = $row['user_address'];
                $_SESSION['userpassword'] = $row['user_password'];
                $_SESSION['usertype'] = $row['user_type'];

                if ($_SESSION['usertype'] == 1 || $_SESSION['usertype'] == 2){
                    $response['redirect'] = "../uni-aqua/admin/index.php"; 
                } else {
                    $response['redirect'] = "../uni-aqua/user/index.php"; 
                }
            } else {
                $response['error'] = "Invalid username or password"; 
            }
        } else {
            $response['error'] = "User not found"; 
        }     
    }
}

echo json_encode($response); 
