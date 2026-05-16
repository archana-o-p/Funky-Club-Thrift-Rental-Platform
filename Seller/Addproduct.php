<?php
include('../Assets/Connection/Connection.php');
session_start();
include('Head.php');
?>
<?php
if(isset($_POST["btn_submit"])) {
    $name = $_POST['txt_name'];
    $price = $_POST['txt_price'];
    $details = $_POST['txt_details'];
    $photo = $_FILES["file_photo"]["name"];
    $tempPhoto = $_FILES["file_photo"]["tmp_name"];
    move_uploaded_file($tempPhoto,"../Assets/files/Product/".$photo);
    $material = $_POST['sel_material'];
    $gender_id = $_POST['sel_gender'];
    $subcategory = $_POST['sel_subcategory'];

    $insQry = "INSERT INTO tbl_product(product_name, product_details, product_photo, material_id, subcategory_id, seller_id, product_price, gender_id) 
               VALUES('$name','$details','$photo','$material','$subcategory','".$_SESSION['sid']."','$price','$gender_id')";
    if($con->query($insQry)) {
        echo "<script>alert('Product added successfully'); window.location='Addproduct.php';</script>";
    }
}

if(isset($_GET["did"])) {
    $delQry = "DELETE FROM tbl_product WHERE product_id=".$_GET["did"];
    if($con->query($delQry)) {
        echo "<script>alert('Product deleted successfully'); window.location='Addproduct.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Add Product</title>
<script src="../Assets/JQ/jQuery.js"></script>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #474545ff;
    }
    table {
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
    }
    th, td {
        padding: 10px 15px;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #000000ff;
        color: white;
        text-align: left;
    }
    input, select {
        padding: 6px;
        width: 200px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    .btn {
        padding: 6px 12px;
        border-radius: 5px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        display: inline-block;
        margin: 3px;
    }
    .btn-delete { background-color: #e74c3c; }
    .btn-stock { background-color: #3498db; }
    .btn-gallery { background-color: #2ecc71; }
    .btn:hover { opacity: 0.8; }
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 30px;
    }
</style>
</head>

<body>
<div class="center">
<form action="" method="post" enctype="multipart/form-data" id="form1">
<table cellpadding="10">
  <tr><th colspan="2">Add Product</th></tr>
  <tr>
    <td>Name</td>
    <td><input type="text" name="txt_name" id="txt_name" required /></td>
  </tr>
  <tr>
    <td>Details</td>
    <td><input type="text" name="txt_details" id="txt_details" required /></td>
  </tr>
  <tr>
    <td>Photo</td>
    <td><input type="file" name="file_photo" id="file_photo" required /></td>
  </tr>
  <tr>
    <td>Price</td>
    <td><input type="text" name="txt_price" id="txt_price" required /></td>
  </tr>
  <tr>
    <td>Gender</td>
    <td>
      <select name="sel_gender" id="sel_gender" required>
        <option value="">Select</option>
        <?php
          $selQry = "SELECT * FROM tbl_gender";
          $result = $con->query($selQry);
          while($row = $result->fetch_assoc()) {
              echo "<option value='".$row['gender_id']."'>".$row['gender_name']."</option>";
          }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Material</td>
    <td>
      <select name="sel_material" id="sel_material" required>
        <option value="">Select</option>
        <?php
          $selQry = "SELECT * FROM tbl_material";
          $result = $con->query($selQry);
          while($row = $result->fetch_assoc()) {
              echo "<option value='".$row["material_id"]."'>".$row["material_name"]."</option>";
          }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Category</td>
    <td>
      <select name="sel_category" id="sel_category" onChange="getSubcategory(this.value)" required>
        <option value="">Select</option>
        <?php
          $selQry = "SELECT * FROM tbl_category";
          $result = $con->query($selQry);
          while($row = $result->fetch_assoc()) {
              echo "<option value='".$row["category_id"]."'>".$row["category_name"]."</option>";
          }
        ?>
      </select>
    </td>
  </tr>
  <tr>
    <td>Subcategory</td>
    <td>
      <select name="sel_subcategory" id="sel_subcategory" required>
        <option value="">Select</option>
      </select>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" 
      style="padding:8px 20px; background:#0078D7; border:none; color:white; border-radius:5px; cursor:pointer;">
    </td>
  </tr>
</table>
</form>
</div>

<br><br>

<div class="center">
<table cellpadding="10">
  <tr>
    <th>SI NO</th>
    <th>Name</th>
    <th>Details</th>
    <th>Photo</th>
    <th>Price</th>
    <th>Gender</th>
    <th>Material</th>
    <th>Category</th>
    <th>Subcategory</th>
    <th>Action</th>
  </tr>

  <?php
  $i=0;
  $sel="SELECT * FROM tbl_product p 
        INNER JOIN tbl_material m ON m.material_id=p.material_id 
        INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id 
        INNER JOIN tbl_category c ON c.category_id=s.category_id 
        INNER JOIN tbl_gender g ON p.gender_id = g.gender_id";
  $result = $con->query($sel);
  while ($row = $result->fetch_assoc()) {
      $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row["product_name"]; ?></td>
    <td><?php echo $row["product_details"]; ?></td>
    <td><img src="../Assets/files/Product/<?php echo $row["product_photo"]; ?>" width="100" height="100" style="border-radius:8px;"></td>
    <td><?php echo $row["product_price"]; ?></td>
    <td><?php echo $row["gender_name"]; ?></td>
    <td><?php echo $row["material_name"]; ?></td>
    <td><?php echo $row["category_name"]; ?></td>
    <td><?php echo $row["subcategory_name"]; ?></td>
    <td>
      <a href="Addproduct.php?did=<?php echo $row["product_id"]; ?>" class="btn btn-delete">Delete</a>
      <a href="Addstock.php?pid=<?php echo $row["product_id"]; ?>" class="btn btn-stock">Add Stock</a>
      <a href="AddGallery.php?pid=<?php echo $row["product_id"]; ?>" class="btn btn-gallery">Add Gallery</a>
    </td>
  </tr>
  <?php } ?>
</table>
</div>

<script>
function getSubcategory(did) {
    $.ajax({
        url: "../Assets/AjaxPages/AjaxSubcategory.php?did=" + did,
        success: function(result) {
            $("#sel_subcategory").html(result);
        }
    });
}
</script>
</body>
</html>
<?php include("Foot.php"); ?>