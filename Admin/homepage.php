<?php
include('../Assets/connection/connection.php');
session_start();
if(!isset($_SESSION['aname'])) {
    header("location:../Login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard | Premium Panel</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- FontAwesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  * {
    font-family: 'Inter', sans-serif;
  }
  body {
    background: linear-gradient(135deg, #f1f5f9, #e0e7ff);
    margin: 0;
    overflow-x: hidden;
  }

  /* Sidebar */
  .sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 270px;
    height: 100vh;
    background: rgba(30, 41, 59, 0.95);
    backdrop-filter: blur(12px);
    color: #fff;
    display: flex;
    flex-direction: column;
    padding-top: 30px;
    box-shadow: 4px 0 20px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
  }

  .sidebar h4 {
    text-align: center;
    margin-bottom: 40px;
    font-weight: 700;
    letter-spacing: 0.5px;
  }

  .sidebar a {
    text-decoration: none;
    color: #cbd5e1;
    padding: 12px 30px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: 0.3s;
    border-left: 4px solid transparent;
  }

  .sidebar a:hover, .sidebar a.active {
    color: #fff;
    background: rgba(255, 255, 255, 0.08);
    border-left: 4px solid #60a5fa;
  }

  .sidebar i {
    font-size: 1.1rem;
  }

  /* Topbar */
  .topbar {
    margin-left: 270px;
    background: #ffffffcc;
    backdrop-filter: blur(8px);
    padding: 15px 30px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
  }

  .topbar h5 {
    margin: 0;
    color: #1e3a8a;
    font-weight: 700;
  }

  .welcome {
    font-weight: 500;
  }

  /* Content */
  .content {
    margin-left: 270px;
    padding: 40px;
  }

  .dashboard-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
  }

  .card {
    border: none;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.9);
    box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05);
    padding: 25px;
    transition: all 0.3s ease;
    text-align: center;
  }

  .card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  }

  .card i {
    font-size: 2rem;
    margin-bottom: 10px;
  }

  .card h6 {
    font-weight: 700;
    color: #1e3a8a;
  }

  .footer {
    text-align: center;
    color: #6b7280;
    margin-top: 50px;
    font-size: 0.9rem;
  }

  @media (max-width: 768px) {
    .sidebar {
      width: 230px;
    }
    .topbar, .content {
      margin-left: 230px;
    }
  }
  
</style>
</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h4><i class="fa-solid fa-crown text-warning"></i> Admin Panel</h4>
    <a href="adminReg.php" class="active"><i class="fa fa-user"></i> My Profile</a>
    <a href="Color.php"><i class="fa fa-palette"></i> Color</a>
    <a href="District.php"><i class="fa fa-city"></i> District</a>
    <a href="Material.php"><i class="fa fa-layer-group"></i> Material</a>
    <a href="place.php"><i class="fa fa-map-marker-alt"></i> Place</a>
    <a href="Size.php"><i class="fa fa-ruler-combined"></i> Size</a>
    <a href="Subcategory.php"><i class="fa fa-tags"></i> Subcategory</a>
     <a href="category.php"><i class="fa fa-tags"></i> Category</a>
    <a href="userList.php"><i class="fa fa-users"></i> Users</a>
    <a href="ViewComplaint.php"><i class="fa fa-comments"></i> Complaints</a>
   
    <a href="SellerVerification.php"><i class="fa fa-clipboard-check"></i> Seller Verification</a>
    <a href="Logout.php"><i class="fa fa-right-from-bracket"></i> Logout</a>
  </div>

  <!-- Topbar -->
  <div class="topbar">
    <h5><i class="fa-solid fa-gauge-high"></i> Dashboard</h5>
    <div class="welcome">
      Welcome, <span class="text-primary fw-bold"><?php echo $_SESSION['aname']; ?></span>
    </div>
  </div>

  <!-- Content -->
  <div class="content">
    <div class="dashboard-cards">
      <div class="card"  onclick="window.location.href='userList.php'">
        <i class="fa fa-users text-primary"></i>
        <h6>Manage Users</h6>
        <p class="text-muted small mb-0">View, edit and manage registered users efficiently.</p>
      </div>
      <div class="card"  onclick="window.location.href='Subcategory.php'">
        <i class="fa fa-tags text-success"></i>
        <h6>Subcategories</h6>
        <p class="text-muted small mb-0">Create and maintain product categories easily.</p>
      </div>
      <div class="card"  onclick="window.location.href='ViewComplaint.php'">
        <i class="fa fa-comments text-danger"></i>
        <h6>Complaints</h6>
        <p class="text-muted small mb-0">Check, review, and respond to user complaints quickly.</p>
      </div>
      <div class="card"  onclick="window.location.href='place.php'">
        <i class="fa fa-city text-warning"></i>
        <h6>Districts & Places</h6>
        <p class="text-muted small mb-0">Maintain detailed region and place information.</p>
      </div>
      <div class="card" >
        <i class="fa fa-palette text-info"></i>
        <h6>Colors & Materials</h6>
        <p class="text-muted small mb-0">Define product attributes for customization.</p>
      </div>
    </div>

    <div class="footer">
      &copy; <?php echo date("Y"); ?> FUNKY CLUB Admin | Designed with ❤️ for performance and elegance.
    </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
