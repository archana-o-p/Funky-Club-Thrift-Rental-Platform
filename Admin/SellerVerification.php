<?php
include('../Assets/connection/connection.php');
$sellerid='';
?>

<?php
if(isset($_GET["did"])) {
  $AcceptQry="UPDATE tbl_seller SET seller_status=1 WHERE seller_id=".$_GET["did"];
  if($con->query($AcceptQry)) {
    ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Seller Accepted',
        text: 'Seller has been successfully verified.',
        confirmButtonColor: '#16a34a'
      }).then(() => {
        window.location="SellerVerification.php";
      });
    </script>
    <?php
  }
}

if(isset($_GET["eid"])) {
  $rejectQry="UPDATE tbl_seller SET seller_status=2 WHERE seller_id=".$_GET["eid"];
  if($con->query($rejectQry)) {
    ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Seller Rejected',
        text: 'Seller has been rejected.',
        confirmButtonColor: '#dc2626'
      }).then(() => {
        window.location="SellerVerification.php";
      });
    </script>
    <?php
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Seller Verification | Admin Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
  margin: 0;
  padding: 40px;
  color: #fff;
}

h2 {
  text-align: center;
  font-weight: 600;
  letter-spacing: 1px;
  color: #fff;
  margin-bottom: 30px;
}

h3 {
  margin: 40px 0 15px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: #a5b4fc;
}

.table-container {
  background: rgba(255, 255, 255, 0.07);
  border-radius: 12px;
  overflow-x: auto;
  box-shadow: 0 4px 20px rgba(0,0,0,0.3);
  margin-bottom: 40px;
}

table {
  width: 100%;
  border-collapse: collapse;
  min-width: 900px;
}

th, td {
  padding: 12px 15px;
  text-align: center;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  color: #f1f1f1;
}

th {
  background: rgba(255,255,255,0.12);
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 0.3px;
}

tr:hover {
  background: rgba(255,255,255,0.1);
  transition: 0.3s;
}

td img {
  width: 60px;
  height: 60px;
  border-radius: 8px;
  object-fit: cover;
}

.status-badge {
  padding: 6px 12px;
  border-radius: 20px;
  font-weight: 500;
  font-size: 13px;
}

.status-new {
  background-color: #facc15;
  color: #000;
}

.status-verified {
  background-color: #16a34a;
  color: #fff;
}

.status-rejected {
  background-color: #dc2626;
  color: #fff;
}

a.action-btn {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  padding: 6px 12px;
  border-radius: 6px;
  font-size: 13px;
  color: #fff;
  font-weight: 500;
  text-decoration: none;
  transition: all 0.3s ease;
}

a.accept {
  background-color: #16a34a;
}

a.reject {
  background-color: #dc2626;
}

a.accept:hover {
  background-color: #15803d;
  box-shadow: 0 4px 10px rgba(22,163,74,0.4);
}

a.reject:hover {
  background-color: #b91c1c;
  box-shadow: 0 4px 10px rgba(220,38,38,0.4);
}

@media (max-width: 768px) {
  body {
    padding: 20px;
  }
  table {
    font-size: 12px;
  }
}
</style>
</head>

<body>
<h2><i class="fa-solid fa-user-shield"></i> Seller Verification Dashboard</h2>

<h3><i class="fa-solid fa-clock-rotate-left"></i> New Sellers</h3>
<div class="table-container">
  <table>
    <tr>
      <th>SI NO</th>
      <th>Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Address</th>
      <th>Photo</th>
      <th>Proof</th>
      <th>District</th>
      <th>Place</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
<?php
$i = 0;
$qry = "SELECT u.*, d.district_name, p.place_name
        FROM tbl_seller u
        INNER JOIN tbl_place p ON u.place_id = p.place_id
        INNER JOIN tbl_district d ON p.district_id = d.district_id WHERE seller_status=0";
