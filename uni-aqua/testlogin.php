<?php
session_start();
require('./conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $userEmail = isset($_POST['user_email']) ? trim($_POST['user_email']) : '';
    $userPassword = isset($_POST['user_password']) ? trim($_POST['user_password']) : '';

    // Validate and sanitize inputs
    if (empty($userEmail) || empty($userPassword)) {
        $_SESSION['error'] = "Please fill up all fields";
    } else { 
        // Sanitize inputs to prevent SQL injection
        $userEmail = mysqli_real_escape_string($conn, $userEmail); 

        // Prepare the query using prepared statement
        $queryValidate = "SELECT * FROM ua_users WHERE user_email=? AND user_password = MD5(?)";
        $stmt = mysqli_prepare($conn, $queryValidate);

        // Bind parameters and execute the query
        mysqli_stmt_bind_param($stmt, 'ss', $userEmail, $userPassword);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
         
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['status'] = 'valid';
            
            $row = mysqli_fetch_assoc($result);

            $_SESSION['id'] = $row['user_id'];
            $_SESSION['useremail'] = $row['user_email'];
            $_SESSION['userfullname'] = $row['user_fullname'];
            $_SESSION['usercontactnumber'] = $row['user_contactnumber'];
            $_SESSION['useraddress'] = $row['user_address'];
            $_SESSION['userpassword'] = $row['user_password'];
            $_SESSION['usertype'] = $row['user_type'];
            // Redirect to the dashboard
            if ($_SESSION['usertype'] == 1){
                header("Location: ../uni-aqua/admin/");
            }
            else {
                header("Location: ../uni-aqua/user/");
            }
            
            exit();
            
           
          
        } 
        else {
            $_SESSION['error'] = "Invalid username or password";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST" action="">
        <?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
        Email: <input type="text" name="user_email" required><br>
        Password: <input type="password" name="user_password" required><br>
        <input type="submit" name="login" value="Login">
    </form>
</body>
</html>
