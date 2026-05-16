<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Funky Club</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>
<nav class="navbar navbar-expand-lg py-3">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">
      <img src="../Assets/Templates/Main/images/fun.jpg" alt="Logo" width="120" height="50" style="object-fit: contain;">
    </a>

    <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="UserHomePage.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="ViewProducts.php">Rentals</a></li>
        <li class="nav-item"><a class="nav-link" href="Rent.php">Rent</a></li>
        <li class="nav-item"><a class="nav-link" href="AddRentproducts.php">Add Rent Products</a></li>
        <li class="nav-item"><a class="nav-link" href="MyOrders.php">My Orders</a></li>
        <li class="nav-item"><a class="nav-link" href="ViewRentBooking.php">View Rent Booking</a></li>
        <li class="nav-item"><a class="nav-link" href="Complaint.php">Complaint</a></li>
      </ul>
    </div>
  </div>
</nav>
