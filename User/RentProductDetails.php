<?php
include('../Assets/Connection/Connection.php');
session_start();
include('Head.php');

if (!isset($_GET['pid'])) {
    echo "<script>alert('Invalid Product'); window.location='Viewrentproducts.php';</script>";
    exit;
}

$pid = $_GET['pid'];
$sel = "SELECT * FROM tbl_rentproducts p 
      INNER JOIN tbl_material m ON m.material_id=p.material_id 
      INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id 
      INNER JOIN tbl_category c ON c.category_id=s.category_id 
      INNER JOIN tbl_size sz ON sz.size_id = p.size_id 
      INNER JOIN tbl_color co ON co.color_id = p.color_id  
      INNER JOIN tbl_gender g ON g.gender_id = p.gender_id
      WHERE p.rentproduct_id = $pid";

$result = $con->query($sel);
if (!$row = $result->fetch_assoc()) {
    echo "<script>alert('Product not found'); window.location='Viewrentproducts.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($row["rentproduct_name"]); ?> - Product Details</title>
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
            background: linear-gradient(135deg, #f7f7f7, #e0e0e0);
            padding: 40px 20px;
            color: #555;
            line-height: 1.6;
        }

        /* ========= MAIN CONTAINER ========= */
        .rentdetail-main-container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            transition: 0.3s;
            animation: rentdetail-fade-in 0.6s ease;
        }

        /* ========= ANIMATION ========= */
        @keyframes rentdetail-fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .rentdetail-main-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* ========= IMAGE SECTION ========= */
        .rentdetail-image-section {
            width: 50%;
            background: #fff;
        }

        .rentdetail-product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* ========= DETAILS SECTION ========= */
        .rentdetail-details-section {
            width: 50%;
            padding: 30px;
            display: flex;
            flex-direction: column;
        }

        /* ========= PRODUCT TITLE ========= */
        .rentdetail-product-title {
            font-size: 24px;
            margin-bottom: 15px;
            color: #222;
            font-weight: 600;
        }

        /* ========= PRODUCT DESCRIPTION ========= */
        .rentdetail-product-description {
            color: #555;
            margin-bottom: 20px;
            font-size: 16px;
        }

        /* ========= INFO GRID ========= */
        .rentdetail-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }

        .rentdetail-info-item {
            display: flex;
            flex-direction: column;
        }

        .rentdetail-info-label {
            font-weight: 500;
            color: #111;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .rentdetail-info-value {
            color: #555;
            font-size: 15px;
        }

        /* ========= BOOK BUTTON ========= */
        .rentdetail-book-button {
            display: inline-block;
            background: #4CAF50;
            color: #fff;
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            margin-top: auto;
            transition: background 0.3s ease;
            align-self: flex-start;
        }

        .rentdetail-book-button:hover {
            background: #388e3c;
            text-decoration: none;
            color: #fff;
        }

        /* ========= BACK LINK ========= */
        .rentdetail-back-link {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #555;
            font-size: 14px;
            align-self: flex-start;
        }

        .rentdetail-back-link:hover {
            text-decoration: underline;
            color: #333;
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 768px) {
            body {
                padding: 20px 10px;
            }

            .rentdetail-main-container {
                flex-direction: column;
                max-width: 100%;
            }

            .rentdetail-image-section,
            .rentdetail-details-section {
                width: 100%;
            }

            .rentdetail-product-image {
                height: 300px;
            }

            .rentdetail-details-section {
                padding: 25px;
            }

            .rentdetail-product-title {
                font-size: 22px;
            }

            .rentdetail-info-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .rentdetail-details-section {
                padding: 20px;
            }

            .rentdetail-book-button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="rentdetail-main-container">
        <div class="rentdetail-image-section">
            <img class="rentdetail-product-image"
                src="../Assets/files/Product/<?php echo htmlspecialchars($row['rentproduct_photo']); ?>"
                alt="<?php echo htmlspecialchars($row["rentproduct_name"]); ?>">
        </div>
        <div class="rentdetail-details-section">
            <h1 class="rentdetail-product-title"><?php echo htmlspecialchars($row["rentproduct_name"]); ?></h1>
            <p class="rentdetail-product-description"><?php echo htmlspecialchars($row["rentproduct_details"]); ?></p>

            <div class="rentdetail-info-grid">
                <div class="rentdetail-info-item">
                    <span class="rentdetail-info-label"><strong>Category:</strong></span>
                    <span class="rentdetail-info-value"><?php echo htmlspecialchars($row["category_name"]); ?></span>
                </div>
                <div class="rentdetail-info-item">
                    <span class="rentdetail-info-label"><strong>Subcategory:</strong></span>
                    <span class="rentdetail-info-value"><?php echo htmlspecialchars($row["subcategory_name"]); ?></span>
                </div>
                <div class="rentdetail-info-item">
                    <span class="rentdetail-info-label"><strong>Material:</strong></span>
                    <span class="rentdetail-info-value"><?php echo htmlspecialchars($row["material_name"]); ?></span>
                </div>
                <div class="rentdetail-info-item">
                    <span class="rentdetail-info-label"><strong>Size:</strong></span>
                    <span class="rentdetail-info-value"><?php echo htmlspecialchars($row["size_name"]); ?></span>
                </div>
                <div class="rentdetail-info-item">
                    <span class="rentdetail-info-label"><strong>Color:</strong></span>
                    <span class="rentdetail-info-value"><?php echo htmlspecialchars($row["color_name"]); ?></span>
                </div>
                <div class="rentdetail-info-item">
                    <span class="rentdetail-info-label"><strong>Gender:</strong></span>
                    <span class="rentdetail-info-value"><?php echo htmlspecialchars($row["gender_name"]); ?></span>
                </div>
            </div>

            <a href="RentProductBooking.php?pid=<?php echo $row['rentproduct_id']; ?>"
                class="rentdetail-book-button">Book Now</a>
            <a href="Viewrentproducts.php" class="rentdetail-back-link">← Back to Products</a>
        </div>
    </div>
</body>

</html>
<?php include('Foot.php'); ?>