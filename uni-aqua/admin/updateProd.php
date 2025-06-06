<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include ("conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatedata'])) { // Changed 'submit' to 'updatedata'
    //Getting user input
    $jarsID = mysqli_real_escape_string($conn, $_POST['id']);
    $jarsName = mysqli_real_escape_string($conn, $_POST['updateProdName']);
    $jarsDescription = mysqli_real_escape_string($conn, $_POST['updateDescrip']);
    $jarsPrice = mysqli_real_escape_string($conn, $_POST['updatePrice']);

    // Check if a new image file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $img_name = $_FILES['image']['name'];
        $img_tmp = $_FILES['image']['tmp_name'];
        $upload_directory = 'uploadImage/'; 
        $img_des = $upload_directory . $img_name;

        if (move_uploaded_file($img_tmp, $img_des)) {
            // New image file uploaded, update database with the new image path
            $sql = "UPDATE ua_jars SET jars_name='$jarsName', jars_description='$jarsDescription', image_name='$img_des', jars_price='$jarsPrice' WHERE jars_id='$jarsID'";
        } else {
            echo "Failed to move uploaded file.";
            exit();
        }
    } else {
        // No new image file uploaded, update database without changing the image path
        $sql = "UPDATE ua_jars SET jars_name='$jarsName', jars_description='$jarsDescription', jars_price='$jarsPrice' WHERE jars_id='$jarsID'";
    }

    // Execute the SQL query
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
        echo '<script type="text/javascript">';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo 'Swal.fire({';
        echo 'title: "SUCCESSFULLY UPDATED!",';
        echo 'icon: "info"';
        echo '}).then(() => {window.location.href="../admin/index.php";});';
        echo '});';
        echo '</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

