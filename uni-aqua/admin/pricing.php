<!DOCTYPE html>
<html lang="en">

<?php
include ("head.php");
?>


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
        
        <?php
        include("sidebar_content.php");
        ?>


        <!-- Content Start -->
        <div class="content">

            <?php
            include("navbar.php");
            ?>
            <br><br>

            <!--  Header End -->
            <div class="container-fluid">
                <div class="container-fluid"> 
            
                    <div class="card">
                        <div class="card-body ">
                            <h5 class="card-title fw-semibold mb-4 d-inline float-start">Products</h5>
                            <button type="button" class="btn btn-secondary float-end" data-toggle="modal" data-target="#myModal">Add Product</button>
                        </div>
                        <div class="card-body" style='overflow-x:auto; margin-top:-30px' >

                            <table id="tbl" class="table table-striped table-bordered" style="width:100%" table-border="1">
                                <thead>
                                    <tr>
                                        <th hidden>Jar ID</th>
                                        <th>Jar Name</th>
                                        <th>Description</th>
                                        <th>Jar Image</th>
                                        <th>Jar Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("conn.php");

                                    $query = "SELECT * FROM `ua_jars`";
                                    $query_run = mysqli_query($conn, $query);

                                    if ($query_run) {
                                        foreach ($query_run as $row) {
                                    ?>

                                            <tr>
                                                <td hidden><?php echo $row['jars_id']; ?></td>
                                                <td><?php echo $row['jars_name']; ?></td>
                                                <td><?php echo $row['jars_description']; ?></td>
                                                <td><img src="<?php echo $row['image_name']; ?>" width="130px" height="70px"></td>
                                                <td><?php echo $row['jars_price']; ?></td>
                                                <td text-align ="center">
                                                    <button class="btn btn-secondary btn-sm updateBtn" type="button" data-toggle="modal" data-target="#myModal1"><i class="fa-solid fa-pen-to-square"></i></button>
                                                    <button class="btn btn-danger btn-sm delBtn" type="button" data-toggle="modal" data-target="#myModal2"><i class="fa-solid fa-trash"></i></button>
                                                </td>    
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "No Record Found";
                                    }
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <!-- Back to Top -->
                <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
            </div>

            <!-- ADD PROD MODAL START -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                                <!-- <button type="button" class="fa fa-window-close" data-dismiss="modal">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
                            </div>

                            <form method="POST" action="insertProd.php" enctype="multipart/form-data">
                            <!-- Modal Body -->
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="inputProduct">Jar Name</label>
                                    <input type="text" class="form-control" id="inputProduct" name="inputName" required>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="inputDescrip">Jar Description</label>
                                    <input type="text" class="form-control" id="inputDescrip" name="inputDescrip" required>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="inputDescrip">Jar Image</label>
                                    <input type="file" class="form-control" id="" name="image" required>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="inputPrice">Jar Price</label>
                                    <input type="text" class="form-control" id="inputPrice" name="inputPrice" required>
                                </div>                        
                            </div>

                            <!-- Modal Footer (Buttons) -->
                            <div class="modal-footer"> 
                                <hr>
                                <button type="submit" name="submit" class="btn btn-primary">Save Data</button>
                                <button type="button" name="cancel" class="btn btn-danger" data-dismiss="modal" formaction="pricing.php">Close</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            <!-- ADD PROD MODAL END -->

            <!-- UPDATE MODAL START -->
            <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                            <!-- <button type="button" class="fa fa-window-close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button> -->
                        </div>
                        <form method="POST" action="updateProd.php" enctype="multipart/form-data">
                        <!-- Modal Body -->
                        <div class="modal-body">
                                <div class="form-group mt-2">
                                    <input type="hidden" class="form-control" id="userID" name="id" required>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="inputData">Jar Name</label>
                                    <input type="text" class="form-control" id="updateProdName" name="updateProdName" required>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="inputData">Jar Description</label>
                                    <input type="text" class="form-control" id="updateDescrip" name="updateDescrip"required>
                                </div>

                                <div class="form-group mt-2">
                                <label for="inputDescrip">Jar Image</label>
                                <input type="file" class="form-control" id="image" name="image" >
                            </div>

                                <div class="form-group mt-2">
                                    <label for="inputData">Jar Price</label>
                                    <input type="text" class="form-control" id="updatePrice" name="updatePrice" required>
                                </div>
                        </div>
                        <!-- Modal Footer (Buttons) -->
                        <div class="modal-footer"> <hr>
                            <input type="submit" name="updatedata" value="Save Changes" class="btn btn-primary">
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- UPDATE MODAL END -->

            <!-- DELETE MODAL START -->
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                            <!-- <button type="button" class="fa fa-window-close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button> -->
                        </div>

                        <!-- Modal Body -->
                    <form method="POST" action="deleteProd.php">
                    <input type="hidden" name="delete_id" id="delete_id">
                        <div class="modal-body">
                            <h4>Are you sure do you want to remove this product?</h4>
                        </div>

                        <!-- Modal Footer (Buttons) -->
                    <div class="modal-footer">
                    <hr style="color: 2px solid black;">
                    <button type="submit" id="ProdDeleteBtn" name="ProdDeleteBtn" class="btn btn-primary">Confirm</button>
                </div>
                </form>
                    </div>
                </div>
            </div>
            <!-- DELETE MODAL END -->

        </div>

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

    <script>
        $(document).ready(function() {
            $('.updateBtn').on('click', function() {
                $('#myModal1').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                $('#userID').val(data[0]);
                $('#updateProdName').val(data[1]);
                $('#updateDescrip').val(data[2]);
                
                // Construct the image path only if it's not empty
                if (data[3].trim() !== "") {
                    var imagePath = 'uploadImage/' + data[3].trim();
                    $('#image').val(imagePath);
                }

                $('#updatePrice').val(data[4]);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.delBtn').on('click', function() {
                $('#myModal2').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function(){
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);
            });
        });
    </script>

</body>

</html>
