<?php
include('../Assets/Connection/Connection.php');
session_start();
include('Head.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>My Bookings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* ========= RESET ========= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        /* ========= BODY ========= */
        body {
            background: #848b91ff;
            min-height: 100vh;
            padding: 40px 10px;
            color: #333;
        }

        /* ========= MAIN CONTAINER ========= */
        .mybookings-main-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            background: #848b91ff;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            animation: mybookings-fade-in 0.8s ease;
        }

        /* ========= ANIMATION ========= */
        @keyframes mybookings-fade-in {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========= HEADER ========= */
        .mybookings-header {
            background: linear-gradient(90deg, #1a1a1d, #000000ff);
            color: #fff;
            text-align: center;
            padding: 25px;
            font-size: 1.8rem;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* ========= TABLE WRAPPER ========= */
        .mybookings-table-wrapper {
            overflow-x: auto;
        }

        /* ========= TABLE ========= */
        .mybookings-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            background: #fff;
        }

        .mybookings-table-header {
            background: linear-gradient(90deg, #3a3a3d, #232526);
            color: #fff;
        }

        .mybookings-table-header th {
            padding: 12px 10px;
            font-size: 15px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .mybookings-table-row {
            background-color: #fafafa;
            transition: all 0.3s ease;
        }

        .mybookings-table-row:nth-child(even) {
            background-color: #f2f2f2;
        }

        .mybookings-table-row:hover {
            background: #f5f7ff;
            transform: scale(1.01);
        }

        .mybookings-table-cell {
            padding: 12px 10px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        /* ========= IMAGE ========= */
        .mybookings-product-image {
            border-radius: 10px;
            transition: transform 0.3s ease;
            width: 90px;
            height: 90px;
            object-fit: cover;
        }

        .mybookings-product-image:hover {
            transform: scale(1.1);
        }

        /* ========= ACTION LINK ========= */
        .mybookings-action-link {
            display: inline-block;
            text-decoration: none;
            background: linear-gradient(90deg, #182848, #4b6cb7);
            color: white;
            padding: 8px 15px;
            border-radius: 25px;
            transition: 0.3s;
            font-size: 13px;
            font-weight: 500;
        }

        .mybookings-action-link:hover {
            background: linear-gradient(90deg, #4b6cb7, #182848);
            box-shadow: 0 4px 15px rgba(24, 40, 72, 0.3);
            transform: scale(1.05);
        }

        /* ========= STATUS ========= */
        .mybookings-status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            background: #e3f2fd;
            color: #1976d2;
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 992px) {
            .mybookings-table {
                font-size: 13px;
            }

            .mybookings-header {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }

            .mybookings-main-container {
                border-radius: 12px;
            }

            .mybookings-table,
            .mybookings-table-header,
            .mybookings-table-body,
            .mybookings-table-header th,
            .mybookings-table-row,
            .mybookings-table-cell {
                display: block;
            }

            .mybookings-table-header {
                display: none;
            }

            .mybookings-table-row {
                margin-bottom: 15px;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                padding: 15px;
                transform: none;
            }

            .mybookings-table-cell {
                border: none;
                text-align: left;
                padding: 8px 0;
                position: relative;
            }

            .mybookings-table-cell::before {
                content: attr(data-label);
                font-weight: bold;
                display: block;
                color: #444;
                margin-bottom: 3px;
            }

            .mybookings-product-image {
                width: 100%;
                height: auto;
                max-width: 150px;
            }
        }
    </style>
</head>

<body>
    <div class="mybookings-main-container">
        <div class="mybookings-header">My Bookings</div>
        <div class="mybookings-table-wrapper">
            <table class="mybookings-table">
                <thead class="mybookings-table-header">
                    <tr>
                        <th>SI NO</th>
                        <th>Product Name</th>
                        <th>Photo</th>
                        <th>Gender</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Booking Date</th>
                        <th>Cart Qty</th>
                        <th>Total Amount</th>
                        <th>Seller Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="mybookings-table-body">
                    <?php
                    $i = 0;
                    $sel = "
                    SELECT p.*, s.*, sz.size_name, co.color_name, c.seller_name, g.gender_name, m.*
                    FROM tbl_cart p
                    INNER JOIN tbl_booking m ON m.booking_id = p.booking_id
                    INNER JOIN tbl_product s ON s.product_id = p.product_id
                    INNER JOIN tbl_size sz ON sz.size_id = p.size_id
                    INNER JOIN tbl_color co ON co.color_id = p.color_id
                    INNER JOIN tbl_seller c ON c.seller_id = s.seller_id
                    INNER JOIN tbl_gender g ON g.gender_id = s.gender_id
                    WHERE m.booking_status > 0 
                    AND m.user_id = '" . $_SESSION['uid'] . "'
                    ";

                    $result = $con->query($sel);
                    while ($row = $result->fetch_assoc()) {
                        $i++;
                        ?>
                        <tr class="mybookings-table-row">
                            <td class="mybookings-table-cell" data-label="SI NO"><?php echo $i; ?></td>
                            <td class="mybookings-table-cell" data-label="Product Name"><?php echo $row["product_name"]; ?>
                            </td>
                            <td class="mybookings-table-cell" data-label="Photo">
                                <img src="../Assets/files/Product/<?php echo $row["product_photo"]; ?>"
                                    class="mybookings-product-image" alt="<?php echo $row["product_name"]; ?> Image" />
                            </td>
                            <td class="mybookings-table-cell" data-label="Gender"><?php echo $row["gender_name"]; ?></td>
                            <td class="mybookings-table-cell" data-label="Color"><?php echo $row["color_name"]; ?></td>
                            <td class="mybookings-table-cell" data-label="Size"><?php echo $row["size_name"]; ?></td>
                            <td class="mybookings-table-cell" data-label="Price">₹<?php echo $row["product_price"]; ?></td>
                            <td class="mybookings-table-cell" data-label="Booking Date"><?php echo $row["booking_date"]; ?>
                            </td>
                            <td class="mybookings-table-cell" data-label="Cart Qty"><?php echo $row["cart_qty"]; ?></td>
                            <td class="mybookings-table-cell" data-label="Total Amount">
                                ₹<?php echo $row["booking_amount"]; ?></td>
                            <td class="mybookings-table-cell" data-label="Seller"><?php echo $row["seller_name"]; ?></td>
                            <td class="mybookings-table-cell" data-label="Status">
                                <span class="mybookings-status-badge"><?php echo $row["booking_status"]; ?></span>
                            </td>
                            <td class="mybookings-table-cell" data-label="Action">
                                <a href="Rating.php?pid=<?php echo $row["product_id"]; ?>"
                                    class="mybookings-action-link">Rate Now</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<?php include('Foot.php'); ?>