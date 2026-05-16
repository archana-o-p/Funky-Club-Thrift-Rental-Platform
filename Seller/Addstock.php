<?php
include('../Assets/Connection/Connection.php');
session_start();
include('Head.php');
?>
<?php
if(isset($_POST["btn_submit"]))
{
	$size=$_POST['sel_size'];
	$color=$_POST['sel_color'];
	$count=$_POST['txt_count'];
	
	$insQry="insert into tbl_stock(size_id,color_id,stock_count,product_id,stock_date) value('".$size."','".$color."','".$count."','".$_GET['pid']."',curdate())";
	if($con->query($insQry))
	{
				?>
				<script>
			alert("data inserted")
			window.location="Addstock.php?pid=<?php echo $_GET['pid']?>"
			</script>
			<?php
	}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_stock where stock_id=".$_GET["did"];
	if($con->query($delQry))
	{
		?>
		<script>	
		alert("data succesfully deleted");
		window.location="Addstock.php?pid=<?php echo $_GET['pid']?>"
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
<form id="form1" name="form1" method="post" action="">

<table border="1" cellpadding="10" cellspacing="0"> 
  <tr>
    <td>Size</td>
    <td><label for="sel_size"></label>
      <select name="sel_size" id="sel_size">
      <option>select</option>
    <?php
 $i=0;
 
  $selQry="select * from tbl_size";
  $result=$con->query($selQry);
  while($row=$result->fetch_assoc())
  {
	  $i++;
	  ?>
      <option value="<?php echo $row["size_id"] ?>">
      <?php echo $row["size_name"] ?>
      </option>
      <?php
  }
	  ?>
      </select></td>
  </tr>
  <tr>
    <td>Color</td>
    <td><label for="sel_color"></label>
      <select name="sel_color" id="sel_color">
      <option>select</option>
    <?php
 $i=0;
 
  $selQry="select * from tbl_color";
  $result=$con->query($selQry);
  while($row=$result->fetch_assoc())
  {
	  $i++;
	  ?>
      <option value="<?php echo $row["color_id"] ?>">
      <?php echo $row["color_name"] ?>
      </option>
      <?php
  }
	  ?>
      </select></td>
  </tr>
  <tr>
    <td>Count</td>
    <td><label for="txt_count"></label>
      <input type="text" name="txt_count" id="txt_count" required/></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
    </div></td>
    </tr>
</table>
<p>&nbsp;</p>
<table border="1" cellpadding="10" cellspacing="0"> 
  <tr>
    <td>SI NO</td>
    <td>Date</td>
    <td>Size</td>
    <td>Color</td>
    <td>Count</td>
    <td>Action</td>
  </tr>
  <?php
  $i=0;
  $sel="select * from tbl_stock p inner join tbl_size m on m.size_id=p.size_id inner join tbl_color s on s.color_id=p.color_id where product_id=".$_GET['pid'];
  $result = $con->query($sel);

while ($row = $result->fetch_assoc())
 {
    $i++;
?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row["stock_date"]; ?></td>
    <td><?php echo $row["size_name"]; ?></td>
    <td><?php echo $row["color_name"]; ?></td>
    <td><?php echo $row["stock_count"]; ?></td>
    <td><a href="Addstock.php?did=<?php  echo $row["stock_id"]?>&pid=<?php echo $_GET['pid']?>">delete</a></td>
  </tr>
  <?php
}
  ?>
  
</table>
<p>&nbsp;</p>
</form>
</body>
</html>
<?php include("Foot.php"); ?>