<?php
    include("conn.php");
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        //Getting user input
        $inputProduct = mysqli_real_escape_string($conn, $_POST['inputName']);
        $inputDescription = mysqli_real_escape_string($conn, $_POST['inputDescrip']);
        $inputPrice = mysqli_real_escape_string($conn, $_POST['inputPrice']);

        // File upload handling
        $img_name = $_FILES['image']['name'];
        $img_tmp = $_FILES['image']['tmp_name'];
        $upload_directory = 'uploadImage/';
        $img_des = $upload_directory . $img_name;
        if (move_uploaded_file($img_tmp, $img_des)) {
            // SQL query for inserting data
            $sql = "INSERT INTO `ua_jars` (`jars_name`, `jars_description`, `image_name`, `jars_price`) VALUES 
            ('$inputProduct', '$inputDescription', '$img_des', '$inputPrice')";
            $query = mysqli_query($conn, $sql);

            if ($query) {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
                echo '<script type="text/javascript">';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo 'Swal.fire({';
                echo 'title: "SUCCESSFULLY INSERTED!",';
                echo 'icon: "success"';
                echo '}).then(() => {window.location.href="../admin/index.php";});';
                echo '});';
                echo '</script>';
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to upload image."; 
        }    
    }
?>
