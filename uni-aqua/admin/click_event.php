<?php 
session_start();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

$(document).ready(function() {
    $('#dashboard_click').on('click', function(e) {
        e.preventDefault(); // Prevent default navigation behavior
        $.ajax({
                url: 'index.php', 
                method: 'GET', 
                success: function(data) {
                    $('#content').html(data);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); 
                }
            });
    });

    $('#pricing_click').on('click', function(e) {
        e.preventDefault(); // Prevent default navigation behavior
        $.ajax({
                url:'pricing.php',
                method:'GET',
                success: function(data) {
                    $('#content').html(data);
                    initializeDataTable();

                    // Simulate click on the pricing link
                    $('#pricing_click').click();
                },
                error:function (xhr, status,error){
                    console.error(xhr.responseText);
                }
            });
    });

    $('#report_click').on('click', function(e) {
        e.preventDefault(); // Prevent default navigation behavior
        $.ajax({
                url:'salesreport.php',
                method:'GET',
                success: function(data) {   
                    $('#content').html(data);
                    initializeDataTable();
                },
                error:function (xhr, status,error){
                    console.error(xhr.responseText);
                }
            });
    });

    $('#staff_click').on('click', function(e) {
        e.preventDefault(); // Prevent default navigation behavior
        $.ajax({
                url:'staff_registration.php',
                method:'GET',
                success: function(data) {   
                    $('#content').html(data);
                    initializeDataTable();
                },
                error:function (xhr, status,error){
                    console.error(xhr.responseText);
                }
            });
    });



        // Function to initialize DataTable
        function initializeDataTable() {
            if ($('#content').find('#tbl').length > 0) {
                new DataTable('#tbl');
            }
        }
    });
</script>

