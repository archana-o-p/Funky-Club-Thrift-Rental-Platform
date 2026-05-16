<?php
include('../Assets/connection/connection.php');
session_start();
include('Head.php');
?>
<?php
$sel="select * from tbl_seller where seller_id=".$_SESSION["sid"];
$res=$con->query($sel);
$row=$res->fetch_assoc();

if(isset($_POST['btn_changepassword']))
{
	$old=$_POST['txt_OldPassword'];
	$new=$_POST['txt_newpassword'];
	$retype=$_POST['txt_repasswd'];

	if($row['seller_password']==$old)
	{
		if($new==$retype)
		{
			$up="update tbl_seller set seller_password='".$new."' where seller_id=".$_SESSION['sid'];
			if($con->query($up))
			{
				?>
				<script>
				alert("Password Updated Successfully");
				window.location="ChangePassword.php";
				</script>    
				<?php
			}
		}
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>

<style>
/* === Unique, Modern Change Password Page === */
.change-pass-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #f0f4ff, #ffffff);
    font-family: 'Poppins', sans-serif;
}

.change-pass-form {
    background: #fff;
    padding: 35px 45px;
    border-radius: 14px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
    width: 360px;
    transition: all 0.3s ease-in-out;
}

.change-pass-form:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.18);
}

.change-pass-form h2 {
    text-align: center;
    color: #222;
    margin-bottom: 25px;
    font-size: 22px;
    letter-spacing: 0.5px;
}

.change-pass-form table {
    width: 100%;
    border-collapse: collapse;
}

.change-pass-form td {
    padding: 10px 0;
    font-size: 15px;
    color: #333;
    border: none;
}

.change-pass-form input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.3s;
}

.change-pass-form input[type="password"]:focus {
    border-color: #0078d7;
}

.change-pass-form input[type="submit"] {
    background-color: #0078d7;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px 0;
    width: 45%;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease;
    margin: 8px;
}

.change-pass-form input[type="submit"]:hover {
    background-color: #005fa3;
}

.change-pass-form .button-group {
    text-align: center;
    margin-top: 20px;
}

@media (max-width: 480px) {
    .change-pass-form {
        width: 90%;
        padding: 25px;
    }
    .change-pass-form h2 {
        font-size: 20px;
    }
}
</style>
</head>

<body>
<div class="change-pass-container">
    <form action="" method="post" class="change-pass-form">
        <h2>Change Password</h2>
        <table border="0" cellpadding="10" cellspacing="0">
            <tr>
                <td>Old Password</td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="txt_OldPassword" id="txt_OldPassword" required />
                </td>
            </tr>
            <tr>
                <td>New Password</td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="txt_newpassword" id="txt_newpassword" required />
                </td>
            </tr>
            <tr>
                <td>Re-Type Password</td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="txt_repasswd" id="txt_repasswd" required />
                </td>
            </tr>
            <tr>
                <td class="button-group" colspan="2">
                    <input type="submit" name="btn_changepassword" id="btn_changepassword" value="Update" />
                    <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
<?php include("Foot.php"); ?>