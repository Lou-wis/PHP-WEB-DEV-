<!DOCTYPE html>
<html lang="en">

<?php include 'head.php';?>

<body>
<?php include 'header.php';?>

 
<main id="main">

<?php
session_start();
require_once 'vendor/autoload.php';

$clientID = '649672661772-4akp9e0th6q3t4uqregg6cf9bclmk9im.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/SYSTEM_DEVELOPMENT/uni-aqua/login.php';

// Create a Google_Client object
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // Get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;

    include("conn.php");

    // Check if email already exists in the database
    $check_sql = "SELECT * FROM ua_users WHERE user_email = '$email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
        // Email doesn't exist, insert user data into database
        $insert_sql = "INSERT INTO ua_users (user_email, user_fullname) VALUES ('$email', '$name')";
        if ($conn->query($insert_sql) === TRUE) {
            // Store user data in session
            $_SESSION['email'] = $email;
            $_SESSION['name'] = $name;
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // Email already exists, retrieve user data from the database and store in session
        $row = $check_result->fetch_assoc();
        $_SESSION['email'] = $row['user_email'];
        $_SESSION['name'] = $row['user_fullname'];
    }

    // Redirect to another folder after successful login
    header('Location: ../uni-aqua/user/index.php');
    exit();
}else{ 
?>
<!-- ======= LOGIN Section ======= -->
<section id="login" class="contact" style="background:#37517E;">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2 style="color:#ffffff;">Log In</h2>
            <p style="color:#ffffff;">Hello, please enter your credentials to access your account.</p>
        </div>
        <div class="row">
            <div class="col-lg-6 mt-2 mt-lg-0 d-flex align-items-stretch">
                <form id="loginForm" method="POST" role="form" class="form">
                    <div class="row">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" name="user_email" class="form-control" id="user_email" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" class="form-control" name="user_password" id="user_password" required>
                            <input type="checkbox" id="show_password" onclick="togglePassword()">
                            <p style="margin-top:-38px; margin-left:18px; font-size:13px;">Show password</p>
                        </div>
                    </div>
                    <div id="errorAlert"></div> <!-- Error message will be displayed here -->
                    <br>
                    <div class="text-center">
                        <button type="submit" name="login" value="Login" class="col-8"><h5>Login</h5></button>
                    </div>
                    <div class="mt-3">
                        <p class="mb-0 text-center">Don't have an account? <a href="register.php" class="text-primary fw-bold">Sign Up</a></p>
                    </div>
                    <div class="form-group">
                        <hr>
                        <center><a href="<?php echo $client->createAuthUrl() ?>"><img src="assets/img/google-sign.png" width="256"></a></center>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
                <img src="assets/img/9A.png" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>
</section>
<?php }?>
    <!-- End Contact Section -->

  </main>
  <?php include ('footer.php');?>
  <!-- End #main -->

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#loginForm').submit(function(event) {
        event.preventDefault(); 

        var formData = $(this).serialize(); 
        $.ajax({
          type: 'POST',
          url: 'login_process.php', 
          data: formData, 
          success: function(response) {
            var result = JSON.parse(response); 

            if (result.redirect) {
              window.location.href = result.redirect; 
            } else {
              $('#errorAlert').html('<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert" style="border-radius: 10px;">' +
                '<strong>Error:</strong> ' + result.error +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                '</div>'); 
            }
          },
          error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error); 
          }
        });
      });
        /*$('button[type="submit"]').click(function() {
          $('#errorAlert').html(''); // Clear previous error message
        });*/ 
    });

          // Function to toggle password visibility
          function togglePassword() {
            var x = document.getElementById("user_password");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
          }
  </script>


  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
