<?php
include('../Assets/Connection/Connection.php');
session_start();
include('Head.php');

// Ensure only logged-in user can access
if (!isset($_SESSION['uid'])) {
  header("Location: ../Guest/Login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>My Rent Bookings</title>
  <style>
    /* ========= RESET ========= */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    /* ========= BODY ========= */
    body {
      background: #848b91ff;
      min-height: 100vh;
      padding: 40px 20px;
      color: #ddd;
    }

    /* ========= MAIN CONTAINER ========= */
    .rentbookings-main-container {
      max-width: 1200px;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      animation: rentbookings-fade-in 0.7s ease;
    }

    @keyframes rentbookings-fade-in {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* ========= HEADER ========= */
    .rentbookings-header {
      background: linear-gradient(135deg, #000000ff, #1c1c1cff);
      color: #fff;
      text-align: center;
      padding: 25px 20px;
      font-size: 1.8rem;
      font-weight: 600;
      letter-spacing: 1px;
    }

    /* ========= TABLE WRAPPER ========= */
    .rentbookings-table-wrapper {
      overflow-x: auto;
      padding: 20px;
    }

    /* ========= TABLE ========= */
    .rentbookings-table {
      width: 100%;
      border-collapse: collapse;
      text-align: center;
      background: #fff;
    }

    .rentbookings-table-header th {
      background: linear-gradient(135deg, #000000ff, #2b2b2bff);
      color: white;
      font-weight: 600;
      padding: 16px 12px;
      text-transform: uppercase;
      letter-spacing: 0.8px;
      font-size: 14px;
    }

    .rentbookings-table-row:nth-child(even) {
      background-color: #f8f9fa;
    }

    .rentbookings-table-row:hover {
      background-color: #f1f3ff;
      transition: 0.3s;
    }

    .rentbookings-table-cell {
      padding: 14px 12px;
      border-bottom: 1px solid #e8e8e8;
      color: #333;
      font-size: 14px;
    }

    /* ========= PRODUCT IMAGE ========= */
    .rentbookings-product-image {
      width: 70px;
      height: 70px;
      border-radius: 8px;
      object-fit: cover;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
    }

    /* ========= STATUS BADGES ========= */
    .rentbookings-status {
      padding: 6px 12px;
      border-radius: 20px;
      font-weight: 600;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .rentbookings-status-accepted {
      background: #d4edda;
      color: #155724;
    }

    .rentbookings-status-rejected {
      background: #f8d7da;
      color: #721c24;
    }

    .rentbookings-status-pending {
      background: #fff3cd;
      color: #856404;
    }

    /* ========= PAYMENT BUTTON ========= */
    .rentbookings-payment-button {
      display: inline-block;
      background: #28a745;
      color: white;
      text-decoration: none;
      padding: 10px 18px;
      border-radius: 8px;
      font-weight: 500;
      font-size: 14px;
      margin-top: 8px;
      transition: all 0.3s ease;
    }

    .rentbookings-payment-button:hover {
      background: #218838;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
    }

    /* ========= RESPONSIVE CARDS ========= */
    @media (max-width: 768px) {

      .rentbookings-table,
      .rentbookings-table-header,
      .rentbookings-table-header th,
      .rentbookings-table-row,
      .rentbookings-table-cell {
        display: block;
      }

      .rentbookings-table-header {
        display: none;
      }

      .rentbookings-table-row {
        margin-bottom: 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        padding: 15px;
      }

      .rentbookings-table-cell {
        text-align: right;
        padding: 10px 0;
        border: none;
        position: relative;
        padding-left: 50%;
      }

      .rentbookings-table-cell::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        width: 45%;
        text-align: left;
        font-weight: 600;
        color: #000000ff;
      }

      .rentbookings-product-image {
        width: 100%;
        max-width: 200px;
        height: auto;
        display: block;
        margin: 10px auto;
      }

      .rentbookings-payment-button {
        width: 100%;
        text-align: center;
      }
    }
  </style>
</head>

<body>

  <div class="rentbookings-main-container">
    <div class="rentbookings-header">My Rent Bookings</div>

    <div class="rentbookings-table-wrapper">
      <table class="rentbookings-table">
        <thead class="rentbookings-table-header">
          <tr>
            <th>SI NO</th>
            <th>Product Name</th>
            <th>Gender</th>
            <th>Photo</th>
            <th>Color</th>
            <th>Size</th>
            <th>Price/Day</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Total</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          $sel = "SELECT * 
                        FROM tbl_rentproducts p
                        INNER JOIN tbl_rentproductbooking m ON m.rentproduct_id = p.rentproduct_id
                        INNER JOIN tbl_size sz ON sz.size_id = p.size_id
                        INNER JOIN tbl_color co ON co.color_id = p.color_id
                        INNER JOIN tbl_gender g ON g.gender_id = p.gender_id
                        WHERE m.user_id = '" . $_SESSION['uid'] . "'
                        ORDER BY m.rentproductbooking_id DESC";
          $result = $con->query($sel);

          if ($result->num_rows == 0) {
            echo "<tr><td colspan='11' style='padding: 40px; font-size: 18px; color: #666;'>No rent bookings found</td></tr>";
          }

          while ($row = $result->fetch_assoc()) {
            $i++;
            ?>
            <tr class="rentbookings-table-row">
              <td class="rentbookings-table-cell" data-label="SI NO"><?php echo $i; ?></td>
              <td class="rentbookings-table-cell" data-label="Product Name">
                <?php echo htmlspecialchars($row["rentproduct_name"]); ?></td>
              <td class="rentbookings-table-cell" data-label="Gender"><?php echo htmlspecialchars($row["gender_name"]); ?>
              </td>
              <td class="rentbookings-table-cell" data-label="Photo">
                <img src="../Assets/files/Product/<?php echo htmlspecialchars($row["rentproduct_photo"]); ?>"
                  class="rentbookings-product-image" alt="Product">
              </td>
              <td class="rentbookings-table-cell" data-label="Color"><?php echo htmlspecialchars($row["color_name"]); ?>
              </td>
              <td class="rentbookings-table-cell" data-label="Size"><?php echo htmlspecialchars($row["size_name"]); ?>
              </td>
              <td class="rentbookings-table-cell" data-label="Price/Day">
                ₹<?php echo number_format($row["rentproduct_price"]); ?></td>
              <td class="rentbookings-table-cell" data-label="From Date">
                <?php echo date("d-m-Y", strtotime($row["rentproductbooking_fromdate"])); ?></td>
              <td class="rentbookings-table-cell" data-label="To Date">
                <?php echo date("d-m-Y", strtotime($row["rentproductbooking_todate"])); ?></td>
              <td class="rentbookings-table-cell" data-label="Total">
                ₹<?php echo number_format($row["rentproductbooking_amount"]); ?></td>
              <td class="rentbookings-table-cell" data-label="Status">
                <?php
                if ($row['rentproductbooking_status'] == 1) {
                  echo "<div class='rentbookings-status rentbookings-status-accepted'>Accepted</div>";
                  echo "<a href='RentPayment.php?bid=" . $row['rentproductbooking_id'] . "' class='rentbookings-payment-button'>Proceed to Payment</a>";
                } elseif ($row['rentproductbooking_status'] == 2) {
                  echo "<div class='rentbookings-status rentbookings-status-rejected'>Rejected</div>";
                } else {
                  echo "<div class='rentbookings-status rentbookings-status-pending'>Pending</div>";
                }
                ?>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php include('Foot.php'); ?>
</body>

</html>