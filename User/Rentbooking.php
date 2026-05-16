<?php
include('../Assets/Connection/Connection.php');
session_start();
include('Head.php');

if (!isset($_GET['pid'])) {
    echo "<script>alert('Invalid product'); window.location='ViewProduct.php';</script>";
    exit;
}

$rentproduct_id = $_GET['pid'];

if (isset($_POST["btn_submit"])) {
    $from = mysqli_real_escape_string($con, $_POST['txt_fdate']);
    $to = mysqli_real_escape_string($con, $_POST['txt_tdate']);
    $address = mysqli_real_escape_string($con, $_POST['txt_address']);

    $start = new DateTime($from);
    $end = new DateTime($to);
    $diff = $start->diff($end);
    $days = $diff->days + 1; // Include both start and end days for rental

    if ($days <= 0) {
        echo "<script>alert('To date must be after from date'); window.location='RentProductBooking.php?pid=$rentproduct_id';</script>";
        exit;
    }

    $SelQry = "SELECT * FROM tbl_rentproducts WHERE rentproduct_id=$rentproduct_id";
    $res = $con->query($SelQry);
    if ($res->num_rows == 0) {
        echo "<script>alert('Product not found'); window.location='ViewProduct.php';</script>";
        exit;
    }
    $row = $res->fetch_assoc();
    $productprice = $row["rentproduct_price"];

    $amt = $days * $productprice;

    $insQry = "INSERT INTO tbl_rentproductbooking
               (rentproductbooking_fromdate, rent_address, rentproductbooking_todate, user_id, rentproduct_id, rentproductbooking_date, rentproductbooking_amount) 
               VALUES ('$from', '$address', '$to', '" . $_SESSION['uid'] . "', '$rentproduct_id', CURDATE(), '$amt')";

    if ($con->query($insQry)) {
        ?>
        <script>
            alert("Booking request submitted successfully!");
            window.location = "MyRentBooking.php";
        </script>
        <?php
    } else {
        echo "<script>alert('Booking failed. Please try again.'); window.location='RentProductBooking.php?pid=$rentproduct_id';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Rent Product Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
            background: linear-gradient(135deg, #797280ff, #797280ff);
            min-height: 100vh;

            color: #333;
        }

        /* ========= MAIN CARD ========= */
        .rentbooking-main-card {
            width: 100%;
            max-width: 450px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
            animation: rentbooking-fade-in 0.6s ease;
        }

        /* ========= ANIMATION ========= */
        @keyframes rentbooking-fade-in {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========= CARD HEADER ========= */
        .rentbooking-card-header {
            background: linear-gradient(135deg, #000000ff, #000000ff);
            color: #fff;
            text-align: center;
            padding: 25px 20px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .rentbooking-header-title {
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 24px;
        }

        .rentbooking-header-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin: 0;
        }

        /* ========= CARD BODY ========= */
        .rentbooking-card-body {
            padding: 30px 25px;
        }

        /* ========= FORM ========= */
        .rentbooking-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* ========= FORM FIELD ========= */
        .rentbooking-form-field {
            display: flex;
            flex-direction: column;
        }

        .rentbooking-form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #333;
            font-size: 15px;
        }

        .rentbooking-form-input,
        .rentbooking-form-textarea {
            padding: 12px 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 15px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: #fff;
        }

        .rentbooking-form-input:focus,
        .rentbooking-form-textarea:focus {
            border-color: #000000ff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        }

        .rentbooking-form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* ========= SUBMIT BUTTON ========= */
        .rentbooking-submit-button {
            background: linear-gradient(135deg, #000000ff, #000000ff);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: 500;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            text-align: center;
        }

        .rentbooking-submit-button:hover {
            background: linear-gradient(135deg, #6b727aff, #2f3132ff);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .rentbooking-main-card {
                max-width: 100%;
            }

            .rentbooking-card-body {
                padding: 25px 20px;
            }

            .rentbooking-header-title {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>
    <div class="rentbooking-main-card">
        <div class="rentbooking-card-header">
            <h3 class="rentbooking-header-title">Rent Product Booking</h3>
            <p class="rentbooking-header-subtitle">Select dates and enter your address to confirm booking</p>
        </div>
        <div class="rentbooking-card-body">
            <form class="rentbooking-form" id="form1" name="form1" method="post" action="">
                <div class="rentbooking-form-field">
                    <label for="txt_fdate" class="rentbooking-form-label">From Date</label>
                    <input type="date" class="rentbooking-form-input" name="txt_fdate" id="txt_fdate"
                        min="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="rentbooking-form-field">
                    <label for="txt_tdate" class="rentbooking-form-label">To Date</label>
                    <input type="date" class="rentbooking-form-input" name="txt_tdate" id="txt_tdate"
                        min="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="rentbooking-form-field">
                    <label for="txt_address" class="rentbooking-form-label">Delivery Address</label>
                    <textarea class="rentbooking-form-textarea" name="txt_address" id="txt_address" required></textarea>
                </div>
                <div class="rentbooking-form-field">
                    <input type="submit" class="rentbooking-submit-button" name="btn_submit" id="btn_submit"
                        value="Book Now">
                </div>
            </form>
        </div>
    </div>

    <script>
        // Dynamic min date for to date based on from date
        document.getElementById('txt_fdate').addEventListener('change', function () {
            const fromDate = this.value;
            document.getElementById('txt_tdate').min = fromDate;
        });
    </script>
</body>

</html>
<?php include('Foot.php'); ?>