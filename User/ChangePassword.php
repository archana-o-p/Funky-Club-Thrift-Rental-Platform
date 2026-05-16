<?php
include('../Assets/connection/connection.php');
session_start();
include('Head.php');

$sel = "select * from tbl_user where user_id=" . $_SESSION["uid"];
$res = $con->query($sel);
$row = $res->fetch_assoc();

if (isset($_POST['btn_changepassword'])) {
    $old = $_POST['txt_OldPassword'];
    $new = $_POST['txt_newpassword'];
    $retype = $_POST['txt_repasswd'];
    if ($row['user_password'] == $old) {
        if ($new == $retype) {
            $up = "update tbl_user set user_password='" . $new . "'  where user_id=" . $_SESSION['uid'];
            if ($con->query($up)) {
                ?>
                <script>
                    alert("Password updated successfully!");
                    window.location = "ChangePassword.php";
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("New password and retype password do not match!");
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Incorrect old password!");
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Change Password</title>
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
            background: linear-gradient(135deg, #585858ff 0%, #000000ff 100%);

            color: #333;
        }

        /* ========= MAIN WRAPPER ========= */
        .pw-change-wrapper {
            width: 100%;
            max-width: 450px;
            animation: pw-fade-in 0.8s ease;
        }

        /* ========= ANIMATION ========= */
        @keyframes pw-fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========= PROFILE CARD ========= */
        .pw-profile-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        /* ========= CARD HEADER ========= */
        .pw-card-header {
            background: linear-gradient(90deg, #626263ff 0%, #182848 100%);
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 1.5rem;
            letter-spacing: 1px;
        }

        /* ========= CARD BODY ========= */
        .pw-card-body {
            padding: 30px;
        }

        /* ========= FORM GRID ========= */
        .pw-form-grid {
            display: grid;
            gap: 20px;
        }

        /* ========= FORM FIELD ========= */
        .pw-form-field {
            display: flex;
            flex-direction: column;
        }

        /* ========= FORM LABEL ========= */
        .pw-form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #555;
            font-size: 15px;
        }

        /* ========= PASSWORD INPUT ========= */
        .pw-password-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #fff;
        }

        .pw-password-input:focus {
            border-color: #545557ff;
            outline: none;
            box-shadow: 0 0 6px rgba(75, 108, 183, 0.4);
        }

        /* ========= BUTTON CONTAINER ========= */
        .pw-button-container {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 10px;
        }

        /* ========= PRIMARY BUTTON ========= */
        .pw-primary-button {
            background: linear-gradient(90deg, #4b6cb7, #182848);
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            flex: 1;
            max-width: 200px;
        }

        .pw-primary-button:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(24, 40, 72, 0.4);
        }

        /* ========= CANCEL BUTTON ========= */
        .pw-cancel-button {
            background: #ccc;
            color: #000;
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
            flex: 1;
            max-width: 200px;
        }

        .pw-cancel-button:hover {
            background: #999;
            transform: scale(1.05);
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .pw-card-body {
                padding: 20px;
            }

            .pw-card-header {
                font-size: 1.3rem;
            }

            .pw-button-container {
                flex-direction: column;
            }

            .pw-primary-button,
            .pw-cancel-button {
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="pw-change-wrapper">
        <div class="pw-profile-card">
            <div class="pw-card-header">Change Password</div>
            <div class="pw-card-body">
                <form action="" method="post">
                    <div class="pw-form-grid">
                        <div class="pw-form-field">
                            <label for="txt_OldPassword" class="pw-form-label">Old Password</label>
                            <input type="password" class="pw-password-input" name="txt_OldPassword" id="txt_OldPassword"
                                required />
                        </div>
                        <div class="pw-form-field">
                            <label for="txt_newpassword" class="pw-form-label">New Password</label>
                            <input type="password" class="pw-password-input" name="txt_newpassword" id="txt_newpassword"
                                required />
                        </div>
                        <div class="pw-form-field">
                            <label for="txt_repasswd" class="pw-form-label">Re-Type Password</label>
                            <input type="password" class="pw-password-input" name="txt_repasswd" id="txt_repasswd"
                                required />
                        </div>
                        <div class="pw-button-container">
                            <input type="submit" name="btn_changepassword" id="btn_changepassword"
                                value="Update Password" class="pw-primary-button" />
                            <input type="button" name="btn_cancel" id="btn_cancel" value="Cancel"
                                class="pw-cancel-button" onclick="window.location.href='Dashboard.php';" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
include('Foot.php');
?>