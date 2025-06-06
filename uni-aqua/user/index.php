<?php
session_start();
if(!isset($_SESSION['email'])){
  header('Location: ../login.php');
  exit();
}

include 'conn.php';


//START PRICE
$sql = "SELECT MIN(jars_price) AS min_price FROM ua_jars";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $min_price = $row["min_price"];
} else {
    $min_price = "N/A";
}
$conn->close();
//END PRICE



?>

<!DOCTYPE html>
<html lang="en">

    <body>

    <?php include 'head.php'; ?>
    
    <?php include 'header.php'; ?>


    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
            <h1>Minimum of PHP <?php echo $min_price; ?></h1>
            <h2>Welcome to Uni Aqua, where purity, convenience, and hydration come together in every refreshing drop.</h2>
            <div class="d-flex justify-content-center justify-content-lg-start">
                <a href="#order" class="btn-get-started scrollto">Order Now</a>
                <!-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
            </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
            <img src="assets/img/8A.png" class="img-fluid animated" alt="">
            </div>
        </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">

    <!-- =======  ORDER Section ======= -->
    
    <!-- displaying products -->
    <section id="order" class="pricing">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Products</h2>
                <p>Select the product you want to order.</p>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <?php 
                    include "conn.php";
                    
                    $sql = "SELECT jars_id from ua_jars";
                    $query = mysqli_query($conn, $sql);
                    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    $cnt = mysqli_num_rows($query);

                    $sql = "SELECT * FROM ua_jars";
                    $query = mysqli_query($conn, $sql); 
                    $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
                    $cnt = 1;
                    if(mysqli_num_rows($query) > 0) {
                        foreach($results as $result) {  
                    ?>     
                    <div class="col-lg-4 col-md-6 mb-4">  
                        <!-- bilog -->
                        <div class="card text-center p-4" data-aos="fade-up" data-aos-delay="200">     
                            <img src="/SYSTEM_DEVELOPMENT/uni-aqua/admin/<?php echo htmlentities($result['image_name']);?>" class="card-img-top" style="height: 250px; width: auto;" alt="<?php echo htmlentities($result['jars_name']);?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlentities($result['jars_name']);?></h5>
                                <p class="card-text"><?php echo htmlentities($result['jars_description']);?></p>
                                <h5 class="card-text"><?php echo htmlentities("₱ " . $result['jars_price']);?></h5>
                                <!-- Add onclick event to call JavaScript function and pass item details -->
                                <!-- Pass the product name, price, and image filename -->
                                <button class="order-btn col-10 circlebutton" type="button" onclick="openModal('<?php echo htmlentities($result['jars_name']);?>', '<?php echo htmlentities($result['jars_price']);?>', '<?php echo htmlentities($result['image_name']);?>', '<?php echo $result['jars_id']; ?>')" data-bs-toggle="modal" data-bs-target="#jarinfo">Order</button>
                            </div>
                        </div>
                        <!-- bilog -->
                    </div>
                    <?php 
                        }
                    }
                    ?>
                </div>
            </div> 
        </div>
    </section>
    <!-- End ORDER Section -->
    
    <!-- ADD TO CART -->
    <table id="cart_table" class="table table-borderless table-nowrap table-centered mb-0" style="margin: 20px;">
        <thead class="table-light">
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>   
            </tr>
        </thead>
        <tbody>
            <!-- Rows for individual products will be added here dynamically -->
        </tbody>
        <!-- Empty row for total price -->
        <tr id="total_row">
            <td colspan="3"></td>
            <td></td>
            <td></td>
        </tr>
    </table>

