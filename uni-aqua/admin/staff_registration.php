<!DOCTYPE html>
<html lang="en">
<?php include("head.php"); ?>

<style>
    .form-label {
        color: #000000; /* Black color */
        font-weight: normal; /* Make the text bold */
    }
</style>

<body>
    <div id="content">
        <div class="container-xxl position-relative bg-white d-flex p-0">
            <!-- Spinner Start -->
            <!--<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>-->
            <!-- Spinner End -->

            <?php include("sidebar_content.php"); ?>

            <!-- Content Start -->
            <div class="content">
                <?php include("navbar.php"); ?>
                <br><br>

            

            <!-- ======= REGISTER Section ======= -->
            <section id="register" class="contact" style="border: 3px solid #6fa8dc; border-radius: 15px; padding-bottom: 20px;">
                <div class="container" data-aos="fade-up">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="section-title text-center">
                                <h2 class="mt-4">Register</h2>
                                <p>Hello Admin, please enter the following credentials to create an account.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <form action="staff_register.php" method="post" class="form">
                                <div class="form-group mb-4">
                                    <label for="fullname" class="form-label">Full Name</label>
                                    <input type="text" name="fullname" class="form-control" id="fullname" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="contactnum" class="form-label">Contact Number</label>
                                    <input type="text" name="contactnum" class="form-control" id="contactnum" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <label for="email">Email <span style="font-size: 12px; color: #999;">(this is needed to login)</span></label>
                                        <input type="text" name="email" class="form-control" id="email" minlength="6" required>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="form-label">Password <span style="font-size: 12px; color: #999;">(this is needed to login)</span></label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill mb-3" style="padding: 15px 30px; font-size: 18px;">Register</button>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </section>

            <script>
            function myFunction() {
            var x = document.getElementById("password1");
                if (x.type === "password") {
                    x.type = "text";
                    } else {
                    x.type = "password";
                    }  }
            </script>
            <!-- End REGISTER Section -->

            <?php include("footer.php"); ?>
            
            </div>
            <!-- Content End -->

            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- DataTables -->
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

        <!-- Your other scripts -->
        <script src="lib/chart/chart.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
        <script src="js/main.js"></script>

        <script>
            $(document).ready(function() {
                $('#tbl').DataTable();
            });
        </script>
    </div>
</body>
</html>
