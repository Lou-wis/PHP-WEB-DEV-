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

            <!--table for sales-->
        <div class="container-fluid">
            <div class="container-fluid">     
                <div class="card">
                <div class="card-body ">    
                <div class="row">
        <div class="col-md-6">
            <h5 class="card-title fw-semibold mb-4 d-inline">SALES</h5>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#printModal">Print</button>
        </div>
    </div>

                <!------------- MODAL START ----------------->
                <div class="modal fade" id="printModal" tabindex="-1" aria-labelledby="printModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="printModalLabel">Print Table</h5>
                  
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Place the print option dropdown and inputs here -->
                        <label for="printOption">Select:</label>
                        <select id="printOption" class="form-control mb-3">
                        <option value="date">By Day</option>
                        <option value="month">By Month</option>
                        </select>
                        <div id="dateInput" style="display: none;">
                        <label for="printDate">Select Date:</label>
                        <input type="date" id="printDate" class="form-control mb-3">
                        </div>
                        <div id="monthInput" style="display: none;">
                        <label for="printMonth">Select Month:</label>
                        <input type="month" id="printMonth" class="form-control mb-3">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Print button -->
                        <button id="printButton" class="btn btn-primary">Print</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>
                <!------------- MODAL END ----------------->


                    <!--<button type="button" class="btn btn-secondary float-end" data-toggle="modal" data-target="#myModal">Add Sales</button>-->
                        </div>
                    <div class="card-body" style='overflow-x:auto; margin-top:-30px' >
                        <table id="tbl" class="table table-striped table-bordered" style="width:100%" table-border="1">

                            <thead>
                            <tr>
                                <th hidden>Order ID</th>
                                <th>payment ID</th>
                                <th hidden>Payer ID</th>
                                <th>Email</th>                               
                                <th>Amount</th>
                                <th hidden>Currency</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>

                            </thead>

                            <tbody>

                            <?php
                            include("conn.php");
                    
                            $query = "SELECT * FROM `payment`";
                            $query_run = mysqli_query($conn, $query);

                                if ($query_run) {
                                    foreach ($query_run as $row) {
                                    ?>

                            <tr>
                                <td hidden><?php echo $row['id']; ?></td>
                                <td><?php echo $row['payment_id']; ?></td>
                                <td hidden><?php echo $row['payer_id']; ?></td>
                                <td><?php echo $row['payer_email']; ?></td>                               
                                <td><?php echo $row['amount']; ?></td>
                                <td hidden><?php echo $row['currency']; ?></td>
                                <td><?php echo $row['payment_status']; ?></td>
                                <td><?php echo $row['date']; ?></td>
                                <!--<td text-align ="center">
                                    <button class="btn btn-secondary btn-sm updateBtn" type="button" data-toggle="modal" data-target="#myModal1"><i class="fa-solid fa-pen-to-square"></i></button>
                                    <button class="btn btn-danger btn-sm delBtn" type="button" data-toggle="modal" data-target="#myModal2"><i class="fa-solid fa-trash"></i></button>
                                </td>-->
                            </tr>
                                <?php
                            }
                        } else {
                            echo "No Record Found";
                        }
                        ?>
                            </tbody>
                    </div>
                        </table>
                </div>
            </div>
        </div>
        <!--table for sales-->           

            
            <?php
            include("footer.php");
            ?>

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
 
 <script>
    // Initialize total quantity and total amount variables
    var totalQuantity = 0;
    var totalAmount = 0;

    // Function to toggle visibility of date or month input based on user selection
    function toggleDateOrMonthInput() {
        var selectedOption = document.getElementById("printOption").value;
        var dateInput = document.getElementById("dateInput");
        var monthInput = document.getElementById("monthInput");

        if (selectedOption === "date") {
            dateInput.style.display = "block";
            monthInput.style.display = "none";
        } else if (selectedOption === "month") {
            dateInput.style.display = "none";
            monthInput.style.display = "block";
        }
    }

    // Add event listener to the print option dropdown to toggle date or month input
    document.getElementById("printOption").addEventListener("change", function() {
        toggleDateOrMonthInput();
    });

    // Initially call the toggle function to set the initial visibility
    toggleDateOrMonthInput();

    // Add event listener to the print button
    document.getElementById("printButton").addEventListener("click", function() {
        printTableWithDateOrMonthFilter();
    });

    // JavaScript function to print table content with date or month filter
    function printTableWithDateOrMonthFilter() {
        var selectedOption = document.getElementById("printOption").value;
        var selectedDate = document.getElementById("printDate").value;
        var selectedMonth = document.getElementById("printMonth").value;
        var tableRows = document.querySelectorAll("#tbl tbody tr");
        var printContents = "<table><thead><tr>";

        // Construct table header with only the columns you want to print
        document.querySelectorAll("#tbl thead th").forEach(function(headerCell) {
            var columnText = headerCell.innerText.trim();
            if (columnText !== "Action" && columnText !== "Order ID") { // Exclude the "Action" and "Order ID" columns
                printContents += "<th>" + columnText + "</th>";
            }
        });

        printContents += "</tr></thead><tbody>";

        tableRows.forEach(function(row) {
            var rowDate = row.cells[7].textContent.trim().split(' ')[0]; // Splitting to get only the date part
            if (selectedOption === "date") {
                if (rowDate === selectedDate) {
                    printContents += "<tr>";
                    // Construct table row with only the columns you want to print
                    Array.from(row.cells).forEach(function(cell, index) {
                        if (index !== 0 && index !== 8) { // Exclude the first column (Order ID) and the "Action" column
                            printContents += "<td>" + cell.innerHTML + "</td>";
                        }
                    });
                    printContents += "</tr>";
                    // Update total quantity and total amount for each row
                    totalQuantity += parseInt(row.cells[6].textContent.trim());
                    totalAmount += parseFloat(row.cells[7].textContent.trim());
                }
            } else if (selectedOption === "month") {
                if (rowDate.startsWith(selectedMonth)) {
                    printContents += "<tr>";
                    // Construct table row with only the columns you want to print
                    Array.from(row.cells).forEach(function(cell, index) {
                        if (index !== 0 && index !== 11) { // Exclude the first column (Order ID) and the "Action" column
                            printContents += "<td>" + cell.innerHTML + "</td>";
                        }
                    });
                    printContents += "</tr>";
                    // Update total quantity and total amount for each row
                    totalQuantity += parseInt(row.cells[6].textContent.trim());
                    totalAmount += parseFloat(row.cells[7].textContent.trim());
                }
            }
        });

        printContents += "</tbody></table>";

        // Open a new window and write the table content
        var selectedOption = document.getElementById("printOption").value;
        var printDate = "";
        if (selectedOption === "date") {
            printDate = document.getElementById("printDate").value;
        } else if (selectedOption === "month") {
            // Convert numeric month value to letter format
            var numericMonth = document.getElementById("printMonth").value.split("-")[1];
            var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            printDate = monthNames[parseInt(numericMonth) - 1]; // Subtracting 1 since array indexing starts from 0
        }

        var printWindow = window.open("", "_blank");
        printWindow.document.write("<html><head><title>Print</title></head><body>");
        printWindow.document.write(printContents);
        printWindow.document.write("<br><p><strong>" + (selectedOption === "date" ? "Date" : "For the Month of") + ": </strong>" + printDate + "</p>");
        
        printWindow.document.write("</body></html>");


        // Wait for the print dialog to close
        printWindow.addEventListener("afterprint", function(event) {
            printWindow.close(); // Close the print window
        });

        // Initiate printing in the new window
        printWindow.print();
    }
</script>



</div>
</body>

</html>
