<?php
include('../Assets/Connection/Connection.php');
session_start();
include("Head.php");

if (isset($_GET["did"])) {
    $AcceptQry = "UPDATE tbl_rentproductbooking SET rentproductbooking_status=1 WHERE rentproductbooking_id=" . $_GET["did"];
    if ($con->query($AcceptQry)) {
        ?>
        <script>
            alert("Accepted");
            window.location = "ViewRentBooking.php";
        </script>
        <?php
    }
}
if (isset($_GET["eid"])) {
    $rejectQry = "UPDATE tbl_rentproductbooking SET rentproductbooking_status=2 WHERE rentproductbooking_id=" . $_GET["eid"];
    if ($con->query($rejectQry)) {
        ?>
        <script>
            alert("Rejected");
            window.location = "ViewRentBooking.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Rent Bookings</title>
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
            background: radial-gradient(circle at top left, #0f2027, #203a43, #2c5364);
            color: #f5f5f5;
            min-height: 100vh;
            padding: 40px 20px;
        }

        /* ========= MAIN CONTAINER ========= */
        .viewrent-main-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
            animation: viewrent-fade-in 1s ease-in-out;
        }

        /* ========= ANIMATION ========= */
        @keyframes viewrent-fade-in {
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
        .viewrent-header {
            text-align: center;
            background: linear-gradient(90deg, #0072ff, #00c6ff);
            color: #fff;
            padding: 18px 0;
            border-radius: 14px;
            margin-bottom: 25px;
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: 1px;
            text-shadow: 0 1px 4px rgba(0, 0, 0, 0.3);
        }

        /* ========= TABLE ========= */
        .viewrent-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            border-radius: 12px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.05);
        }

        .viewrent-table-header {
            background: linear-gradient(90deg, #004e92, #000428);
        }

        .viewrent-table-header th {
            color: #fff;
            padding: 15px 10px;
            font-size: 15px;
            letter-spacing: 0.5px;
            font-weight: 500;
            text-transform: uppercase;
        }

        .viewrent-table-row {
            transition: background 0.3s ease;
        }

        .viewrent-table-row:hover td {
            background: rgba(0, 198, 255, 0.15);
        }

        .viewrent-table-cell {
            padding: 12px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: #e6e6e6;
            font-size: 14px;
        }

        .viewrent-product-image {
            border-radius: 10px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            object-fit: cover;
            width: 80px;
            height: 80px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
        }

        /* ========= STATUS BADGE ========= */
        .viewrent-status-badge {
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 18px;
            font-size: 14px;
            display: inline-block;
            border: 1px solid;
        }

        .viewrent-status-accepted {
            background: rgba(40, 167, 69, 0.15);
            color: #28a745;
            border-color: #28a745;
        }

        .viewrent-status-rejected {
            background: rgba(220, 53, 69, 0.15);
            color: #dc3545;
            border-color: #dc3545;
        }

        .viewrent-status-pending {
            background: rgba(255, 193, 7, 0.15);
            color: #ffc107;
            border-color: #ffc107;
        }

        /* ========= ACTION LINKS ========= */
        .viewrent-action-link {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 25px;
            transition: 0.3s ease;
            margin: 2px;
            display: inline-block;
        }

        .viewrent-action-accept {
            background: linear-gradient(90deg, #28a745, #218838);
        }

        .viewrent-action-reject {
            background: linear-gradient(90deg, #dc3545, #b02a37);
        }

        .viewrent-action-link:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 900px) {
            .viewrent-table {
                font-size: 13px;
            }

            .viewrent-product-image {
                width: 60px;
                height: 60px;
            }

            .viewrent-header {
                font-size: 1.4rem;
            }
        }

        @media (max-width: 600px) {
            .viewrent-table-wrapper {
                overflow-x: auto;
            }

            .viewrent-table {
                min-width: 800px;
            }

            .viewrent-main-container {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="viewrent-main-container">
        <div class="viewrent-header">📦 View Rent Bookings</div>
        <div class="viewrent-table-wrapper">
            <table class="viewrent-table">
                <thead class="viewrent-table-header">
                    <tr>
                        <th>SI No</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Product Name</th>
                        <th>Gender</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Photo</th>
                        <th>Price</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Total</th>
                        <th>Status / Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    $sel = "SELECT * 
                            FROM tbl_rentproducts p 
                            INNER JOIN tbl_rentproductbooking m ON m.rentproduct_id = p.rentproduct_id 
                            INNER JOIN tbl_user w ON w.user_id = m.user_id 
                            INNER JOIN tbl_size sz ON sz.size_id = p.size_id 
                            INNER JOIN tbl_color co ON co.color_id = p.color_id
                            INNER JOIN tbl_gender g ON g.gender_id = p.gender_id";

                    $result = $con->query($sel);

                    while ($row = $result->fetch_assoc()) {
                        $i++;
                        ?>
                        <tr class="viewrent-table-row">
                            <td class="viewrent-table-cell"><?php echo $i; ?></td>
                            <td class="viewrent-table-cell"><?php echo htmlspecialchars($row["user_name"]); ?></td>
                            <td class="viewrent-table-cell"><?php echo htmlspecialchars($row["user_email"]); ?></td>
                            <td class="viewrent-table-cell"><?php echo htmlspecialchars($row["rentproduct_name"]); ?></td>
                            <td class="viewrent-table-cell"><?php echo htmlspecialchars($row["gender_name"]); ?></td>
                            <td class="viewrent-table-cell"><?php echo htmlspecialchars($row["color_name"]); ?></td>
                            <td class="viewrent-table-cell"><?php echo htmlspecialchars($row["size_name"]); ?></td>
                            <td class="viewrent-table-cell">
                                <img src="../Assets/files/Product/<?php echo htmlspecialchars($row['rentproduct_photo']); ?>"
                                    alt="Product Image" class="viewrent-product-image">
                            </td>
                            <td class="viewrent-table-cell"><?php echo $row["rentproduct_price"]; ?></td>
                            <td class="viewrent-table-cell"><?php echo $row["rentproductbooking_fromdate"]; ?></td>
                            <td class="viewrent-table-cell"><?php echo $row["rentproductbooking_todate"]; ?></td>
                            <td class="viewrent-table-cell"><?php echo $row["rentproductbooking_amount"]; ?></td>
                            <td class="viewrent-table-cell">
                                <?php
                                if ($row["rentproductbooking_status"] == 1) {
                                    echo "<span class='viewrent-status-badge viewrent-status-accepted'>Accepted</span>";
                                } elseif ($row["rentproductbooking_status"] == 2) {
                                    echo "<span class='viewrent-status-badge viewrent-status-rejected'>Rejected</span>";
                                } else {
                                    echo "<span class='viewrent-status-badge viewrent-status-pending'>Pending</span><br><br>";
                                    echo "<a class='viewrent-action-link viewrent-action-accept' href='ViewRentBooking.php?did=" . $row["rentproductbooking_id"] . "'>Accept</a> ";
                                    echo "<a class='viewrent-action-link viewrent-action-reject' href='ViewRentBooking.php?eid=" . $row["rentproductbooking_id"] . "'>Reject</a>";
                                }
                                ?>
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
<?php include("Foot.php"); ?>