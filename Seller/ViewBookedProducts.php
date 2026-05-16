<?php
include('../Assets/Connection/Connection.php');
session_start();
include('Head.php');
?>
<?php
if (isset($_GET["did"])) {
  $packQry = "update  tbl_booking set booking_status=1 where booking_id=" . $_GET["did"];
  if ($con->query($packQry)) {
    ?>
    <script>
      alert("Your Order Packed");
      window.location = "ViewBookedProducts.php";
    </script>

    <?php
  }
}
if (isset($_GET["eid"])) {
  $shippedQry = "update  tbl_booking set booking_status=2 where booking_id=" . $_GET["eid"];
  if ($con->query($shippedQry)) {
    ?>
    <script>
      alert("Your Order Shipped");
      window.location = "ViewBookedProducts.php";
    </script>
    <?php
  }
}
if (isset($_GET["wid"])) {
  $deliveryQry = "update  tbl_booking set booking_status=3 where booking_id=" . $_GET["wid"];
  if ($con->query($deliveryQry)) {
    ?>
    <script>
      alert("Your Order Delivered");
      window.location = "ViewBookedProducts.php";
    </script>
    <?php
  }
}
?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>View Booked Products</title>

  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: linear-gradient(135deg, #454242ff, #000000ff);
      margin: 0;
      padding: 0;
    }

    form {
      width: 95%;
      max-width: 1200px;
      margin: 50px auto;
      background: #fff;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      border-radius: 16px;
      overflow: hidden;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      text-align: center;
      padding: 12px 15px;
    }

    th {
      background-color: #000000ff;
      color: white;
      text-transform: uppercase;
      font-size: 13px;
      letter-spacing: 0.5px;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f1f7ff;
      transition: 0.3s;
    }

    td img {
      border-radius: 10px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
      object-fit: cover;
    }

    a {
      display: inline-block;
      margin: 5px;
      padding: 8px 12px;
      font-size: 13px;
      text-decoration: none;
      border-radius: 6px;
      transition: 0.3s ease;
      font-weight: 500;
    }

    a[href*="did"] {
      background-color: #ffc107;
      color: #000;
    }

    a[href*="eid"] {
      background-color: #17a2b8;
      color: white;
    }

    a[href*="wid"] {
      background-color: #28a745;
      color: white;
    }

    a:hover {
      opacity: 0.85;
      transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 768px) {
      table {
        font-size: 12px;
      }

      td img {
        width: 60px;
        height: 60px;
      }

      a {
        padding: 6px 10px;
        font-size: 12px;
      }
    }
  </style>
</head>

<body>
  <div style="display:flex; justify-content:center; align-items:center; min-height:100vh;">
    <form id="form1" name="form1" method="post" action="">
      <table border="1" cellpadding="10" cellspacing="0">
        <tr>
          <th>SI NO</th>
          <th>User Name</th>
          <th>Product Name</th>
          <th>Color</th>
          <th>Size</th>
          <th>Price</th>
          <th>Photo</th>
          <th>Qty</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
        <?php
        $i = 0;
        $sel = "select * from tbl_cart p inner join tbl_booking m on m.booking_id=p.booking_id inner join tbl_product s on s.product_id=p.product_id inner join tbl_size sz ON sz.size_id = p.size_id inner join tbl_color co ON co.color_id = p.color_id inner join tbl_user f on f.user_id=m.user_id inner join tbl_seller c on c.seller_id=s.seller_id WHERE m.booking_status > 0 AND   m.user_id='" . $_SESSION['uid'] . "' ";
        $result = $con->query($sel);

        while ($row = $result->fetch_assoc()) {
          $i++;
          ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row["user_name"]; ?></td>
            <td><?php echo $row["product_name"]; ?></td>
            <td><?php echo $row["color_name"]; ?></td>
            <td><?php echo $row["size_name"]; ?></td>
            <td><?php echo $row["product_price"]; ?></td>
            <td><img src="../Assets/files/Product/<?php echo $row["product_photo"]; ?>" width="100px" height="100px" />
            </td>
            <td><?php echo $row["cart_qty"]; ?></td>
            <td><?php echo $row["booking_amount"]; ?></td>
            <td>
              <a href="ViewBookedProducts.php?did=<?php echo $row["booking_id"]; ?>">Order Packed</a>
              <a href="ViewBookedProducts.php?eid=<?php echo $row["booking_id"]; ?>">Order Shipped</a>
              <a href="ViewBookedProducts.php?wid=<?php echo $row["booking_id"]; ?>">Order Delivered</a>
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
<?php include("Foot.php"); ?>