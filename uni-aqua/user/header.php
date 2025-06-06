<?php 
include('conn.php');

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql = "SELECT user_id, user_fullname, user_email FROM ua_users WHERE user_email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['user_id']; // Added user_id retrieval
        $fullname = $row['user_fullname'];
        $email = $row['user_email'];
    }
}
?>
<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <!-- <a href="index.html">
        <h1 class="logo me-auto"><img src="assets/img/water-drop2.png" class="img-fluid">Uni Aqua</h1> 
      </a> -->
      <h1 class="logo me-auto">
          <img src="assets/img/water-drop2.png" class="img-fluid">
          <a href="index.php">Uni Aqua</a>
          <?php
          // Check if session is not already started
          if (session_status() === PHP_SESSION_NONE) {
              session_start();
          }

          // Check if the 'email' session variable is set, indicating that the user is logged in
          if (isset($_SESSION['email'])) {
              echo '<span style="font-family: Arial, sans-serif; color: white; font-size: 0.45em;">Welcome, ' . $fullname . '!</span>';
          }
          ?>
      </h1>

      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
       
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="index.php">Home</a></li>  
          <!--<li><a class="nav-link scrollto" href="record.php">Records</a></li>-->    
          <li class="dropdown"><a href=""><span>Profile</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <!--<li><a href="edit-profile.php">Edit Profile</a></li>-->
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar END -->

    </div>
  </header><!-- End Header -->