$result = $con->query($qry);
while ($row = $result->fetch_assoc()) {
  $i++;
?>
<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo $row["seller_name"]; ?></td>
  <td><?php echo $row["seller_email"]; ?></td>
  <td><?php echo $row["seller_contact"]; ?></td>
  <td><?php echo $row["seller_address"]; ?></td>
  <td><img src="../Assets/Files/<?php echo $row["seller_photo"]; ?>" alt="Photo"></td>
  <td><img src="../Assets/Files/<?php echo $row["seller_proof"]; ?>" alt="Proof"></td>
  <td><?php echo $row["district_name"]; ?></td>
  <td><?php echo $row["place_name"]; ?></td>
  <td><span class="status-badge status-new">Pending</span></td>
  <td>
    <a href="SellerVerification.php?did=<?php echo $row["seller_id"]; ?>" class="action-btn accept"><i class="fa-solid fa-check"></i> Accept</a>
    <a href="SellerVerification.php?eid=<?php echo $row["seller_id"]; ?>" class="action-btn reject"><i class="fa-solid fa-xmark"></i> Reject</a>
  </td>
</tr>
<?php } ?>
  </table>
</div>

<h3><i class="fa-solid fa-circle-check"></i> Verified Sellers</h3>
<div class="table-container">
  <table>
    <tr>
      <th>SI NO</th>
      <th>Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Address</th>
      <th>Photo</th>
      <th>Proof</th>
      <th>District</th>
      <th>Place</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
<?php
$i = 0;
$qry = "SELECT u.*, d.district_name, p.place_name
        FROM tbl_seller u
        INNER JOIN tbl_place p ON u.place_id = p.place_id
        INNER JOIN tbl_district d ON p.district_id = d.district_id WHERE seller_status=1";
$result = $con->query($qry);
while ($row = $result->fetch_assoc()) {
  $i++;
?>
<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo $row["seller_name"]; ?></td>
  <td><?php echo $row["seller_email"]; ?></td>
  <td><?php echo $row["seller_contact"]; ?></td>
  <td><?php echo $row["seller_address"]; ?></td>
  <td><img src="../Assets/Files/<?php echo $row["seller_photo"]; ?>" alt="Photo"></td>
  <td><img src="../Assets/Files/<?php echo $row["seller_proof"]; ?>" alt="Proof"></td>
  <td><?php echo $row["district_name"]; ?></td>
  <td><?php echo $row["place_name"]; ?></td>
  <td><span class="status-badge status-verified">Verified</span></td>
  <td><a href="SellerVerification.php?eid=<?php echo $row["seller_id"]; ?>" class="action-btn reject"><i class="fa-solid fa-ban"></i> Reject</a></td>
</tr>
<?php } ?>
  </table>
</div>

<h3><i class="fa-solid fa-circle-xmark"></i> Rejected Sellers</h3>
<div class="table-container">
  <table>
    <tr>
      <th>SI NO</th>
      <th>Name</th>
      <th>Email</th>
      <th>Contact</th>
      <th>Address</th>
      <th>Photo</th>
      <th>Proof</th>
      <th>District</th>
      <th>Place</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
<?php
$i = 0;
$qry = "SELECT u.*, d.district_name, p.place_name
        FROM tbl_seller u
        INNER JOIN tbl_place p ON u.place_id = p.place_id
        INNER JOIN tbl_district d ON p.district_id = d.district_id WHERE seller_status=2";
$result = $con->query($qry);
while ($row = $result->fetch_assoc()) {
  $i++;
?>
<tr>
  <td><?php echo $i; ?></td>
  <td><?php echo $row["seller_name"]; ?></td>
  <td><?php echo $row["seller_email"]; ?></td>
  <td><?php echo $row["seller_contact"]; ?></td>
  <td><?php echo $row["seller_address"]; ?></td>
  <td><img src="../Assets/Files/<?php echo $row["seller_photo"]; ?>" alt="Photo"></td>
  <td><img src="../Assets/Files/<?php echo $row["seller_proof"]; ?>" alt="Proof"></td>
  <td><?php echo $row["district_name"]; ?></td>
  <td><?php echo $row["place_name"]; ?></td>
  <td><span class="status-badge status-rejected">Rejected</span></td>
  <td><a href="SellerVerification.php?did=<?php echo $row["seller_id"]; ?>" class="action-btn accept"><i class="fa-solid fa-rotate-right"></i> Re-Accept</a></td>
</tr>
<?php } ?>
  </table>
</div>

</body>
</html>
