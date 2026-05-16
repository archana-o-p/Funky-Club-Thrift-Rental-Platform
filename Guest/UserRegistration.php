<?php
include('../Assets/connection/connection.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Registration</title>
<style>
html, body {
    height: 100%;
    margin: 0;
    font-family: 'Poppins', Arial, sans-serif;
}

/* Split screen layout */
.container {
    display: flex;
    height: 100vh;
}

/* Left side - registration form */
.register-side {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #3a3838ff;
}

/* Right side - background image */
.image-side {
    flex: 2;
    background-image: url('../Assets/Templates/Main/images/U2.jpg');
    background-size: cover;
    background-position: center;
}

/* Registration box styling */
.register-box {
    background: #f7f9eec1;
    padding: 25px 30px;          /* reduced padding for better fit */
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    width: 420px;                /* compact width */
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    max-height: 85vh;            /* ensures it fits within viewport */
    overflow-y: auto;            /* scrolls only if needed */
}

.register-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.3);
}

.register-box h2 {
    margin-bottom: 30px;
    color: #333;
    font-weight: 600;
}

/* Form table styling */
.register-box table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

.register-box td {
    padding: 10px 8px;
    border: none;
    color: #222;
}

/* Inputs and textarea */
.register-box input[type="text"],
.register-box input[type="email"],
.register-box input[type="password"],
.register-box input[type="file"],
.register-box textarea,
.register-box select {
    width: 100%;
    padding: 12px 15px;
    margin-top: 6px;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-sizing: border-box;
    font-size: 15px;
    transition: 0.3s;
}

.register-box input:focus,
.register-box select:focus,
.register-box textarea:focus {
    border-color: #2d394fff;
    box-shadow: 0 0 10px rgba(46, 204, 113, 0.3);
    outline: none;
}

/* Submit button */
.register-box input[type="submit"] {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #050d08ff, #000000ff);
    border: none;
    border-radius: 12px;
    color: white;
    font-size: 18px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

.register-box input[type="submit"]:hover {
    background: linear-gradient(135deg, #3b3d3dff, #3b3d3dff);
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }
    .image-side {
        height: 250px;
    }
    .register-box {
        width: 90%;
    }
}
</style>
</head>
<body>

<div class="container">
    <!-- Left side (form) -->
    <div class="register-side">
        <div class="register-box">
            <h2>Create Account</h2>
            
            <!-- Keep your PHP form inside this -->
            <?php
            include('../Assets/connection/connection.php');
            if(isset($_POST["btn_submit"]))
            {
                $name=$_POST['txt_name'];
                $email=$_POST['txt_email'];
                $contact=$_POST['txt_contact'];
                $address=$_POST['txt_address'];
                $place=$_POST['sel_place'];
                $photo=$_FILES["pht_photo"]["name"];
                $tempPhoto=$_FILES["pht_photo"]["tmp_name"];
                move_uploaded_file($tempPhoto,"../Assets/files/UserPhotos/".$photo);
                $password=$_POST['pss_password'];
                $insQry="insert into tbl_user(user_name,user_email,user_contact,user_address,user_photo,user_password,place_id) value('".$name."','".$email."','".$contact."','".$address."','".$photo."','".$password."','".$place."')";
                if($con->query($insQry))
                {
                ?>
                <script>
                alert("Data inserted");
                window.location="UserRegistration.php";
                </script>
                <?php
                }
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <table cellpadding="5">
                    <tr>
                        <td>Name</td>
                        <td><input type="text" name="txt_name" required pattern="^[A-Z]+[a-zA-Z ]*$" title="First letter must be capital"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="txt_email"></td>
                    </tr>
                    <tr>
                        <td>Contact</td>
                        <td><input type="text" name="txt_contact" pattern="[6-9]{1}[0-9]{9}" title="Valid 10-digit number"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><textarea name="txt_address" rows="3"></textarea></td>
                    </tr>
                    <tr>
                        <td>District</td>
                        <td>
                            <select name="sel_district" id="sel_district" onchange="getPlace(this.value)">
                                <option value="">Select</option>
                                <?php
                                $selQry="select * from tbl_district";
                                $result=$con->query($selQry);
                                while($row=$result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row["district_id"] ?>"><?php echo $row["district_name"] ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Place</td>
                        <td><select name="sel_place" id="sel_place"><option>Select</option></select></td>
                    </tr>
                    <tr>
                        <td>Photo</td>
                        <td><input type="file" name="pht_photo"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="pss_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must include uppercase, lowercase, number, 8+ chars"></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <input type="submit" name="btn_submit" value="Register">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <!-- Right side - image -->
    <div class="image-side"></div>
</div>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
function getPlace(did) {
    $.ajax({
        url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
        success: function (result) {
            $("#sel_place").html(result);
        }
    });
}
</script>
</body>
</html>
