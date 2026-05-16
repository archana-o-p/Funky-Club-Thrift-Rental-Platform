<?php
include('../Assets/connection/connection.php');
session_start();
include('Head.php');

$sel = "select * from tbl_user where user_id=" . $_SESSION["uid"];
$res = $con->query($sel);
$row = $res->fetch_assoc();

if (isset($_POST['btn_Update'])) {
    $name = mysqli_real_escape_string($con, $_POST['txt_name']);
    $email = mysqli_real_escape_string($con, $_POST['txt_email']);
    $contact = mysqli_real_escape_string($con, $_POST['txt_phn']);
    $address = mysqli_real_escape_string($con, $_POST['txt_address']);

    $up = "update tbl_user set user_name='$name', user_email='$email', user_contact='$contact', user_address='$address' where user_id=" . $_SESSION['uid'];
    if ($con->query($up)) {
        ?>
        <script>
            alert("Data updated successfully!");
            window.location = "myprofile.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Update Profile</title>
    <style>
        /* ========= RESET ========= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        /* ========= BODY ========= */


        /* ========= MAIN WRAPPER ========= */
        .up-main-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* ========= PROFILE CARD ========= */
        .up-profile-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
            animation: up-fade-in 0.8s ease;
        }

        /* ========= ANIMATION ========= */
        @keyframes up-fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========= CARD HEADER ========= */
        .up-card-header {
            background: linear-gradient(90deg, #626263ff 0%, #182848 100%);
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 1.5rem;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* ========= CARD BODY ========= */
        .up-card-body {
            padding: 30px;
        }

        /* ========= FORM GRID ========= */
        .up-form-grid {
            display: grid;
            gap: 20px;
        }

        /* ========= FORM FIELD ========= */
        .up-form-field {
            display: flex;
            flex-direction: column;
        }

        /* ========= FORM LABEL ========= */
        .up-form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #333;
            font-size: 15px;
        }

        /* ========= FORM INPUTS ========= */
        .up-form-input,
        .up-form-textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .up-form-input:focus,
        .up-form-textarea:focus {
            border-color: #545557ff;
            outline: none;
            box-shadow: 0 0 6px rgba(75, 108, 183, 0.4);
        }

        .up-form-textarea {
            resize: vertical;
            min-height: 80px;
        }

        /* ========= BUTTON CONTAINER ========= */
        .up-button-container {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        /* ========= UPDATE BUTTON ========= */
        .up-update-button {
            background: linear-gradient(90deg, #4b6cb7, #182848);
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 500;
        }

        .up-update-button:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(24, 40, 72, 0.4);
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .up-card-body {
                padding: 20px;
            }

            .up-card-header {
                font-size: 1.3rem;
            }

            .up-button-container {
                flex-direction: column;
            }

            .up-update-button {
                width: 100%;
                max-width: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="up-main-wrapper">
        <div class="up-profile-card">
            <div class="up-card-header">Update Profile</div>
            <div class="up-card-body">
                <form action="" method="post">
                    <div class="up-form-grid">
                        <div class="up-form-field">
                            <label for="txt_name" class="up-form-label">Name</label>
                            <input type="text" class="up-form-input" name="txt_name" id="txt_name" required
                                title="Name Allows Only Alphabets, Spaces and First Letter Must Be Capital Letter"
                                pattern="^[A-Z]+[a-zA-Z ]*$"
                                value="<?php echo htmlspecialchars($row['user_name']); ?>" />
                        </div>
                        <div class="up-form-field">
                            <label for="txt_email" class="up-form-label">Email</label>
                            <input type="email" class="up-form-input" name="txt_email" id="txt_email" required
                                value="<?php echo htmlspecialchars($row['user_email']); ?>" />
                        </div>
                        <div class="up-form-field">
                            <label for="txt_phn" class="up-form-label">Contact</label>
                            <input type="tel" class="up-form-input" name="txt_phn" id="txt_phn"
                                pattern="[6-9]{1}[0-9]{9}" title="Phone number with 6-9 and remaining 9 digits 0-9"
                                value="<?php echo htmlspecialchars($row['user_contact']); ?>" />
                        </div>
                        <div class="up-form-field">
                            <label for="txt_address" class="up-form-label">Address</label>
                            <textarea class="up-form-textarea" name="txt_address" id="txt_address"
                                required><?php echo htmlspecialchars($row['user_address']); ?></textarea>
                        </div>
                        <div class="up-button-container">
                            <input type="submit" name="btn_Update" id="btn_Update" class="up-update-button"
                                value="Update" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php include('Foot.php'); ?>