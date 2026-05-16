<?php
include('../Assets/connection/connection.php');
session_start();
include('Head.php');
?>
<?php
// ✅ Reply handling
if (isset($_POST['btn_reply'])) {
    $reply = $_POST['txt_reply'];
    $cid = $_POST['hid_cid'];

    $upQry = "UPDATE tbl_complaint SET complaint_reply = '".$reply."', complaint_status = 1 WHERE complaint_id = '".$cid."'";
    if ($con->query($upQry)) {
        ?>
        <script>
            alert("Reply sent successfully");
            window.location = "ViewComplaint.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Seller Complaint Management</title>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

  body {
    font-family: 'Poppins', sans-serif;
    background-color: #4a4c4eff;
    margin: 0;
    padding: 40px 0;
  }

  .container {
    max-width: 1100px;
    background: #fff;
    margin: auto;
    padding: 40px 50px;
    border-radius: 16px;
    box-shadow: 0 4px 25px rgba(0,0,0,0.08);
  }

  h1 {
    text-align: center;
    color: #1f2937;
    font-size: 28px;
    margin-bottom: 35px;
  }

  /* Table Design */
  table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
  }

  th {
    background-color: #000;
    color: white;
    padding: 14px 16px;
    text-align: left;
    font-weight: 500;
    font-size: 15px;
  }

  td {
    background: #fff;
    color: #374151;
    padding: 14px 16px;
    border-bottom: 1px solid #e5e7eb;
    font-size: 15px;
    vertical-align: top;
  }

  tr:hover td {
    background-color: #f1f5f9;
    transition: 0.3s;
  }

  /* Reply form styling */
  .reply-form {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .reply-form input[type="text"] {
    flex: 1;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 15px;
    transition: all 0.3s ease;
  }

  .reply-form input[type="text"]:focus {
    border-color: #000;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0,0,0,0.15);
  }

  .reply-form input[type="submit"] {
    background: #000;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .reply-form input[type="submit"]:hover {
    background: #2c2a2a;
  }

  .replied {
    background: #e8f5e9;
    color: #16a34a;
    font-weight: 500;
    padding: 8px 12px;
    border-radius: 6px;
    display: inline-block;
  }

  /* Responsive */
  @media (max-width: 768px) {
    table, thead, tbody, th, td, tr {
      display: block;
    }
    th {
      display: none;
    }
    tr {
      margin-bottom: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 10px;
      background: #fff;
    }
    td {
      border: none;
      padding: 6px 10px;
    }
    td::before {
      content: attr(data-label);
      font-weight: 600;
      color: #000;
      display: block;
      margin-bottom: 4px;
    }
  }
</style>
</head>

<body>
  <div class="container">
    <h1>Seller Complaint Management</h1>

    <form method="post" action="">
      <table>
        <tr>
          <th>SI No</th>
          <th>Product</th>
          <th>User Name</th>
          <th>Complaint Title</th>
          <th>Complaint Content</th>
          <th>Date</th>
          <th>Reply / Action</th>
        </tr>

        <?php
        $i = 0;
        $sel = "SELECT * FROM tbl_complaint c
                INNER JOIN tbl_product p ON c.product_id = p.product_id
                INNER JOIN tbl_user u ON c.user_id = u.user_id
                WHERE p.seller_id = '".$_SESSION['sid']."'
                ORDER BY c.complaint_date DESC";

        $result = $con->query($sel);

        while ($row = $result->fetch_assoc()) {
            $i++;
        ?>
        <tr>
          <td data-label="SI No"><?php echo $i; ?></td>
          <td data-label="Product"><?php echo $row["product_name"]; ?></td>
          <td data-label="User Name"><?php echo $row["user_name"]; ?></td>
          <td data-label="Complaint Title"><?php echo $row["complaint_title"]; ?></td>
          <td data-label="Complaint Content"><?php echo $row["complaint_content"]; ?></td>
          <td data-label="Date"><?php echo $row["complaint_date"]; ?></td>
          <td data-label="Reply / Action">
            <?php 
            if ($row['complaint_status'] == 1) {
                echo '<span class="replied"><b>Replied:</b> ' . htmlspecialchars($row["complaint_reply"]) . '</span>';
            } else {
            ?>
              <form action="" method="post" class="reply-form">
                <input type="hidden" name="hid_cid" value="<?php echo $row['complaint_id']; ?>" />
                <input type="text" name="txt_reply" placeholder="Type your reply..." required />
                <input type="submit" name="btn_reply" value="Send" />
              </form>
            <?php } ?>
          </td>
        </tr>
        <?php } ?>
      </table>
    </form>
  </div>
</body>
</html>
<?php include("Foot.php"); ?>