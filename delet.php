<?php
session_start();
if (!isset($_SESSION['email'])) header("location:login.php");

require "db.php";


if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    
    $delete_query = "DELETE FROM produit WHERE id = ?";
    $stmt = $db->prepare($delete_query);
    $stmt->bind_param("i", $product_id);
    
    if ($stmt->execute()) {
        header("Location: product.php");
    } else {
        echo "<div class='alert alert-danger'>Error deleting product!</div>";
    }
}
?>
