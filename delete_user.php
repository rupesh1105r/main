<?php
session_start();
if (!isset($_SESSION['valid']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include("php/config.php");

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($con, $_GET['id']);

    // Delete user from database
    $delete_query = "DELETE FROM users WHERE id='$id'";
    if (mysqli_query($con, $delete_query)) {
        header("Location: admin_page.php");
        exit();
    } else {
        echo "Error deleting user: " . mysqli_error($con);
    }
} else {
    header("Location: admin_page.php");
    exit();
}
?>
