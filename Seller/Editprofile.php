<?php
include('../Assets/connection/connection.php');
session_start();
include('Head.php');
?>
<?php
$sel="select * from tbl_seller where seller_id=".$_SESSION["sid"];
$res=$con->query($sel);
$row=$res->fetch_assoc();

if(isset($_POST['btn_Update']))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$contact=$_POST['txt_phn'];
	$address=$_POST['txt_address'];

	$up="update tbl_seller set seller_name='".$name."', seller_email='".$email."', seller_contact='".$contact."', seller_address='".$address."' where seller_id=".$_SESSION['sid'];
	if($con->query($up))
	{
		?>
		<script>
		alert("Data Updated Successfully");
		window.location="Myprofile.php";
		</script>
		<?php
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update Profile</title>

<style>
/* === Unique Styling for Seller Profile Update === */
.seller-edit-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: linear-gradient(135deg, #f0f4ff, #ffffff);
    font-family: 'Poppins', sans-serif;
}

.seller-edit-form {
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    width: 380px;
    transition: all 0.3s ease-in-out;
}

.seller-edit-form:hover {
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
}

.seller-edit-form h2 {
    text-align: center;
    color: #2d2d2d;
    margin-bottom: 25px;
    font-size: 22px;
    letter-spacing: 0.5px;
}

.seller-edit-form table {
    width: 100%;
  
}

.seller-edit-form td {
    padding: 10px 0;
    font-size: 15px;
    color: #333;
}

.seller-edit-form input[type="text"],
.seller-edit-form textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.3s;
}

.seller-edit-form input[type="text"]:focus,
.seller-edit-form textarea:focus {
    border-color: #0078d7;
}

.seller-edit-form textarea {
    resize: none;
}

.seller-edit-form input[type="submit"] {
    width: 100%;
    background: #0078d7;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s ease;
}

.seller-edit-form input[type="submit"]:hover {
    background: #005fa3;
}

@media (max-width: 480px) {
    .seller-edit-form {
        width: 90%;
        padding: 20px;
    }
}
</style>
</head>

<body>
<div class="seller-edit-container">
    <form action="" method="post" class="seller-edit-form">
        <h2>Update Seller Profile</h2>
        <table border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td>Name</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="txt_name" id="txt_name" required 
                        title="Name allows only alphabets, spaces and must start with a capital letter"
                        pattern="^[A-Z]+[a-zA-Z ]*$"
                        value="<?php echo $row['seller_name']?>"/>
                </td>
            </tr>
            <tr>
                <td>Email</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="txt_email" id="txt_email" required 
                        value="<?php echo $row['seller_email']?>" />
                </td>
            </tr>
            <tr>
                <td>Contact</td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="txt_phn" id="txt_phn" pattern="[6-9]{1}[0-9]{9}"
                        title="Phone number must start with 6-9 and contain 10 digits"
                        value="<?php echo $row['seller_contact']?>" />
                </td>
            </tr>
            <tr>
                <td>Address</td>
            </tr>
            <tr>
                <td>
                    <textarea name="txt_address" id="txt_address" cols="45" rows="5"><?php echo $row['seller_address']?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" name="btn_Update" id="btn_Update" value="Update" />
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
<?php include("Foot.php"); ?>