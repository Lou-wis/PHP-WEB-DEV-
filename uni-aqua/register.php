<!DOCTYPE html>
<html lang="en">

<?php include "head.php";?>

<body>

 <?php include "header.php";?>

<main id="main">
  
<!-- ======= REGISTER Section ======= -->
     <section id="login" class="contact" style="background: #37517e;">
      <div class="container" data-aos="fade-up">
        <div class="row">        
        <div class="col-lg-12">
        <div class="section-title">
          <h2 style="color: #ffffff;" class="mt-4">Register</h2>
        <p style="color: #ffffff;">Hello, please enter your following credentials to create an account. </p>
        </div>
        
        <div class="row">
        <div class="col-lg-6 mt-2 mt-lg-0 d-flex align-items-stretch"> 

       
            <form action="user_register.php" method="post" role="form" class="form">
              
            <div class="row">
                <div class="form-group">
                  <label for="name">Full Name</label>
                  <input  type="text" name="fullname" class="form-control" id="fullname" required>
              </div>
            </div>

              <div class="row">
                <div class="form-group">
                  <label for="name">Contact Number</label>
                  <input type="text" name="contactnum" class="form-control" id="contactnum" required>
              </div>
            </div>

            <div class="row">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" id="address" name="address" style="height: 100px" required></textarea>
                </div>
            </div>

            <div class="row">
                  <div class="form-group">
                      <label for="email">Email <span style="font-size: 12px; color: #999;">(this is needed to login)</span></label>
                      <input type="text" name="email" class="form-control" id="email" minlength="6" required>
                  </div>
            </div>


                <script>
                    var myInput = document.getElementById("username");

                    myInput.onfocus = function() {
                      document.getElementById("message_uname").style.display = "block";
                    }

                    myInput.onblur = function() {
                      document.getElementById("message_uname").style.display = "none";
                    }
                    </script>


              <div class="row">
                  <div class="form-group">
                  <label for="email">Password <span style="font-size: 12px; color: #999;">(this is needed to login)</span></label>
                    <input type="password" name="password" class="form-control" id="password1" required>

                    <input type="checkbox"  id="showPassword" onclick="myFunction()">
                    <p style="margin-top:-38px; margin-left:18px; font-size:13px;">Show password</p>
                    </div>
                  </div>                      
                 
            <!--<div class="text-center" id="message_pass"> <h6 style="color:#5994FF;"> Password must be atleast 6 characters </h6> </div> -->                               

              <div class="text-center"><button type="submit" class="col-6"><h5>Register</h5></button></div>
           
       <script>
          function myFunction() {
          var x = document.getElementById("password1");
              if (x.type === "password") {
                x.type = "text";
                 } else {
                x.type = "password";
                 }  }
        </script>


        <script>
           var myPass = document.getElementById("password1");

            myPass.onfocus = function() {
            document.getElementById("message_pass").style.display = "block";
              }

            myPass.onblur = function() {
            document.getElementById("message_pass").style.display = "none";
              }
          </script>  


        <div class="mt-3">
            <p class="mb-0  text-center">Already have an account? <a href="login.php" class="text-primary fw-bold">Log In.</a></p>
        </div>
          
        </div> 
    </form>
 
        <div class="col-lg-6 d-flex align-items-center justify-content-center" data-aos="zoom-in" data-aos-delay="200">
  <img src="assets/img/9A.png" class="img-fluid animated" alt="">
</div>

          </div>
        </div>
     </div>
  </section>
    
    <!-- End REGISTER Section -->

    <!-- ======= Footer ======= -->
        <footer id="footer">

            <div class="container footer-bottom clearfix" >
              <div class="copyright">
                &copy; Copyright <strong><span>Uni Aqua</span></strong>. All Rights Reserved
              </div>     
            </div>

        </footer>

<!-- End Footer -->



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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</body>

</html>