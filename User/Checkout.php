<?php
session_start();
include("../Assets/Connection/Connection.php");
include("Head.php");

// Check if user is logged in
if (!isset($_SESSION['uid'])) {
    echo "<script>alert('Please login first!'); window.location='../Guest/Login.php';</script>";
    exit;
}

// Check if cart has items
$uid = $_SESSION['uid'];
$cartCheck = "SELECT * FROM tbl_booking b 
              INNER JOIN tbl_cart c ON c.booking_id=b.booking_id 
              WHERE b.user_id='$uid' AND booking_status='0' AND cart_status=0";
$cartResult = $con->query($cartCheck);

if ($cartResult->num_rows == 0) {
    echo "<script>alert('No products in cart!'); window.location='ViewProduct.php';</script>";
    exit;
}

// Validate product input
if (!isset($_GET['pid'])) {
    echo "<script>alert('No product selected!'); window.location='ViewProduct.php';</script>";
    exit;
}

$pid = $_GET['pid'];
$sid = $_GET['sid'];
$cid = $_GET['cid'];
$qty = $_GET['qty'];

// Fetch product details
$q = "SELECT * FROM tbl_product WHERE product_id='$pid'";
$res = $con->query($q);
if ($res->num_rows == 0) {
    echo "<script>alert('Product not found!'); window.location='ViewProduct.php';</script>";
    exit;
}
$row = $res->fetch_assoc();

$total = $row['product_price'] * $qty;

// Fetch user details (for address)
$userQ = "SELECT * FROM tbl_user u 
          INNER JOIN tbl_place p ON u.place_id=p.place_id 
          INNER JOIN tbl_district d ON p.district_id=d.district_id 
          WHERE user_id='$uid'";
