<?php
session_start();
include('../Assets/Connection/Connection.php');
include('Head.php');

$uid = $_SESSION['uid'];

// ✅ Fetch user details
$userQry = "SELECT * FROM tbl_user u 
            INNER JOIN tbl_place p ON u.place_id=p.place_id 
            INNER JOIN tbl_district d ON p.district_id=d.district_id 
            WHERE user_id='$uid'";
$userRes = $con->query($userQry);
$user = $userRes->fetch_assoc();

// ✅ Initialize total
$total = 0;

// ✅ Fetch cart items
$cartQry = "SELECT c.*, p.product_name, p.product_photo, p.product_price, 
            sz.size_name, co.color_name
            FROM tbl_cart c 
            INNER JOIN tbl_product p ON p.product_id=c.product_id
            INNER JOIN tbl_size sz ON sz.size_id=c.size_id
            INNER JOIN tbl_color co ON co.color_id=c.color_id
            WHERE c.user_id='$uid'";
$cartRes = $con->query($cartQry);
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
            background: linear-gradient(135deg, #e3f2fd, #f5f9ff);
            padding: 50px 0;
            color: #333;
        }

        /* ========= MAIN CONTAINER ========= */
        .checkout-main-wrapper {
            width: 90%;
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            animation: checkout-appear 0.6s ease;
        }

        /* ========= ANIMATION ========= */
        @keyframes checkout-appear {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========= PAGE HEADER ========= */
        .checkout-page-title {
            color: #1a237e;
            margin-bottom: 25px;
            text-align: center;
            font-size: 28px;
            font-weight: 600;
        }

        /* ========= CART TABLE ========= */
        .checkout-cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .checkout-table-header {
            background: #1a237e;
            color: #fff;
        }

        .checkout-table-header th {
            padding: 15px 12px;
            text-align: center;
            font-weight: 500;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .checkout-table-row {
            transition: background-color 0.3s ease;
        }

        .checkout-table-row:hover {
            background: #f8f9fa;
        }

        .checkout-table-cell {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: center;
            font-size: 14px;
        }

        .checkout-product-image {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
        }

        .checkout-product-name {
            font-weight: 500;
            color: #1a237e;
        }

        .checkout-subtotal-amount {
            font-weight: 600;
            color: #d32f2f;
        }

        /* ========= ADDRESS SECTION ========= */
        .checkout-address-container {
            background: #f1f8e9;
            padding: 20px;
            border-radius: 10px;
            margin-top: 30px;
        }

        .checkout-address-header {
            color: #1a237e;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: 500;
        }

        .checkout-address-details {
            font-size: 15px;
            line-height: 1.6;
            color: #333;
            margin-bottom: 15px;
        }

        .checkout-change-address-link {
            display: inline-block;
            background: #4caf50;
            color: #fff;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .checkout-change-address-link:hover {
            background: #45a049;
        }

        /* ========= SUMMARY SECTION ========= */
        .checkout-summary-section {
            margin-top: 30px;
            text-align: right;
            padding: 20px;
            background: #e8f5e8;
            border-radius: 10px;
        }

        .checkout-total-label {
            font-size: 24px;
            color: #1a237e;
            font-weight: 600;
            margin-bottom: 10px;
        }

        /* ========= PROCEED BUTTON ========= */
        .checkout-proceed-button {
            background: #1e88e5;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .checkout-proceed-button:hover {
            background: #1565c0;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 768px) {
            .checkout-main-wrapper {
                width: 95%;
                padding: 20px;
            }

            .checkout-table-header th,
            .checkout-table-cell {
                padding: 8px 6px;
                font-size: 12px;
            }

            .checkout-product-image {
                width: 60px;
                height: 60px;
            }

            .checkout-cart-table {
                font-size: 13px;
            }

            .checkout-page-title {
                font-size: 24px;
            }

            .checkout-summary-section {
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            .checkout-table-header th {
                display: none;
            }

            .checkout-table-cell {
                text-align: left;
                padding: 10px 6px;
            }

            .checkout-table-cell:before {
                content: attr(data-label) ": ";
                font-weight: bold;
                color: #1a237e;
            }
        }
    </style>
</head>

<body>
    <div class="checkout-main-wrapper">
        <h2 class="checkout-page-title">Checkout</h2>

        <!-- ✅ Cart Products -->
        <table class="checkout-cart-table">
            <thead class="checkout-table-header">
                <tr>
                    <th>Photo</th>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cartRes->data_seek(0); // Reset pointer if needed, but since loop is after query, it's fine
                while ($row = $cartRes->fetch_assoc()) {
                    $subtotal = $row['product_price'] * $row['cart_qty'];
                    $total += $subtotal;
                    ?>
                    <tr class="checkout-table-row">
                        <td class="checkout-table-cell"><img
                                src="../Assets/Files/Product/<?php echo $row['product_photo']; ?>"
                                class="checkout-product-image" alt="Product Photo"></td>
                        <td class="checkout-table-cell checkout-product-name"><?php echo $row['product_name']; ?></td>
                        <td class="checkout-table-cell"><?php echo $row['size_name']; ?></td>
                        <td class="checkout-table-cell"><?php echo $row['color_name']; ?></td>
                        <td class="checkout-table-cell"><?php echo $row['cart_qty']; ?></td>
                        <td class="checkout-table-cell">₹<?php echo $row['product_price']; ?></td>
                        <td class="checkout-table-cell checkout-subtotal-amount">₹<?php echo $subtotal; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- ✅ Address Section -->
        <div class="checkout-address-container">
            <h3 class="checkout-address-header">Shipping Address</h3>
            <div class="checkout-address-details">
                <?php echo $user['user_name']; ?><br>
                <?php echo $user['user_address']; ?><br>
                <?php echo $user['place_name'] . ", " . $user['district_name']; ?><br>
                Contact: <?php echo $user['user_contact']; ?>
            </div>
            <a href="EditAddress.php" class="checkout-change-address-link">Change Address</a>
        </div>

        <!-- ✅ Summary -->
        <div class="checkout-summary-section">
            <div class="checkout-total-label">Total: ₹<?php echo number_format($total, 2); ?></div>
            <a href="Payment.php?amount=<?php echo $total; ?>" class="checkout-proceed-button">Proceed to Payment</a>
        </div>
    </div>
</body>

</html>

<?php include('Foot.php'); ?>