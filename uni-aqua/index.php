<?php 
include('conn.php');
$sql = "SELECT * FROM ua_jars LIMIT 1";
$all_product = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<?php
include ("head.php");
?>

<body>

  <?php
  include("header.php");
  ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>Unique Hydration, Endless Purity</h1>
          <h2>Welcome to Uni Aqua, where purity, convenience, and hydration come together in every refreshing drop.</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <!--<a href="#login" class="btn-get-started scrollto">Get Started</a>-->
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="assets/img/8A.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section>
  <!-- End Hero -->

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
              Uni Aqua is a purified drinking water refilling station that offers 
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Endless Purity</li>
              <li><i class="ri-check-double-line"></i> Unique Hydration</li>
              <li><i class="ri-check-double-line"></i> Affordable Excellence</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              We at Uni Aqua know how important it is to drink clean, delicious water 
              to stay hydrated. We are committed to offering you the purest possible 
              water at our water refill station, so that each and every drop is a 
              source of energy for your overall health.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

     

    <!-- ======= Cta Section ======= -->
    <section id="price" class="cta">
      <?php
      while ($row = mysqli_fetch_assoc($all_product)) {
      ?>
        <div class="container" data-aos="zoom-in">
          <div class="row">
            <div class="col-lg-12 text-center">
              <div class="section-title">
                <h2>Pricing</h2>
                <h4><sup>₱</sup><?php echo $row['jars_price']; ?><span>per gallon/piece</span></h4>
              </div>
            </div>
            <div class="container">
              <div class="col-md-12 text-center">
                <a class="cta-btn" href="login.php">Order Now</a>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </section>
    <!-- End PRICE Section -->


     <!-- End Contact Section -->

     <!-- ======= DOWNLOAD APP siya pricing lang yung ID Section ======= -->
     <section id="download" class="pricing">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-12 text-center" data-aos="fade-up" data-aos-delay="200">
            <div class="box featured">
              <div class="section-title">
                <h2>Mobile Version</h2>
                <p> Get the mobile version on your phone. Download Now!</p>
              </div>
              <!-- <ul class="text-center">
                <li><i class="bx bx-check"></i> Quam adipiscing vitae proin</li>
                <li><i class="bx bx-check"></i> Nec feugiat nisl pretium</li>
                <li><i class="bx bx-check"></i> Nulla at volutpat diam uteera</li>
                <li><i class="bx bx-check"></i> Pharetra massa massa ultricies</li>
                <li><i class="bx bx-check"></i> Massa ultricies mi quis hendrerit</li>
              </ul> -->
              <a href="#download" class="buy-btn">Download App</a>
            </div>
          </div>

          
        </div>

      </div>
    </section>
   <!-- End DOWNLOAD APP Section -->

  </main><!-- End #main -->

  <?php include("footer.php");?>

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