<!-- ADD TO CART -->



    <!-- Modal -->
    <div class="modal fade circlegallon" id="jarinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <br>
                            <!-- Image -->
                            <img id="itemImage" src="" class="img-fluid" style="max-height: 200px; width: auto;" alt="Product Image">
                        </div>
                        <div class="col-6">
                            <div class="modal-header">
                                <!-- Price -->
                                <h5 id="itemPrice" class="modal-title"></h5>
                            </div>
                            <br>
                            <!-- Quantity input and add to cart button -->
                            <p class="text-center">Quantity</p>
                            <!-- Input for quantity -->
                            <input type="number" id="quantity" class="form-control input-number text-center" value="1" min="1" max="100">
                            <br>
                            <hr>
                            <!-- "Add to Cart" button -->
                            <center><button type="button" class="cart col-8" onclick="addToCart()" data-bs-dismiss="modal">Add to Cart </button></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL -->

    
    <!-- CHECKOUT -->
    <form action="charge_new.php" method="post" class="circlegallon">
    <input hidden type="text" id="amountInput" name="amount" value="" />
    <div class="text-end">
    <input type="submit" class="cart mb-3 col-2 mt-5" style="margin-right: 10px;" name="submit" value="Checkout">
    </div>
   
    </form>
    <!-- CHECKOUT -->
    

    <script> 

        // Function to add selected product to cart
        function addToCart() {
            var productName = document.getElementById('itemTitle').innerText;
            var productPrice = document.getElementById('itemPrice').innerText;
            var productQuantity = document.getElementById('quantity').value;
            var totalPrice = parseFloat(productPrice.replace('Price: ₱ ', '')) * parseInt(productQuantity);

            // AJAX request to add product to session cart
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "addToSession.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle response, if needed
                    
                }
            };
            xhr.send("productName=" + encodeURIComponent(productName) + "&productPrice=" + encodeURIComponent(productPrice) + "&productQuantity=" + encodeURIComponent(productQuantity) + "&totalPrice=" + encodeURIComponent(totalPrice.toFixed(2)));
            
            // Update the cart table
            updateCartTable(productName, productPrice, productQuantity, totalPrice.toFixed(2));
        }

        // Function to update the cart table
        function updateCartTable(productName, productPrice, productQuantity, totalPrice) {
            // Check if the product is already in the cart
            var cartRows = document.getElementById("cart_table").getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            for (var i = 0; i < cartRows.length; i++) {
                var rowProductName = cartRows[i].getElementsByTagName('td')[0].innerText;
                if (rowProductName === productName) {
                    // If the product is already in the cart, update the quantity and total price
                    var currentQuantity = parseInt(cartRows[i].getElementsByTagName('td')[2].innerText);
                    var newQuantity = currentQuantity + parseInt(productQuantity);
                    var newTotalPrice = parseFloat(cartRows[i].getElementsByTagName('td')[3].innerText.replace('₱ ', '')) + parseFloat(totalPrice);
                    // Update the quantity and total price in the existing row
                    cartRows[i].getElementsByTagName('td')[2].innerText = newQuantity;
                    cartRows[i].getElementsByTagName('td')[3].innerText = "₱ " + newTotalPrice.toFixed(2);
                    updateTotalPrice(); // Update the total price row
                    return; // Exit the function
                }
            }

            // If the product is not already in the cart, create a new row
            var newRow = "<tr>" +
                "<td>" + productName + "</td>" +
                "<td>" + productPrice + "</td>" +
                "<td>" + productQuantity + "</td>" +
                "<td>₱ " + totalPrice + "</td>" +
                "<td><button type='button' class='btn btn-danger remove-btn' onclick='removeFromCart(this)'>Remove</button></td>" +
                "</tr>";

            // Append the new row to the table
            document.getElementById("cart_table").getElementsByTagName('tbody')[0].innerHTML += newRow;
            updateTotalPrice(); // Update the total price row
        }

        // Function to update the total price row
        function updateTotalPrice() {
            var total = 0;
            var cartRows = document.getElementById("cart_table").getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            for (var i = 0; i < cartRows.length; i++) {
                var totalPriceString = cartRows[i].getElementsByTagName('td')[3].innerText;
                var totalPrice = parseFloat(totalPriceString.replace('₱ ', ''));
                total += totalPrice;
            }
            // Update the total price row
            document.getElementById("total_row").getElementsByTagName('td')[1].innerText = "Total: ₱ " + total.toFixed(2);
            
            // Set the value of the amount input field
            document.getElementById("amountInput").value = total.toFixed(2);
        }

        // Call the updateTotalPrice() function when the page loads
        window.onload = function() {
            updateTotalPrice();
        };

        // Function to remove product from cart
        function removeFromCart(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
            updateTotalPrice(); // Update the total price row

            // AJAX request to remove product from session cart
            var productName = row.getElementsByTagName('td')[0].innerText;
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "removeFromSession.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle response, if needed
                }
            };
            xhr.send("productName=" + encodeURIComponent(productName));
        }

        var addedProducts = [];
        // Function to open modal and set item details
        function openModal(name, price, imageFileName, quantityId) {
            console.log("Image File Name:", imageFileName); 
            document.getElementById('itemTitle').innerText = name;
            document.getElementById('itemPrice').innerText = "Price: ₱ " + price;
            document.getElementById('itemImage').src = "/SYSTEM_DEVELOPMENT/uni-aqua/admin/" + imageFileName;
            document.getElementById('quantity').setAttribute('data-quantity-id', quantityId);
        }

        $(document).ready(function () {
            $('.quantity-right-plus').click(function (e) {
                e.preventDefault();
                var $quantityInput = $(this).parent().siblings('input[type="text"]');
                var quantity = parseInt($quantityInput.val());
                $quantityInput.val(quantity + 1);
            });

            $('.quantity-left-minus').click(function (e) {
                e.preventDefault();
                var $quantityInput = $(this).parent().siblings('input[type="text"]');
                var quantity = parseInt($quantityInput.val());
                if (quantity > 1) {
                    $quantityInput.val(quantity - 1);
                }
            });
        });

        
    </script>


    
        
        
    
    </main>
    <!-- End #main -->

    <?php
    include ("footer.php"); 
    ?>

    <!-- SweetAlert library -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </body>

    </html>