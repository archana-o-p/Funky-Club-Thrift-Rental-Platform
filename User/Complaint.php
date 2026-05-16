<?php
include('../Assets/connection/connection.php');
session_start(); 
include('Head.php');

// ✅ Insert complaint
if(isset($_POST['btn_submit']))
{
    $title = mysqli_real_escape_string($con, $_POST['txt_title']);
    $content = mysqli_real_escape_string($con, $_POST['txt_content']);
    $product = $_POST['sel_product'];

    $insQry = "INSERT INTO tbl_complaint(complaint_title, complaint_content, user_id, product_id, complaint_date) 
               VALUES ('".$title."', '".$content."', '".$_SESSION['uid']."', '".$product."', NOW())";

    if($con->query($insQry))
    {
        ?>
        <script>
            alert("Complaint submitted successfully");
            window.location="Complaint.php";
        </script>
        <?php
    }
}

// ✅ Delete complaint
if(isset($_GET["did"]))
{
    $delQry = "DELETE FROM tbl_complaint WHERE complaint_id=".$_GET["did"];
    if($con->query($delQry))
    {
        ?>
        <script>
            alert("Complaint successfully deleted");
            window.location="Complaint.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>User Complaint</title>
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
            background-color: #4a4c4eff;
            padding: 40px 0;
            color: #374151;
        }

        /* ========= MAIN CONTAINER ========= */
        .complaint-main-container {
            max-width: 1100px;
            background: #fff;
            margin: 0 auto;
            padding: 40px 50px;
            border-radius: 16px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
            animation: complaint-slide-in 0.6s ease;
        }

        /* ========= ANIMATION ========= */
        @keyframes complaint-slide-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========= PAGE TITLE ========= */
        .complaint-page-title {
            text-align: center;
            color: #1f2937;
            font-size: 28px;
            margin-bottom: 35px;
            font-weight: 600;
        }

        /* ========= SUBMIT FORM SECTION ========= */
        .complaint-submit-section {
            margin-bottom: 50px;
        }

        .complaint-form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }

        /* ========= FORM FIELD ========= */
        .complaint-form-field {
            display: flex;
            flex-direction: column;
        }

        .complaint-form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #374151;
            font-size: 15px;
        }

        .complaint-form-select,
        .complaint-form-input,
        .complaint-form-textarea {
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .complaint-form-select:focus,
        .complaint-form-input:focus,
        .complaint-form-textarea:focus {
            border-color: #3f4248ff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .complaint-form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* ========= SUBMIT BUTTON ========= */
        .complaint-submit-button {
            background: #000000;
            color: white;
            font-weight: 600;
            cursor: pointer;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 15px;
            transition: background 0.3s ease;
            grid-column: 1 / -1;
            justify-self: center;
        }

        .complaint-submit-button:hover {
            background: #2c2a2aff;
        }

        /* ========= COMPLAINTS TABLE SECTION ========= */
        .complaint-table-section {
            margin-top: 50px;
        }

        .complaint-section-title {
            color: #1f2937;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .complaint-table-wrapper {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .complaint-table {
            width: 100%;
            border-collapse: collapse;
        }

        .complaint-table-header {
            background-color: #000000;
            color: #fff;
        }

        .complaint-table-header th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 500;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .complaint-table-row {
            transition: background-color 0.3s ease;
        }

        .complaint-table-row:hover {
            background-color: #f1f5f9;
        }

        .complaint-table-cell {
            padding: 12px 15px;
            border-bottom: 1px solid #e5e7eb;
            color: #374151;
            font-size: 15px;
        }

        /* ========= DELETE LINK ========= */
        .complaint-delete-link {
            color: #dc2626;
            font-weight: 500;
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 6px;
            display: inline-block;
            transition: all 0.2s ease;
        }

        .complaint-delete-link:hover {
            background: #fee2e2;
            text-decoration: underline;
        }

        /* ========= REPLY STATUS ========= */
        .complaint-reply-status {
            font-weight: 500;
        }

        .complaint-reply-replied {
            color: #16a34a;
        }

        .complaint-reply-noreply {
            color: #9ca3af;
            font-style: italic;
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 768px) {
            .complaint-main-container {
                padding: 30px 20px;
            }

            .complaint-form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .complaint-table-header th,
            .complaint-table-cell {
                padding: 10px 8px;
                font-size: 13px;
            }

            .complaint-page-title,
            .complaint-section-title {
                font-size: 22px;
            }
        }

        @media (max-width: 480px) {
            .complaint-table-header {
                display: none;
            }

            .complaint-table-cell {
                display: block;
                text-align: left;
                border-bottom: 1px solid #e5e7eb;
                padding: 12px;
            }

            .complaint-table-cell:before {
                content: attr(data-label) ": ";
                font-weight: bold;
                color: #1f2937;
            }
        }
    </style>
</head>

<body>
    <div class="complaint-main-container">
        <h1 class="complaint-page-title">Submit a Complaint</h1>

        <div class="complaint-submit-section">
            <form action="" method="post">
                <div class="complaint-form-grid">
                    <div class="complaint-form-field">
                        <label for="sel_product" class="complaint-form-label">Product</label>
                        <select class="complaint-form-select" name="sel_product" id="sel_product" required>
                            <option value="">-- Select Product --</option>
                            <?php
                            $selProduct = "SELECT * FROM tbl_product";
                            $resultProduct = $con->query($selProduct);
                            while($rowProduct = $resultProduct->fetch_assoc())
                            {
                                echo '<option value="'.$rowProduct["product_id"].'">'.$rowProduct["product_name"].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="complaint-form-field">
                        <label for="txt_title" class="complaint-form-label">Title</label>
                        <input type="text" class="complaint-form-input" name="txt_title" id="txt_title" required />
                    </div>
                    <div class="complaint-form-field">
                        <label for="txt_content" class="complaint-form-label">Content</label>
                        <textarea class="complaint-form-textarea" name="txt_content" id="txt_content" required></textarea>
                    </div>
                    <input type="submit" class="complaint-submit-button" name="btn_submit" id="btn_submit" value="Submit Complaint" />
                </div>
            </form>
        </div>

        <div class="complaint-table-section">
            <h1 class="complaint-section-title">Your Complaints</h1>
            <div class="complaint-table-wrapper">
                <table class="complaint-table">
                    <thead class="complaint-table-header">
                        <tr>
                            <th>S.No</th>
                            <th>Product</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Date</th>
                            <th>Reply</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        $selQry = "SELECT * FROM tbl_complaint c
                                   LEFT JOIN tbl_product p ON c.product_id = p.product_id
                                   WHERE c.user_id = '".$_SESSION['uid']."'
                                   ORDER BY c.complaint_date DESC";
                        $result = $con->query($selQry);
                        while($row = $result->fetch_assoc())
                        {
                            $i++;
                            ?>
                            <tr class="complaint-table-row">
                                <td class="complaint-table-cell" data-label="S.No"><?php echo $i; ?></td>
                                <td class="complaint-table-cell" data-label="Product"><?php echo $row["product_name"]; ?></td>
                                <td class="complaint-table-cell" data-label="Title"><?php echo $row["complaint_title"]; ?></td>
                                <td class="complaint-table-cell" data-label="Content"><?php echo $row["complaint_content"]; ?></td>
                                <td class="complaint-table-cell" data-label="Date"><?php echo $row["complaint_date"]; ?></td>
                                <td class="complaint-table-cell" data-label="Reply">
                                    <?php 
                                    if ($row['complaint_status'] == 1)
                                    {
                                        echo "<span class='complaint-reply-status complaint-reply-replied'>".$row["complaint_reply"]."</span>";
                                    }
                                    else
                                    {
                                        echo "<span class='complaint-reply-status complaint-reply-noreply'>Not replied</span>";
                                    }
                                    ?>
                                </td>
                                <td class="complaint-table-cell" data-label="Action">
                                    <a href="Complaint.php?did=<?php echo $row["complaint_id"]; ?>" class="complaint-delete-link">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
<?php include('Foot.php'); ?>