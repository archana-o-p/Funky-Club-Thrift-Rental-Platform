<?php
include('../Assets/Connection/Connection.php');
include('Head.php');
?>
<?php

if(isset($_POST["btn_submit"]))
{
	$photo=$_FILES["file_photo"]["name"];
	$tempPhoto=$_FILES["file_photo"]["tmp_name"];
	move_uploaded_file($tempPhoto,"../Assets/files/Product/".$photo);
	
	$insQry="insert into tbl_gallery(gallery_file,product_id) value('".$photo."','".$_GET['pid']."')";
	if($con->query($insQry))
	{
				?>
				<script>
			alert("data inserted")
			window.location="AddGallery.php?pid=<?php echo $_GET['pid']?>";
			</script>
			<?php
	}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_gallery  where product_id=".$_GET["did"];
	if($con->query($delQry))
	{
		?>
		<script>	
		alert("data succesfully deleted");
		window.location="AddGallery.php?pid=<?php echo $_GET['pid']?>";
		</script>
		<?php
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div style="display:flex; justify-content:center; align-items:center; min-height:100vh;">
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table border="1" cellpadding="10" cellspacing="0"> 
  <tr>
    <td>Photo</td>
    <td><label for="file_photo"></label>
      <input type="file" name="file_photo" id="file_photo" required /></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
    </div></td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="200" border="1">
  <tr>
    <td width="40">SI NO</td>
    <td width="85">Product File</td>
    <td width="53">Action</td>
  </tr>
   <?php
  $i=0;
  $sel="select * from tbl_gallery where product_id=".$_GET['pid'];
  $result = $con->query($sel);

     while ($row = $result->fetch_assoc())
	  {
    $i++;
?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><img src="../Assets/files/Product/<?php
    echo $row["gallery_file"];
	?>" width="100px" height="100px"/></td>
    <td><a href="AddGallery.php?did=<?php  echo $row["product_id"]?>&pid=<?php echo $_GET['pid']?>&pid=<?php echo $_GET['pid']?>">delete</a></td>
  </tr>
  <?php
	}
	?>
</table>
<p>&nbsp;</p>
</form>
</body>
</html>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getSubcategory(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxSubcategory.php?did=" + did,
      success: function (result) {

        $("#sel_subcategory").html(result);
      }
    });
  }
</script>
<?php include("Foot.php"); ?>