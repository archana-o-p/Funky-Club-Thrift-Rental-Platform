<?php include('../Assets/Connection/Connection.php');
include("Head.php");
$gender = isset($_GET['gender']) ? $_GET['gender'] : 0;
if ($gender > 0) {
  $sel = "SELECT * FROM tbl_product WHERE gender_id = '$gender'";
} else {
  $sel = "SELECT * FROM tbl_product";
}
$result = $con->query($sel);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Shop Products</title>

  <!-- Premium Aesthetic CSS -->
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(120deg, #f8fafc, #e0f2fe);
      color: #0f172a;
    }

    .container {
      display: flex;
      gap: 30px;
      width: 95%;
      max-width: 1350px;
      margin: 40px auto;
    }

    /* Sidebar (Filters) */
    .sidebar {
      width: 270px;
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05);
      padding: 25px 20px;
      height: fit-content;
      position: sticky;
      top: 30px;
    }

    .sidebar h2 {
      font-size: 20px;
      font-weight: 600;
      color: #1e293b;
      margin-bottom: 20px;
      text-align: center;
      border-bottom: 2px solid #e2e8f0;
      padding-bottom: 10px;
    }

    .filter-group {
      margin-bottom: 20px;
    }

    .filter-group label {
      display: block;
      font-weight: 500;
      color: #475569;
      margin-bottom: 8px;
    }

    .filter-group select {
      width: 100%;
      padding: 10px 12px;
      border-radius: 8px;
      border: 1px solid #cbd5e1;
      background: #f9fafb;
      transition: 0.3s;
      font-size: 14px;
    }

    .filter-group select:hover {
      border-color: #3b82f6;
      box-shadow: 0 0 5px rgba(59, 130, 246, 0.3);
    }

    /* Product Section */
    .product-section {
      flex: 1;
    }

    .product-header {
      text-align: center;
      margin-bottom: 25px;
    }

    .product-header h1 {
      font-size: 28px;
      color: #0f172a;
      margin-bottom: 5px;
    }

    .product-header p {
      color: #64748b;
      font-size: 14px;
    }

    /* Product Grid */
    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
      gap: 25px;
    }

    .product-card {
      background: #fff;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 18px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      position: relative;
    }

    .product-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }

    .product-img {
      position: relative;
      width: 100%;
      height: 250px;
      overflow: hidden;
      border-bottom: 1px solid #f1f5f9;
    }

    .product-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s;
    }

    .product-card:hover .product-img img {
      transform: scale(1.07);
    }

    .product-info {
      padding: 16px 18px;
      text-align: center;
    }

    .product-info h3 {
      font-size: 18px;
      margin: 5px 0;
      color: #1e293b;
    }

    .product-info p {
      color: #64748b;
      font-size: 13px;
      margin: 4px 0;
    }

    .price {
      font-size: 17px;
      font-weight: 600;
      color: #2563eb;
      margin-top: 8px;
    }

    /* Stock and Actions */
    .stock-info {
      background: #f8fafc;
      border-radius: 10px;
      padding: 10px;
      font-size: 13px;
      color: #334155;
      margin-top: 10px;
    }

    .out-stock {
      color: #dc2626;
      font-weight: 600;
      margin-top: 5px;
    }

    .product-actions a {
      display: inline-block;
      padding: 8px 16px;
      background: linear-gradient(90deg, #3b82f6, #2563eb);
      color: #fff !important;
      border-radius: 8px;
      text-decoration: none;
      font-size: 13px;
      transition: 0.3s ease;
      margin-top: 8px;
    }

    .product-actions a:hover {
      background: linear-gradient(90deg, #2563eb, #1d4ed8);
    }

    /* Responsive */
    @media (max-width: 900px) {
      .container {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
        position: static;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Sidebar Filters -->
    <div class="sidebar">
      <h2>🧩 Filters</h2>
      <form id="form1" name="form1" method="post" action="">
        <div class="filter-group">
          <label>Category</label>
          <select name="sel_category" id="sel_category" onchange="getajaxsearch(),getSubcategory(this.value)">
            <option value="">Select</option>
            <?php
            $selQry = "select * from tbl_category";
            $result = $con->query($selQry);
            while ($row = $result->fetch_assoc()) {
              ?>
              <option value="<?php echo $row["category_id"] ?>"><?php echo $row["category_name"] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="filter-group">
          <label>Subcategory</label>
          <select name="sel_subcategory" id="sel_subcategory" onchange="getajaxsearch()">
            <option value="">--Select SubCategory--</option>
          </select>
        </div>

        <div class="filter-group">
          <label>Material</label>
          <select name="sel_material" id="sel_material" onchange="getajaxsearch()">
            <option value="">Select</option>
            <?php
            $selQry = "select * from tbl_material";
            $result = $con->query($selQry);
            while ($row = $result->fetch_assoc()) {
              ?>
              <option value="<?php echo $row["material_id"] ?>"><?php echo $row["material_name"] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="filter-group">
          <label>Size</label>
          <select name="sel_size" id="sel_size" onchange="getajaxsearch()">
            <option value="">Select</option>
            <?php
            $selQry = "select * from tbl_size";
            $result = $con->query($selQry);
            while ($row = $result->fetch_assoc()) {
              ?>
              <option value="<?php echo $row["size_id"] ?>"><?php echo $row["size_name"] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="filter-group">
          <label>Color</label>
          <select name="sel_color" id="sel_color" onchange="getajaxsearch()">
            <option value="">Select</option>
            <?php
            $selQry = "select * from tbl_color";
            $result = $con->query($selQry);
            while ($row = $result->fetch_assoc()) {
              ?>
              <option value="<?php echo $row["color_id"] ?>"><?php echo $row["color_name"] ?></option>
            <?php } ?>
          </select>
        </div>
      </form>
    </div>

    <!-- Product Section -->
    <div class="product-section">
      <div class="product-header">
        <h1>🛒 Explore Our Collection</h1>
        <p>Find the perfect products filtered just for you!</p>
      </div>

      <div id="result" class="product-grid">
        <?php
        $sel = "SELECT * FROM tbl_product p
            INNER JOIN tbl_material m ON m.material_id=p.material_id
            INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
            INNER JOIN tbl_category c ON c.category_id=s.category_id
            INNER JOIN tbl_seller se ON se.seller_id=p.seller_id
            INNER JOIN tbl_gender g ON g.gender_id = p.gender_id
            WHERE 1=1";
        if (isset($_GET['gender_id']) && $_GET['gender_id'] != '') {
          $gender_id = $_GET['gender_id'];
          $sel .= " AND p.gender_id = '$gender_id'";
        }
        $result = $con->query($sel);
        while ($data = $result->fetch_assoc()) {
          ?>
          <div class="product-card">
            <div class="product-img">
              <a href="ProductDetails.php?pid=<?php echo $data['product_id']; ?>">
                <img src="../Assets/files/Product/<?php echo $data["product_photo"]; ?>" alt="Product">
              </a>
            </div>
            <div class="product-info">
              <h3><?php echo $data["product_name"]; ?></h3>
              <p><?php echo $data["product_details"]; ?></p>
              <p><strong>Gender:</strong> <?php echo $data["gender_name"]; ?></p>
              <div class="price">₹<?php echo $data["product_price"]; ?></div>

              <div class="stock-info">
                <?php
                $SelStock = "SELECT st.*, sz.size_name, co.color_name 
                           FROM tbl_stock st
                           LEFT JOIN tbl_size sz ON sz.size_id=st.size_id
                           LEFT JOIN tbl_color co ON co.color_id=st.color_id
                           WHERE st.product_id='" . $data['product_id'] . "'";
                $res = $con->query($SelStock);

                $sizes = [];
                $colors = [];

                while ($rowS = $res->fetch_assoc()) {
                  $selstock = "SELECT SUM(stock_count) as stock 
                               FROM tbl_stock 
                               WHERE product_id='" . $data["product_id"] . "'
                               AND size_id='" . $rowS['size_id'] . "'
                               AND color_id='" . $rowS['color_id'] . "'";
                  $stockRes = $con->query($selstock)->fetch_assoc();

                  $selcart = "SELECT SUM(cart_qty) as cart_qty 
                              FROM tbl_cart 
                              WHERE product_id='" . $data["product_id"] . "'
                              AND size_id='" . $rowS['size_id'] . "'
                              AND color_id='" . $rowS['color_id'] . "'
                              AND cart_status > 0";
                  $cartRes = $con->query($selcart)->fetch_assoc();

                  $remaining = ($stockRes['stock'] ?? 0) - ($cartRes['cart_qty'] ?? 0);
                  if ($remaining > 0) {
                    $sizes[$rowS['size_id']] = $rowS['size_name'];
                    $colors[$rowS['color_id']] = $rowS['color_name'];
                  }
                }

                if (!empty($sizes) && !empty($colors)) {
                  ?>
                  <div>
                    <label><b>Size:</b></label>
                    <select id="size_<?php echo $data['product_id']; ?>">
                      <option value="">Select Size</option>
                      <?php foreach ($sizes as $sid => $sname) { ?>
                        <option value="<?php echo $sid; ?>"><?php echo $sname; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div style="margin-top:8px;">
                    <label><b>Color:</b></label>
                    <select id="color_<?php echo $data['product_id']; ?>">
                      <option value="">Select Color</option>
                      <?php foreach ($colors as $cid => $cname) { ?>
                        <option value="<?php echo $cid; ?>"><?php echo $cname; ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="product-actions">
                    <a href="#" onclick="addToCartDropdown('<?php echo $data['product_id']; ?>')">Add to Cart</a>
                  </div>
                  <?php
                } else {
                  echo "<div class='out-stock'>Completely Out of Stock</div>";
                }
                ?>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <script src="../Assets/JQ/jQuery.js"></script>
  <script>
    function getSubcategory(did) {
      $.ajax({
        url: "../Assets/AjaxPages/AjaxSubcategory.php?did=" + did,
        success: function (result) {
          $("#sel_subcategory").html(result);
        }
      });
    }

    function AddtoCart(pid, sid, cid) {
      $.ajax({
        url: "../Assets/AjaxPages/AjaxAddCart.php?pid=" + pid + "&sid=" + sid + "&cid=" + cid,
        success: function (result) {
          alert(result);
        }
      });
    }

    function getajaxsearch() {
      var catid = $('#sel_category').val();
      var subcatid = $('#sel_subcategory').val();
      var matid = $('#sel_material').val();
      var sizeid = $('#sel_size').val();
      var colorid = $('#sel_color').val();
      $.ajax({
        url: "../Assets/AjaxPages/Ajaxproduct.php?catid=" + catid +
          "&subcatid=" + subcatid +
          "&matid=" + matid +
          "&sizeid=" + sizeid +
          "&colorid=" + colorid,
        success: function (result) {
          $("#result").html(result);
        }
      });
    }

    function addToCartDropdown(pid) {
      var sid = $('#size_' + pid).val();
      var cid = $('#color_' + pid).val();

      if (sid === "" || cid === "") {
        alert("Please select both size and color.");
        return;
      }

      $.ajax({
        url: "../Assets/AjaxPages/AjaxAddCart.php?pid=" + pid + "&sid=" + sid + "&cid=" + cid,
        success: function (result) {
          alert(result);
        }
      });
    }
  </script>
</body>

</html>
<?php include("Foot.php"); ?>