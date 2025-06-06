<?php
include("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $contactnum = $_POST['contactnum'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); 

    $sql = "INSERT INTO ua_users (user_fullname, user_contactnumber, user_address, user_email, user_password, user_type)
            VALUES ('$fullname', '$contactnum', '$address', '$email', '$password', 'regular')";

    if ($conn->query($sql) === TRUE) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
        echo '<script type="text/javascript">';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo 'Swal.fire({';
        echo 'title: "YOU ARE NOW REGISTERED!",';
        echo 'icon: "success"';
        echo '}).then(() => {window.location.href="../uni-aqua/login.php";});';
        echo '});';
        echo '</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
