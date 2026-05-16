<?php
include('../Assets/connection/connection.php');
session_start();

?>
<?php
if(isset($_POST["btn_submit"])) {
    $email=$_POST['txt_email'];
    $password=$_POST['txt_password'];

    $selQry="SELECT * FROM tbl_user WHERE user_email='".$email."' AND user_password='".$password."'";
    $row=$con->query($selQry);

    $sellerQry="SELECT * FROM tbl_seller WHERE seller_email='".$email."' AND seller_password='".$password."'";
    $rows=$con->query($sellerQry);

    $adminQry="SELECT * FROM tbl_admin WHERE admin_email='".$email."' AND admin_password='".$password."'";
    $adminRow=$con->query($adminQry);

    if($userdata=$row->fetch_assoc()) {
        $_SESSION['uid']=$userdata['user_id'];
        $_SESSION['uname']=$userdata['user_name'];
        header("location:../user/homepage.php");
    } else if($sellerdata=$rows->fetch_assoc()) {
        if($sellerdata['seller_status'] == 1) {
            $_SESSION['sid']=$sellerdata['seller_id'];
            $_SESSION['sname']=$sellerdata['seller_name'];
            header("location:../seller/Homepage.php");
        } else if($sellerdata['seller_status'] == 2) {
            echo "<script>alert('Your Request is Rejected.');</script>";
        } else {
            echo "<script>alert('Your Request is Pending...');</script>";
        }
    } else if($admindata=$adminRow->fetch_assoc()) {
        $_SESSION['aid']=$admindata['admin_id'];
        $_SESSION['aname']=$admindata['admin_name'];
        header("location:../Admin/homepage.php");
    } else {
        echo "<script>alert('Your email and password are incorrect');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
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

/* Left: Login form */
.login-side {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #3a3838ff;
}

/* Right: Image */
.image-side {
    flex: 1;
    background-image: url('../Assets/Templates/Main/images/loginnn.jpg');
    background-size: cover;
    background-position: center;
}

/* Login box - modern aesthetic */
.login-box {
    background: #f7f9eec1;
    padding: 50px 40px;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.2);
    width: 360px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.login-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.3);
}

/* Heading */
.login-box h2 {
    margin-bottom: 40px;
    color: #333;
    font-weight: 600;
    letter-spacing: 1px;
}

/* Inputs */
.login-box input[type="text"],
.login-box input[type="password"] {
    width: 100%;
    padding: 14px 18px;
    margin: 12px 0 20px 0;
    border: 1px solid #ccc;
    border-radius: 12px;
    box-sizing: border-box;
    font-size: 16px;
    transition: 0.3s;
}

.login-box input[type="text"]:focus,
.login-box input[type="password"]:focus {
    border-color: #2d394fff;
    box-shadow: 0 0 10px rgba(46, 204, 113, 0.3);
    outline: none;
}

/* Submit button */
.login-box input[type="submit"] {
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

.login-box input[type="submit"]:hover {
    background: linear-gradient(135deg, #3b3d3dff, #3b3d3dff);
    transform: translateY(-2px);
}

/* Optional links */
.login-box a {
    color: #010c06ff;
    text-decoration: none;
    display: block;
    margin-top: 18px;
    font-weight: 500;
}

.login-box a:hover {
    text-decoration: underline;
}

/* Responsive for mobile */
@media (max-width: 768px) {
    .container {
        flex-direction: column;
    }
    .image-side {
        height: 250px;
    }
    .login-box {
        width: 90%;
        padding: 40px 30px;
    }
}
</style>
</head>
<body>

<div class="container">
    <!-- Left: Login form -->
    <div class="login-side">
        <div class="login-box">
            <h2>Welcome Back</h2>
            <form action="" method="post">
                <input type="text" name="txt_email" placeholder="Email" required>
                <input type="password" name="txt_password" placeholder="Password" required>
                <input type="submit" name="btn_submit" value="Login">
            </form>
            <a href="#">Forgot Password?</a>
        </div>
    </div>

    <!-- Right: Image -->
    <div class="image-side"></div>
</div>

</body>
</html>
