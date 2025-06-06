<?php
include("conn.php");

session_start();

if(isset($_POST['ProdDeleteBtn'])){
    $id = $_POST['delete_id'];

    $query = "DELETE FROM ua_jars WHERE jars_ID='$id'";
    $query_run = mysqli_query($conn, $query); 

    if($query_run){
        $_SESSION['success1'] = "Deleted Successfully";
        $_SESSION['status_code'] = "success";

        // Echo the SweetAlert JavaScript code
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
        echo '<script type="text/javascript">';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo 'Swal.fire({';
        echo 'title: "SUCCESSFULLY DELETED!",';
        echo 'icon: "error"';
        echo '}).then(() => {window.location.href="../admin/index.php";});';
        echo '});';
        echo '</script>';
    }
    else{
        echo "Error: " . mysqli_error($conn); 
    }
}
?>
