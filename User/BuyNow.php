<?php


// Check if product ID is passed
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    // Redirect directly to checkout with product ID
    header("Location: Checkout.php?pid=" . $pid);
    exit();
} else {
    echo "<script>alert('Invalid product'); window.location='ViewProduct.php';</script>";
    exit();
}
?>