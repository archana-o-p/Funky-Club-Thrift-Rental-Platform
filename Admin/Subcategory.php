<?php
include('../Assets/connection/connection.php');
if(isset($_POST["btn_submit"]))
{
	$category=$_POST['sel_category'];
	$photo=$_FILES["txt_photo"]["name"];
	$tempPhoto=$_FILES["txt_photo"]["tmp_name"];
	move_uploaded_file($tempPhoto,"../Assets/files/Photo/".$photo);
	$subcategory=$_POST['txt_subcategory'];
	echo $insQry="insert into tbl_subcategory(subcategory_name,category_id,subcategory_photo) value('".$subcategory."','".$category."','".$photo."')";
	if($con->query($insQry))
	{
		?>
<script>
alert("data inserted")
window.location="subcategory.php"
</script>
<?php
	}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_subcategory where subcategory_id=".$_GET["did"];
	if($con->query($delQry))
{
	?>
    <script>	
alert("data succesfully deleted");
window.location="subcategory.php";
</script>
<?php
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Subcategory Management</title>
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: #f4f6f9;
  margin: 0;
  padding: 0;
}

.container {
  max-width: 900px;
  margin: 50px auto;
  background: #fff;
  padding: 40px;
  border-radius: 16px;
  box-shadow: 0 4px 25px rgba(0,0,0,0.1);
}

h2 {
  text-align: center;
  color: #333;
  font-size: 28px;
  margin-bottom: 30px;
  letter-spacing: 0.5px;
}

form table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 30px;
}

form table td {
  padding: 12px 15px;
  color: #333;
  font-size: 15px;
}

form input[type="text"],
form input[type="file"],
form select {
  width: 100%;
  padding: 10px 12px;
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 15px;
  transition: 0.3s ease;
}

form input[type="text"]:focus,
form input[type="file"]:focus,
form select:focus {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0,123,255,0.3);
}

form input[type="submit"] {
  background: #007bff;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 15px;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.3s ease;
}

form input[type="submit"]:hover {
  background: #0056b3;
}

.table-container {
  margin-top: 40px;
}

.table-container table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.table-container th, .table-container td {
  padding: 12px 15px;
  text-align: center;
  border-bottom: 1px solid #eee;
  font-size: 14px;
}

.table-container th {
  background-color: #007bff;
  color: white;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.table-container tr:hover {
  background-color: #f9f9f9;
}

.table-container img {
  border-radius: 10px;
  transition: transform 0.3s ease;
}

.table-container img:hover {
  transform: scale(1.1);
}

.table-container a {
  text-decoration: none;
  color: #e74c3c;
  font-weight: 500;
}

.table-container a:hover {
  text-decoration: underline;
}
</style>
</head>
<body>

<div class="container">
  <h2>Subcategory Management</h2>
  <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
    <table>
      <tr>
        <td width="60">Category</td>
        <td width="182">
          <select name="sel_category" id="sel_category" required>
            <option value="">Select</option>
            <?php
            $selQry="select * from tbl_category";
            $result=$con->query($selQry);
            while($row=$result->fetch_assoc())
            {
              ?>
              <option value="<?php echo $row["category_id"] ?>">
              <?php echo $row["category_name"] ?>
              </option>
              <?php
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Subcategory</td>
        <td><input type="text" name="txt_subcategory" id="txt_subcategory" required /></td>
      </tr>
      <tr>
        <td>Photo</td>
        <td><input type="file" name="txt_photo" id="txt_photo" required /></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        </td>
      </tr>
    </table>

    <div class="table-container">
      <table>
        <tr>
          <th>S.No</th>
          <th>Category</th>
          <th>Subcategory</th>
          <th>Photo</th>
          <th>Action</th>
        </tr>
        <?php
        $i=0;
        $selQry="select * from tbl_subcategory p INNER JOIN tbl_category d on p.category_id=d.category_id";
        $result=$con->query($selQry);
        while($row=$result->fetch_assoc())
        {
          $i++;
          ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row["category_name"]; ?></td>
          <td><?php echo $row["subcategory_name"]; ?></td>
          <td><img src="../Assets/files/Photo/<?php echo $row["subcategory_photo"]; ?>" width="90" height="90"></td>
          <td><a href="subcategory.php?did=<?php echo $row["subcategory_id"]; ?>">Delete</a></td>
        </tr>
        <?php
        }
        ?>
      </table>
    </div>
  </form>
</div>

</body>
</html>
