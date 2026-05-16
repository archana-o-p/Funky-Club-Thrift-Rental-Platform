<?php
session_start();
include('../Assets/Connection/Connection.php');
include("Head.php");

if (isset($_GET['pid'])) {
    $pid = mysqli_real_escape_string($con, $_GET['pid']);
    if (!is_numeric($pid)) {
        echo "<script>alert('Invalid product ID'); window.location='ViewProduct.php';</script>";
        exit;
    }

    $qry = "SELECT * FROM tbl_product p 
            INNER JOIN tbl_material m ON m.material_id=p.material_id 
            INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id 
            INNER JOIN tbl_category c ON c.category_id=s.category_id 
            INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
            INNER JOIN tbl_gender g ON g.gender_id=p.gender_id
            WHERE p.product_id = '$pid'";
    $res = $con->query($qry);
    if ($res->num_rows == 0) {
        echo "<script>alert('Product not found'); window.location='ViewProduct.php';</script>";
        exit;
    }
    $row = $res->fetch_assoc();
} else {
    echo "<script>alert('Invalid product'); window.location='ViewProduct.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($row['product_name']); ?> - Details</title>
    <style>
        /* ========= RESET ========= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }


        /* ========= MAIN WRAPPER ========= */
        .productdetail-main-wrapper {
            max-width: 1100px;
            margin: 0 auto;
            animation: productdetail-fade-in 0.8s ease;
        }

        @keyframes productdetail-fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========= CONTAINER ========= */
        .productdetail-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
        }

        /* ========= IMAGE SECTION ========= */
        .productdetail-image-section {
            flex: 1;
            min-width: 300px;
            background: #f7f9fc;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .productdetail-image {
            width: 100%;
            max-width: 450px;
            border-radius: 16px;
            object-fit: cover;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s ease;
        }

        .productdetail-image:hover {
            transform: scale(1.05);
        }

        /* ========= DETAILS SECTION ========= */
        .productdetail-details-section {
            flex: 1.3;
            min-width: 350px;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .productdetail-title {
            font-size: 28px;
            color: #1a237e;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .productdetail-description {
            color: #444;
            line-height: 1.7;
            margin-bottom: 20px;
            font-size: 15px;
        }

        .productdetail-info-grid {
            display: grid;
            grid-template-columns: max-content 1fr;
            gap: 12px 20px;
            margin-bottom: 25px;
            font-size: 15px;
        }

        .productdetail-info-label {
            font-weight: 600;
            color: #555;
        }

        .productdetail-info-value {
            color: #333;
        }

        .productdetail-price {
            font-size: 30px;
            color: #d32f2f;
            font-weight: 700;
            margin-bottom: 25px;
        }

        /* ========= FORM ========= */
        .productdetail-form {
            margin-top: 10px;
        }

        .productdetail-form-grid {
            display: grid;
            gap: 20px;
            margin-bottom: 25px;
        }

        .productdetail-form-field {
            display: flex;
            flex-direction: column;
        }

        .productdetail-form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #333;
            font-size: 15px;
        }

        .productdetail-select,
        .productdetail-input {
            padding: 12px 14px;
            border-radius: 8px;
            border: 1.5px solid #ddd;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .productdetail-select:focus,
        .productdetail-input:focus {
            border-color: #1e88e5;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.15);
            outline: none;
        }

        /* ========= BUTTONS ========= */
        .productdetail-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .productdetail-addcart-btn,
        .productdetail-buynow-btn {
            flex: 1;
            min-width: 160px;
            padding: 14px 20px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .productdetail-addcart-btn {
            background: #1e88e5;
            color: white;
        }

        .productdetail-addcart-btn:hover {
            background: #1565c0;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(30, 136, 229, 0.3);
        }

        .productdetail-buynow-btn {
            background: #43a047;
            color: white;
        }

        .productdetail-buynow-btn:hover {
            background: #2e7d32;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(67, 160, 71, 0.3);
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 868px) {
            .productdetail-container {
                flex-direction: column;
            }

            .productdetail-image-section {
                padding: 40px;
            }

            .productdetail-details-section {
                padding: 30px;
            }

            .productdetail-title {
                font-size: 24px;
            }

            .productdetail-price {
                font-size: 26px;
            }

            .productdetail-buttons {
                flex-direction: column;
            }

            .productdetail-addcart-btn,
            .productdetail-buynow-btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 20px 10px;
            }

            .productdetail-info-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .productdetail-info-label {
                font-weight: 600;
            }
        }
    </style>
</head>

<body>

    <div class="productdetail-main-wrapper">
        <div class="productdetail-container">
            <div class="productdetail-image-section">
                <img src="../Assets/Files/Product/<?php echo htmlspecialchars($row['product_photo']); ?>"
                    alt="<?php echo htmlspecialchars($row['product_name']); ?>" class="productdetail-image">
            </div>

            <div class="productdetail-details-section">
                <h2 class="productdetail-title"><?php echo htmlspecialchars($row['product_name']); ?></h2>
                <p class="productdetail-description"><strong>Description:</strong>
                    <?php echo nl2br(htmlspecialchars($row['product_details'])); ?></p>

                <div class="productdetail-info-grid">
                    <div class="productdetail-info-label">Gender:</div>
                    <div class="productdetail-info-value"><?php echo htmlspecialchars($row['gender_name']); ?></div>

                    <div class="productdetail-info-label">Material:</div>
                    <div class="productdetail-info-value"><?php echo htmlspecialchars($row['material_name']); ?></div>

                    <div class="productdetail-info-label">Category:</div>
                    <div class="productdetail-info-value"><?php echo htmlspecialchars($row['category_name']); ?> →
                        <?php echo htmlspecialchars($row['subcategory_name']); ?>
                    </div>

                    <div class="productdetail-info-label">Seller:</div>
                    <div class="productdetail-info-value"><?php echo htmlspecialchars($row['seller_name']); ?>
                        (<?php echo htmlspecialchars($row['seller_contact']); ?>)</div>
                </div>

                <div class="productdetail-price">₹<?php echo number_format($row['product_price']); ?></div>

                <form id="orderForm" class="productdetail-form">
                    <div class="productdetail-form-grid">
                        <div class="productdetail-form-field">
                            <label for="sizeSelect" class="productdetail-form-label"><strong>Select
                                    Size:</strong></label>
                            <select id="sizeSelect" class="productdetail-select" required>
                                <option value="">-- Choose Size --</option>
                                <?php
                                $sizeQry = "SELECT DISTINCT sz.size_id, sz.size_name 
                                        FROM tbl_stock st 
                                        INNER JOIN tbl_size sz ON sz.size_id=st.size_id 
                                        WHERE st.product_id='$pid' AND st.stock_count > 0";
                                $sizeRes = $con->query($sizeQry);
                                while ($srow = $sizeRes->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($srow['size_id']) . "'>" . htmlspecialchars($srow['size_name']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="productdetail-form-field">
                            <label for="colorSelect" class="productdetail-form-label"><strong>Select
                                    Color:</strong></label>
                            <select id="colorSelect" class="productdetail-select" required>
                                <option value="">-- Choose Color --</option>
                                <?php
                                $colorQry = "SELECT DISTINCT co.color_id, co.color_name 
                                         FROM tbl_stock st 
                                         INNER JOIN tbl_color co ON co.color_id=st.color_id 
                                         WHERE st.product_id='$pid' AND st.stock_count > 0";
                                $colorRes = $con->query($colorQry);
                                while ($crow = $colorRes->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($crow['color_id']) . "'>" . htmlspecialchars($crow['color_name']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="productdetail-form-field">
                            <label for="qtyInput" class="productdetail-form-label"><strong>Quantity:</strong></label>
                            <input type="number" id="qtyInput" class="productdetail-input" min="1" max="50" value="1"
                                required>
                        </div>
                    </div>

                    <div class="productdetail-buttons">
                        <button type="button" class="productdetail-addcart-btn" onclick="AddToCart()">Add to
                            Cart</button>
                        <button type="button" class="productdetail-buynow-btn" onclick="BuyNow()">Buy Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../Assets/JQ/jQuery.js"></script>
    <script>
        function AddToCart() {
            var pid = "<?php echo $pid; ?>";
            var sid = $("#sizeSelect").val();
            var cid = $("#colorSelect").val();
            var qty = $("#qtyInput").val();

            if (sid === "" || cid === "") {
                alert("Please select both size and color.");
                return;
            }

            if (qty < 1) {
                alert("Please enter a valid quantity.");
                return;
            }

            $.ajax({
                url: "../Assets/AjaxPages/AjaxAddCart.php",
                type: "GET",
                data: { pid: pid, sid: sid, cid: cid, qty: qty },
                success: function (response) {
                    if (response.trim() === "Added to cart successfully!") {
                        alert("Added to cart!");
                    } else {
                        alert(response);
                    }
                },
                error: function () {
                    alert("Error adding to cart. Please try again.");
                }
            });
        }

        function BuyNow() {
            var pid = "<?php echo $pid; ?>";
            var sid = $("#sizeSelect").val();
            var cid = $("#colorSelect").val();
            var qty = $("#qtyInput").val();

            if (sid === "" || cid === "") {
                alert("Please select both size and color.");
                return;
            }

            if (qty < 1) {
                alert("Please enter a valid quantity.");
                return;
            }

            window.location.href = "Checkout.php?pid=" + pid + "&sid=" + sid + "&cid=" + cid + "&qty=" + qty;
        }
    </script>

</body>

</html>

<?php include("Foot.php"); ?>