<?php
include('../Assets/connection/connection.php');
session_start();
include('Head.php');
?>
<?php
$qry = "SELECT *
        FROM tbl_seller s
        INNER JOIN tbl_place p ON s.place_id = p.place_id
        INNER JOIN tbl_district d ON p.district_id = d.district_id 
        WHERE seller_id=" . $_SESSION['sid'];
$result = $con->query($qry);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Seller Profile</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #3f4040ff, #000000ff);

            min-height: 100vh;
            margin: 0;
        }

        .profile-card {
            position: relative;
            background: #ffffff;
            width: 420px;
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
        }

        /* 🔘 Floating Logout Icon (same style as user profile) */
        .logout-floating {
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
        }

        .logout-floating svg {
            width: 18px;
            height: 18px;
            stroke-width: 2;
        }

        .logout-floating:hover {
            background: #ef4444;
            color: #fff;
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3);
        }

        .logout-floating::after {
            content: "Logout";
            position: absolute;
            top: 50%;
            right: 115%;
            transform: translateY(-50%);
            background: #111;
            color: #fff;
            font-size: 11px;
            padding: 4px 7px;
            border-radius: 6px;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .logout-floating:hover::after {
            opacity: 1;
            right: 125%;
        }

        .profile-card img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #645868ff;
            margin-bottom: 15px;
        }

        .profile-card h2 {
            color: #2c2c2cff;
            font-size: 22px;
            margin-bottom: 5px;
        }

        .profile-card p {
            color: #555;
            margin: 4px 0;
        }

        .info-table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px 6px;
            text-align: left;
            color: #333;
        }

        .info-table td:first-child {
            font-weight: 600;
            color: #555;
            width: 40%;
        }

        .profile-actions {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .btn {
            flex: 1;
            text-align: center;
            margin: 5px;
            padding: 10px 0;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-edit,
        .btn-password {
            background-color: #000000ff;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        @media (max-width: 480px) {
            .profile-card {
                width: 90%;
                padding: 20px;
            }

            .profile-actions {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="profile-card">
        <!-- 🔘 Floating Logout Icon with Confirmation -->
        <div class="logout-floating" onclick="confirmLogout()" title="Logout">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" class="feather feather-log-out" viewBox="0 0 24 24">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                <polyline points="16 17 21 12 16 7" />
                <line x1="21" y1="12" x2="9" y2="12" />
            </svg>
        </div>

        <img src="../Assets/files/UserPhotos/<?php echo $row['seller_photo'] ?>" alt="Seller Photo"
            onerror="this.src='../Assets/files/default-user.png';">
        <h2><?php echo $row["seller_name"]; ?></h2>
        <p><?php echo $row["seller_email"]; ?></p>

        <table class="info-table">
            <tr>
                <td>Contact</td>
                <td><?php echo $row["seller_contact"]; ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><?php echo $row["seller_address"]; ?></td>
            </tr>
            <tr>
                <td>District</td>
                <td><?php echo $row["district_name"]; ?></td>
            </tr>
            <tr>
                <td>Place</td>
                <td><?php echo $row["place_name"]; ?></td>
            </tr>
        </table>

        <div class="profile-actions">
            <a href="Editprofile.php" class="btn btn-edit">Edit Profile</a>
            <a href="Changepassword.php" class="btn btn-password">Change Password</a>
        </div>
    </div>

    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "../index.php";
            }
        }
    </script>
</body>

</html>
<?php include('Foot.php'); ?>