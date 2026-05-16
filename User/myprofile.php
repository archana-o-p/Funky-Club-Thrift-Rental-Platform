<?php
include('../Assets/connection/connection.php');
session_start();
include("Head.php");

$qry = "SELECT * FROM tbl_user u
        INNER JOIN tbl_place p ON u.place_id = p.place_id
        INNER JOIN tbl_district d ON p.district_id = d.district_id WHERE user_id=" . $_SESSION['uid'];
$result = $con->query($qry);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>User Profile</title>
    <style>
        /* ========= RESET ========= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* ========= BODY ========= */

        /* ========= MAIN WRAPPER ========= */
        .userprofile-main-wrapper {
            max-width: 420px;
            margin: 0 auto;
            animation: userprofile-slide-up 0.6s ease;
        }

        /* ========= ANIMATION ========= */
        @keyframes userprofile-slide-up {
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
        .userprofile-card {
            position: relative;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .userprofile-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
        }

        /* ========= LOGOUT BUTTON ========= */
        .userprofile-logout-button {
            position: absolute;
            top: 14px;
            right: 14px;
            background: #f1f1f1;
            color: #444;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: all 0.25s ease;
            border: none;
            font-size: 16px;
        }

        .userprofile-logout-button:hover {
            background: #ef4444;
            color: #fff;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }

        /* ========= PROFILE IMAGE ========= */
        .userprofile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 4px solid #5e426bff;
            object-fit: cover;
            margin-bottom: 15px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        /* ========= PROFILE NAME ========= */
        .userprofile-name {
            font-size: 22px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 10px;
        }

        /* ========= PROFILE EMAIL & CONTACT ========= */
        .userprofile-email,
        .userprofile-contact {
            font-size: 14px;
            color: #6b7280;
            margin: 4px 0;
        }

        /* ========= PROFILE DETAILS ========= */
        .userprofile-details-section {
            text-align: left;
            margin-top: 20px;
        }

        .userprofile-details-table {
            width: 100%;
            border-collapse: collapse;
        }

        .userprofile-details-row td {
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
            color: #374151;
            font-size: 15px;
        }

        .userprofile-details-label {
            font-weight: 600;
            color: #1f2937;
            width: 40%;
        }

        .userprofile-details-value {
            color: #374151;
        }

        /* ========= ACTIONS ========= */
        .userprofile-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            gap: 10px;
        }

        .userprofile-action-link {
            text-decoration: none;
            background: #000000ff;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.3s ease;
            flex: 1;
            text-align: center;
            display: inline-block;
        }

        .userprofile-action-link:hover {
            background: #464545ff;
        }

        /* ========= LOGOUT POPUP ========= */
        .userprofile-logout-popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .userprofile-logout-popup.active {
            visibility: visible;
            opacity: 1;
        }

        .userprofile-logout-box {
            background: #fff;
            border-radius: 15px;
            padding: 30px 40px;
            text-align: center;
            width: 320px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            animation: userprofile-popup-in 0.3s ease;
        }

        @keyframes userprofile-popup-in {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .userprofile-logout-title {
            margin: 0 0 15px;
            color: #111827;
            font-size: 18px;
            font-weight: 600;
        }

        .userprofile-logout-message {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .userprofile-popup-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .userprofile-popup-button {
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .userprofile-confirm-button {
            background: #ef4444;
            color: #fff;
        }

        .userprofile-confirm-button:hover {
            background: #dc2626;
        }

        .userprofile-cancel-button {
            background: #e5e7eb;
            color: #111;
        }

        .userprofile-cancel-button:hover {
            background: #d1d5db;
        }

        /* ========= RESPONSIVE ========= */
        @media (max-width: 480px) {
            body {
                padding: 20px 10px;
            }

            .userprofile-card {
                width: 100%;
                max-width: 90%;
                padding: 30px 20px;
            }

            .userprofile-actions {
                flex-direction: column;
            }

            .userprofile-logout-box {
                width: 90%;
                max-width: 280px;
                padding: 20px 30px;
            }

            .userprofile-popup-buttons {
                flex-direction: column;
                gap: 8px;
            }

            .userprofile-popup-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="userprofile-main-wrapper">
        <div class="userprofile-card">
            <!-- 🔘 Small professional Logout Icon -->
            <button class="userprofile-logout-button" onclick="showLogoutPopup()" title="Logout" aria-label="Logout">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" viewBox="0 0 24 24" width="18" height="18">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
            </button>

            <img src="../Assets/files/UserPhotos/<?php echo htmlspecialchars($row['user_photo']); ?>"
                alt="Profile Photo" class="userprofile-image" onerror="this.src='../Assets/files/default-user.png';" />
            <h2 class="userprofile-name"><?php echo htmlspecialchars($row["user_name"]); ?></h2>
            <p class="userprofile-email"><?php echo htmlspecialchars($row["user_email"]); ?></p>
            <p class="userprofile-contact"><?php echo htmlspecialchars($row["user_contact"]); ?></p>

            <div class="userprofile-details-section">
                <table class="userprofile-details-table">
                    <tr class="userprofile-details-row">
                        <td class="userprofile-details-label">Address</td>
                        <td class="userprofile-details-value"><?php echo htmlspecialchars($row["user_address"]); ?></td>
                    </tr>
                    <tr class="userprofile-details-row">
                        <td class="userprofile-details-label">District</td>
                        <td class="userprofile-details-value"><?php echo htmlspecialchars($row["district_name"]); ?>
                        </td>
                    </tr>
                    <tr class="userprofile-details-row">
                        <td class="userprofile-details-label">Place</td>
                        <td class="userprofile-details-value"><?php echo htmlspecialchars($row["place_name"]); ?></td>
                    </tr>
                </table>
            </div>

            <div class="userprofile-actions">
                <a href="EditProfile.php" class="userprofile-action-link">Edit Profile</a>
                <a href="ChangePassword.php" class="userprofile-action-link">Change Password</a>
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Popup -->
    <div class="userprofile-logout-popup" id="logoutPopup">
        <div class="userprofile-logout-box">
            <h3 class="userprofile-logout-title">Confirm Logout</h3>
            <p class="userprofile-logout-message">Are you sure you want to logout?</p>
            <div class="userprofile-popup-buttons">
                <button class="userprofile-popup-button userprofile-confirm-button" onclick="logoutNow()">Yes,
                    Logout</button>
                <button class="userprofile-popup-button userprofile-cancel-button"
                    onclick="closeLogoutPopup()">Cancel</button>
            </div>
        </div>
    </div>

    <script>
        function showLogoutPopup() {
            document.getElementById('logoutPopup').classList.add('active');
        }
        function closeLogoutPopup() {
            document.getElementById('logoutPopup').classList.remove('active');
        }
        function logoutNow() {
            window.location.href = '../index.php';
        }
    </script>
</body>

</html>
<?php include("Foot.php"); ?>