$userRes = $con->query($userQ);
$userRow = $userRes->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Checkout</title>
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

            color: #333;
        }

        /* ========= MAIN CONTAINER ========= */
        .checkout-main-container {
            width: 85%;
            max-width: 950px;
            margin: 0 auto;
            background: #fff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            animation: checkout-slide-in 0.6s ease;
        }

        /* ========= ANIMATION ========= */
        @keyframes checkout-slide-in {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========= PAGE HEADER ========= */
        .checkout-page-header {
            color: #1a237e;
            margin-bottom: 25px;
            text-align: center;
            font-size: 28px;
            font-weight: 600;
        }

        /* ========= PRODUCT SUMMARY ========= */
        .checkout-product-summary {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .checkout-summary-image {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 15px;
            margin-right: 30px;
        }

        .checkout-summary-details {
            flex: 1;
        }

        .checkout-product-title {
            color: #0d47a1;
            font-size: 22px;
            margin-bottom: 10px;
            font-weight: 500;
        }

        .checkout-product-info {
            color: #444;
            line-height: 1.6;
            margin-bottom: 5px;
        }

        .checkout-total-amount {
            font-size: 22px;
            color: #d32f2f;
            font-weight: bold;
            margin-top: 10px;
        }

        /* ========= ADDRESS SECTION ========= */
        .checkout-address-section {
            margin-bottom: 30px;
        }

        .checkout-address-header {
            color: #1a237e;
            margin-bottom: 15px;
            font-size: 20px;
            font-weight: 500;
        }

        .checkout-user-details {
            font-size: 16px;
            line-height: 1.7;
            color: #333;
            margin-bottom: 10px;
        }

        .checkout-edit-toggle {
            display: flex;
            align-items: center;
            margin-top: 15px;
            cursor: pointer;
        }

        .checkout-edit-checkbox {
            margin-right: 8px;
            transform: scale(1.2);
        }

        .checkout-edit-label {
            font-size: 14px;
            color: #555;
        }

        .checkout-new-address-wrapper {
            display: none;
            margin-top: 15px;
        }

        /* ========= PAYMENT FORM ========= */
        .checkout-payment-form {
            margin-top: 20px;
        }

        .checkout-payment-label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #333;
            font-size: 16px;
        }

        .checkout-form-input,
        .checkout-form-select,
        .checkout-form-textarea {
            width: 100%;
            padding: 10px 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .checkout-form-input:focus,
        .checkout-form-select:focus,
        .checkout-form-textarea:focus {
            border-color: #1976d2;
            outline: none;
            box-shadow: 0 0 0 2px rgba(25, 118, 210, 0.1);
        }

        .checkout-form-textarea {
            resize: vertical;
            min-height: 80px;
        }

        /* ========= PROCEED BUTTON ========= */
        .checkout-proceed-button {
            background: #1976d2;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
            margin-top: 20px;
            font-weight: 500;
        }

        .checkout-proceed-button:hover {
            background: #0d47a1;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(25, 118, 210, 0.3);
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 768px) {
            .checkout-main-container {
                width: 95%;
                padding: 25px;
            }

            .checkout-product-summary {
                flex-direction: column;
                text-align: center;
            }

            .checkout-summary-image {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .checkout-page-header {
                font-size: 24px;
            }

            .checkout-edit-toggle {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 20px 0;
            }

            .checkout-main-container {
                padding: 20px;
            }

            .checkout-product-title {
                font-size: 20px;
            }

            .checkout-total-amount {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="checkout-main-container">
        <h2 class="checkout-page-header">Checkout</h2>

        <!-- Product Summary -->
        <div class="checkout-product-summary">
            <img src="../Assets/Files/Product/<?php echo $row['product_photo']; ?>"
                alt="<?php echo $row['product_name']; ?>" class="checkout-summary-image">
            <div class="checkout-summary-details">
                <h3 class="checkout-product-title"><?php echo $row['product_name']; ?></h3>
                <p class="checkout-product-info"><b>Price per item:</b> ₹<?php echo $row['product_price']; ?></p>
                <p class="checkout-product-info"><b>Quantity:</b> <?php echo $qty; ?></p>
                <p class="checkout-total-amount">Total: ₹<?php echo $total; ?></p>
            </div>
        </div>

        <!-- Address Section -->
        <div class="checkout-address-section">
            <h3 class="checkout-address-header">Delivery Address</h3>
            <p class="checkout-user-details"><b>Name:</b> <?php echo $userRow['user_name']; ?></p>
            <p class="checkout-user-details"><b>Phone:</b> <?php echo $userRow['user_contact']; ?></p>
            <p class="checkout-user-details"><b>Address:</b> <?php echo $userRow['user_address']; ?>,
                <?php echo $userRow['place_name']; ?>, <?php echo $userRow['district_name']; ?>
            </p>

            <label class="checkout-edit-toggle">
                <input type="checkbox" class="checkout-edit-checkbox" id="editAddress" onchange="toggleAddress()">
                <span class="checkout-edit-label">Deliver to another address</span>
            </label>

            <div id="newAddress" class="checkout-new-address-wrapper">
                <textarea class="checkout-form-textarea" name="altAddress" id="altAddress"
                    placeholder="Enter new delivery address..." rows="3"></textarea>
            </div>
        </div>

        <!-- Payment + Proceed -->
        <form action="Payment.php" method="get" class="checkout-payment-form">
            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
            <input type="hidden" name="sid" value="<?php echo $sid; ?>">
            <input type="hidden" name="cid" value="<?php echo $cid; ?>">
            <input type="hidden" name="qty" value="<?php echo $qty; ?>">
            <input type="hidden" name="amt" value="<?php echo $total; ?>">

            <label class="checkout-payment-label"><b>Payment Method:</b></label>
            <select class="checkout-form-select" name="paymode" required>
                <option value="">-- Select Payment Method --</option>
                <option value="UPI">UPI</option>
                <option value="Card">Credit/Debit Card</option>
                <option value="COD">Cash on Delivery</option>
            </select>

            <button type="submit" class="checkout-proceed-button">Proceed to Payment</button>
        </form>
    </div>

    <script>
        function toggleAddress() {
            let check = document.getElementById('editAddress');
            let addr = document.getElementById('newAddress');
            addr.style.display = check.checked ? 'block' : 'none';
        }
    </script>
</body>

</html>
<?php include("Foot.php"); ?>