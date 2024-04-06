<?php
require_once("include/connection.php");

// Check if the ID parameter is set in the URL
if(isset($_GET['id'])) {
    // Get the ID from the URL
    $admin_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Define the ID of the admin to be protected
    $protected_admin_id = '2'; // Replace 'ID_OF_PROTECTED_ADMIN' with the actual ID

    // Check if the ID matches the ID of the protected admin
    if($admin_id == $protected_admin_id) {
        // If trying to delete the protected admin, show an error message
        echo "<script>alert('You cannot delete this admin.'); window.location='view_admin.php';</script>";
        exit(); // Stop further execution
    }
    
    // Proceed with deletion for other admins
    $query = "DELETE FROM admin_login WHERE id='$admin_id'";
    if(mysqli_query($conn, $query)) {
        echo "<script>alert('Admin deleted successfully.'); window.location='view_admin.php';</script>";
        exit(); // Stop further execution
    } else {
        echo "<script>alert('Error deleting admin.'); window.location='view_admin.php';</script>";
        exit(); // Stop further execution
    }
} else {
    // If ID parameter is not set in the URL, redirect back to view_admin.php
    echo "<script>window.location='view_admin.php';</script>";
    exit(); // Stop further execution
}
?>
