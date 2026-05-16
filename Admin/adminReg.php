<?php
include("../Assets/connection/connection.php");
$name=$admin_name="";
$email=$admin_email="";
$password="";
$adminid="";
if(isset($_POST["btn_sub"]))
{
$name=$_POST["txt_name"];
$email=$_POST["txt_email"];
$password=$_POST["txt_password"];
$adminid=$_POST['txt_hidden'];
if($adminid!="")
{
	$up = "UPDATE tbl_admin 
       SET admin_name='".$name."', 
           admin_email='".$email."', 
           admin_password='".$password."' 
       WHERE admin_id=".$adminid;

	if($con->query($up))
{
?>
<script>
alert("data updated")
window.location="adminReg.php"
</script>
<?php
}
}

else
{
$ins="INSERT INTO tbl_admin (admin_name, admin_email, admin_password) VALUES('".$name."','".$email."','".$password."')";
if($con->query($ins))
{
?>
<script>	
alert("data inserted");
window.location="adminReg.php";
</script>
<?php
}
}
}
if(isset($_GET["did"]))
{
	$delQry="DELETE FROM tbl_admin WHERE admin_id=".$_GET["did"];
	if($con->query($delQry))
{
	?>
    <script>	
alert("data succesfully deleted");
window.location="adminReg.php";
</script>
<?php
}
}	
if(isset($_GET["aid"]))
{
	$sel="SELECT * FROM tbl_admin WHERE admin_id=".$_GET["aid"];
	$res=$con->query($sel);
	$data=$res->fetch_assoc();
	$name=$data['admin_name'];
	$email=$data['admin_email'];
	$password=$data['admin_password'];
	$adminid=$data['admin_id'];
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<div style="display:flex; flex-direction:column; justify-content:center; align-items:center; min-height:100vh; gap:30px;">

    <form action="" method="post" enctype="multipart/form-data">
      <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <td width="93">Name</td>
      <td width="91"><label for="txt_name"></label>
      <input name="txt_name" type="text" id="txt_name"  required  title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" value="<?php echo $name; ?>" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input name="txt_email" type="text" id="txt_email"  required 
  title="Enter a valid email address (example: name@example.com)"
  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}" value="<?php echo $email; ?>"  />
      </td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input name="txt_password" type="password" id="txt_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" value="<?php echo $password; ?>" />
</td>
    </tr>
    <input type="hidden" name="txt_hidden" value="<?php echo $adminid; ?>" />
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_sub" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>


<table width="200" table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <td>#</td>
    <td>Name</td>
    <td>Action</td>
  </tr>
  <?php
  	$i=0;
	$qry="SELECT * FROM tbl_admin";
	$result=$con->query($qry);
	while($row=$result->fetch_assoc())
	{
		$i++;
		
		?>	
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row["admin_name"]; ?></td>
    <td><a href="adminReg.php?did=<?php echo $row["admin_id"];?>">Delete</a> <a href="adminReg.php?aid=<?php  echo $row["admin_id"];?>">edit</a></td>
  </tr>
  <?php
  
	}
?>
</table>
</body>
</html>
