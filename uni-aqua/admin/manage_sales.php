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

<?php include 'conn.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Order Form</h2>
    <form id="orderForm" action="#" method="post">
        <div class="form-group row mb-2">
            <div class="col-sm-6">
                <label for="">Full Name</label>
                <select class="form-control" id="customer_name" name="customer_name" required>
                    <option value="">Select Customer</option>
                    <!-- Fetch customer names dynamically from database -->
                    <?php
                        // Fetch customer names from database
                        $sql = "SELECT user_id, user_fullname FROM ua_users WHERE user_type=0";
                        $result = mysqli_query($conn, $sql);

                        // Populate options
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['user_id'] . "'>" . $row['user_fullname'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="col-sm-6">
                <label for="contact_number">Contact Number:</label>
                <input type="text" class="form-control" id="contact_number" name="contact_number" required>
            </div>
        </div>
        <div class="form-group mb-2">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group row mb-2">
            <div class="col-sm-6">
                <label for="jar_name">Jar Name:</label>
                <select class="form-control" id="jar_name" name="jar_name" required>
                    <option value="">Select Jar</option>
                    <!-- Fetch jar names dynamically from database -->
                    <?php
                        $sql = "SELECT jars_id, jars_name FROM ua_jars";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['jars_id'] . "'>" . $row['jars_name'] . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="col-sm-2">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price" readonly>
            </div>
            <div class="col-sm-2">
                <label for="quantity">Quantity:</label>
                <div class="input-group">
                <input type="number" class="form-control" id="quantity" name="quantity" min="1" required oninput="this.value = (parseInt(this.value) > 0) ? Math.abs(this.value) : 1">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" id="addButton">+ Add</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="alertContainer"></div>
        <table class="table mt-3">
        <thead>
            <tr>
                <th></th> <!-- Column for Remove Button -->
                <th>Jar Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                
            </tr>
        </thead>
        <tbody id="orderItems">
            <!-- Sample Row -->
            <tr>
            </tr>
            <!-- Add more rows dynamically here -->
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4" align="right"><strong>Total Amount:</strong></td>
            <td id="totalAmount">0</td>
        </tr>
    </tfoot>
    </table>

    <!-- Dropdown for payment status -->
    <div class="row mt-3">
            <div class="col-sm-2">
                <label for="payment_status">Status:</label>
                <select class="form-control" id="payment_status" name="payment_status" required>
                    <option value="">Payment</option>
                    <option value="paid_cash">Paid (CASH)</option>
                    <option value="paid_paypal">PAID (PAYPAL)</option>
                </select>
            </div>
        </div>
    
    <br><br>
    <div class="row">
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary" id="submitOrderBtn">Submit</button>
            <button type="button" class="btn btn-secondary ml-2" onclick="history.back()">Cancel</button>
        </div>
    </div>
    </form>
</div>

<script>
        document.getElementById('submitOrderBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default form submission behavior

        // Update price before gathering form data
        updatePrice();

        // Get the selected user_id from the customer_name select field
        var userId = document.getElementById('customer_name').value;

        // Get the selected customer name from the customer_name select field
        var customerName = document.getElementById('customer_name').options[document.getElementById('customer_name').selectedIndex].text;
        
        // Gather form data
        var formData = new FormData(document.getElementById('orderForm'));

        // Append the selected user_id to the form data
        formData.append('user_id', userId);
        formData.append('customer_name', customerName);
        formData.append('jar_name', document.getElementById('jar_name').value);
        formData.append('price', document.getElementById('price').value);
        formData.append('quantity', document.getElementById('quantity').value);

        // Send form data to server-side script using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'process_order.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Do nothing here, handle the response in process_order.php
                } else {
                    // Error occurred during order processing
                    alert('Error submitting order. Please try again.');
                }
            }
        };
        xhr.send(formData);

        // Clear form fields after submission
        document.getElementById('customer_name').value = '';
        document.getElementById('contact_number').value = '';
        document.getElementById('address').value = '';
        document.getElementById('jar_name').value = '';
        document.getElementById('price').value = '';
        document.getElementById('quantity').value = '';
        document.getElementById('payment_status').value = '';
        document.getElementById('orderItems').innerHTML = '';
        document.getElementById('totalAmount').innerHTML = '';
    });


    //get user_id
    document.getElementById("customer_name").addEventListener("change", function() {
        var userId = this.value; // Get the selected user_id
        document.getElementById("user_id").value = userId; // Update the value of the hidden input field
    });

    //get contact and address
    document.getElementById("customer_name").addEventListener("change", function() {
        var userId = this.value; // Get the selected user ID
        if (userId !== "") {
            // Make an AJAX request to fetch contact number and address based on user ID
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    document.getElementById("contact_number").value = response.contact_number;
                    document.getElementById("address").value = response.address;
                }
            };
            xhr.open("GET", "get_contact_and_address.php?customer_id=" + userId, true);
            xhr.send();
        } else {
            // Clear the contact number and address fields if no user is selected
            document.getElementById("contact_number").value = "";
            document.getElementById("address").value = "";
        }
    });

    // Function to update the price when a jar is selected
    function updatePrice() {
        var jarSelect = document.getElementById('jar_name');
        var priceInput = document.getElementById('price');
        
        // Get the selected jar's ID
        var jarId = jarSelect.value;
        
        // Make AJAX request to fetch the price
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_price.php?jars_id=' + jarId, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the price input with the fetched price
                priceInput.value = xhr.responseText;
            }
        };
        xhr.send();
    }

    // Attach event listener to update price when jar selection changes
    document.getElementById('jar_name').addEventListener('change', updatePrice);

    //ADDING TO TABLE
    document.getElementById('addButton').addEventListener('click', function() {
        var jarId = document.getElementById('jar_name').value;
        var quantity = parseInt(document.getElementById('quantity').value); // Parse quantity as integer

        // Validate input
        if (jarId && quantity > 0) { // Ensure quantity is greater than 0
            // Fetch the jar name corresponding to the selected ID
            var jarName = document.getElementById('jar_name').options[document.getElementById('jar_name').selectedIndex].text;
            // Fetch the price
            var price = parseFloat(document.getElementById('price').value); // Parse price as float

            // Check if the product already exists in the table
            var existingProductRow = document.querySelector('#orderItems td:nth-child(2):not(:first-child)'); // Select second column (product name), excluding the first row (header)
            var foundDuplicate = false;
            while (existingProductRow) {
                if (existingProductRow.textContent === jarName) {
                    // Update quantity and total amount
                    var quantityCell = existingProductRow.nextElementSibling; // Next cell contains quantity
                    var totalAmountCell = quantityCell.nextElementSibling.nextElementSibling; // Third cell from quantity cell contains total amount
                    var existingQuantity = parseInt(quantityCell.textContent);
                    quantity += existingQuantity;
                    quantityCell.textContent = quantity;
                    totalAmountCell.textContent = (quantity * price).toFixed(2); // Update total amount with 2 decimal places
                    foundDuplicate = true;
                    break;
                }
                existingProductRow = existingProductRow.parentElement.nextElementSibling ? existingProductRow.parentElement.nextElementSibling.querySelector('td:nth-child(2)') : null; // Move to the next row
            }

            if (!foundDuplicate) {
                // Add new row to the table
                var newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td><button class="btn btn-danger btn-sm">X</button></td>
                    <td>${jarName}</td>
                    <td>${quantity}</td>
                    <td>${price.toFixed(2)}</td> <!-- Display price with 2 decimal places -->
                    <td>${(quantity * price).toFixed(2)}</td> <!-- Display total amount with 2 decimal places -->
                `;
                document.getElementById('orderItems').appendChild(newRow);
            }

            // Update total amount
            updateTotalAmount();
            
            // Reset jar name and price to default values
            document.getElementById('jar_name').value = '';
            document.getElementById('price').value = '';
            document.getElementById('quantity').value = '';
        } else {
            // Show a Bootstrap alert if any of the fields are empty or quantity is not greater than 0
            var existingAlert = document.querySelector('.alert');
            if (!existingAlert) {
                var alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-warning alert-dismissible fade show';
                alertDiv.role = 'alert';
                alertDiv.innerHTML = `
                    <strong>Warning!</strong> Please select a product and enter a valid quantity before adding to the table.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                document.getElementById('alertContainer').appendChild(alertDiv);
                setTimeout(function() {
                    alertDiv.remove();
                }, 2000); // 1000 milliseconds = 1 second
            }
        }
    });

    // Function to update the total amount
    function updateTotalAmount() {
        var totalAmount = 0;
        var rows = document.querySelectorAll('#orderItems tr:not(:first-child)'); // Exclude the header row
        rows.forEach(function(row) {
            var quantity = parseInt(row.children[2].textContent);
            var price = parseFloat(row.children[3].textContent);
            totalAmount += quantity * price;
        });
        document.getElementById('totalAmount').textContent = totalAmount.toFixed(2); // Display total amount with 2 decimal places
    }

    // Adding event listener to the X buttons
    document.addEventListener('click', function(event) {
        if (event.target && event.target.className == 'btn btn-danger btn-sm') {
            // Remove the closest <tr> element when the X button is clicked
            event.target.closest('tr').remove();
            // Update total amount after removing the product
            updateTotalAmount();
        }
    });
</script>







    

            

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

    

</body>

</html>
