<?php
include('../Assets/connection/connection.php');
session_start();

// ✅ Delete complaint
if(isset($_GET["did"]))
{
	$delQry="DELETE FROM tbl_complaint WHERE complaint_id=".$_GET["did"];
	if($con->query($delQry))
    {
?>
    <script>	
        alert("Complaint successfully deleted");
        window.location="ViewComplaint.php";
    </script>
<?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Admin - View Complaints</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #343a40, #1f1f1f);
  margin: 0;
  padding: 40px 0;
  color: #333;
}

.container {
  max-width: 1200px;
  margin: auto;
  background: #ffffff;
  padding: 40px 50px;
  border-radius: 16px;
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
}

h1 {
  text-align: center;
  color: #000000;
  font-size: 28px;
  margin-bottom: 30px;
  letter-spacing: 1px;
  text-transform: uppercase;
}

/* Table Styles */
table {
  width: 100%;
  border-collapse: collapse;
  border-radius: 12px;
  overflow: hidden;
  background-color: #fff;
}

th, td {
  text-align: center;
  padding: 14px 16px;
  border-bottom: 1px solid #e5e7eb;
  font-size: 15px;
}

th {
  background: linear-gradient(135deg, #000000, #2c2c2c);
  color: #fff;
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 0.5px;
}

tr:hover td {
  background-color: #f8fafc;
  transition: 0.3s;
}

.reply {
  color: #16a34a;
  font-weight: 500;
}

.pending {
  color: #ef4444;
  font-weight: 500;
}

a.delete-btn {
  color: #dc2626;
  font-weight: 500;
  text-decoration: none;
  padding: 6px 12px;
  border-radius: 6px;
  border: 1px solid #dc2626;
  transition: all 0.2s ease;
}

a.delete-btn:hover {
  background: #dc2626;
  color: #fff;
}

@media (max-width: 768px) {
  .container {
    padding: 20px;
  }

  table {
    font-size: 13px;
  }

  th, td {
    padding: 10px;
  }

  h1 {
    font-size: 22px;
  }
}
</style>
</head>

<body>
<div class="container">
  <h1>All User Complaints</h1>
  <form id="form1" name="form1" method="post" action="">
    <table>
      <tr>
        <th>SI No</th>
        <th>User Name</th>
        <th>User Email</th>
        <th>Product</th>
        <th>Seller</th>
        <th>Content</th>
        <th>Date</th>
        <th>Status / Reply</th>
        <th>Action</th>
      </tr>
      <?php
      $i=0;
      $sel = "SELECT * FROM tbl_complaint c 
              INNER JOIN tbl_user u ON u.user_id = c.user_id
              LEFT JOIN tbl_product p ON c.product_id = p.product_id
              LEFT JOIN tbl_seller s ON p.seller_id = s.seller_id
              ORDER BY c.complaint_date DESC";
              
      $result = $con->query($sel);
      while ($row = $result->fetch_assoc()) {
        $i++;
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row["user_name"]; ?></td>
        <td><?php echo $row["user_email"]; ?></td>
        <td><?php echo $row["product_name"]; ?></td>
        <td><?php echo $row["seller_name"]; ?></td>
        <td><?php echo $row["complaint_content"]; ?></td>
        <td><?php echo $row["complaint_date"]; ?></td>
        <td>
          <?php 
          if ($row['complaint_status'] == 1) {
              echo "<span class='reply'>Replied:</span> " . $row["complaint_reply"];
          } else {
              echo "<span class='pending'>Pending</span>";
          }
          ?>
        </td>
        <td>
          <a href="ViewComplaint.php?did=<?php echo $row['complaint_id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this complaint?');">Delete</a>
        </td>
      </tr>
      <?php
      }
      ?>
    </table>
  </form>
</div>
</body>
</html>
      