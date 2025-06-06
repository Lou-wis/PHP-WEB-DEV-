<!DOCTYPE html>
<html lang="en">
    
<?php
include ("head.php");
?>

<?php
include ("click_event.php");
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<body>
    <div id="content">
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
      <!--  <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->

        <!-- Sidebar Container -->
        <div id="sidebarContainer"></div>

        <!-- Content Start -->
        <div class="content">
            <?php
            include("navbar.php");
            ?>

            <?php
            include("sidebar_content.php");
            ?>

            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                <?php
                    include("conn.php");

                    $query = "SELECT * FROM `ua_jars`";
                    $query_run = mysqli_query($conn, $query);

                    if ($query_run) {
                        $numProducts = mysqli_num_rows($query_run);
                ?>
                        <div class="col-sm-6 col-xl-3">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-line fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Products</p>
                                    <h6 class="mb-0"><?php echo $numProducts; ?></h6>
                                </div>
                            </div>
                        </div>
                <?php
                    } else {
                        echo "No Record Found";
                    }
                ?>
                </div>
            </div>
            </div>
            <!-- Sale & Revenue End -->

            <br><br>

            <!-- Widgets Start -->
                <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-md-6 col-xl-4">
                            <div class="h-100 bg-light rounded p-4">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h6 class="mb-0">Calender</h6>
                                    <!--<a href="">Show All</a>-->
                                </div>
                                <div id="calender"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Widgets End -->

            <?php include 'footer.php'?>
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->

 
   <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>



    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    
</body>
</html>
