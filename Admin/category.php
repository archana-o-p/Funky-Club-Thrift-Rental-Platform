<?php
include('../Assets/connection/connection.php');
$categoryname='';
$categoryid='';
if(isset($_POST['btn_submit']))
{
$category=$_POST['txt_category'];
$categoryid=$_POST['txt_hidden'];
$photo=$_FILES["file_photo"]["name"];
$tempPhoto=$_FILES["file_photo"]["tmp_name"];
move_uploaded_file($tempPhoto,"../Assets/files/Photo/".$photo);
if($categoryid!="")
{
	$up="update tbl_category set category_name='".$category."' where category_id=.$categoryid";
	if($con->query($up))
{
?>
<script>
alert("data updated")
window.location="category.php"
</script>
<?php
}
}
else
{
$ins="insert into tbl_category(category_name,category_photo) value('".$category."','".$photo."')";
if($con->query($ins))
{
?>
<script>
alert("data inserted")
window.location="category.php"
</script>
<?php
}
}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_category where category_id=".$_GET["did"];
	if($con->query($delQry))
{
	?>
    <script>	
alert("data succesfully deleted");
window.location="category.php";
</script>
<?php
}
}
if(isset($_GET["eid"]))
{
	$sel="select * from tbl_category where category_id=".$_GET["eid"];
	$res=$con->query($sel);
	$data=$res->fetch_assoc();
	$categoryname=$data['category_name'];
	$categoryid=$data['category_id'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Category Management</title>

<style>
body {
  font-family: 'Poppins', sans-serif;
  background-color: #f4f6f9;
  margin: 0;
  padding: 0;
}

.container {
  max-width: 900px;
  margin: 60px auto;
  background: #fff;
  border-radius: 16px;
  padding: 40px;
  box-shadow: 0 5px 25px rgba(0,0,0,0.1);
}

h2 {
  text-align: center;
  font-size: 28px;
  color: #222;
  margin-bottom: 30px;
  font-weight: 600;
  letter-spacing: 0.5px;
}

/* --- Form Styling --- */
form table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 30px;
}

form td {
  padding: 12px;
  color: #333;
  font-size: 15px;
  vertical-align: middle;
}

form input[type="text"],
form input[type="file"] {
  width: 100%;
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 15px;
  transition: 0.3s ease;
}

form input[type="text"]:focus,
form input[type="file"]:focus {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0,123,255,0.3);
}

form input[type="submit"] {
  background: #000000ff;
  color: #fff;
  padding: 10px 20px;
  font-size: 15px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
}

form input[type="submit"]:hover {
  background: #66696cff;
}

/* --- Table Styling --- */
.data-table {
  width: 100%;
  border-collapse: collapse;
  box-shadow: 0 2px 12px rgba(0,0,0,0.05);
  overflow: hidden;
  border-radius: 10px;
}

.data-table th, .data-table td {
  padding: 14px 15px;
  text-align: center;
  font-size: 14px;
}

.data-table th {
  background: #000000ff;
  color: white;
  text-transform: uppercase;
  letter-spacing: 0.4px;
}

.data-table tr:nth-child(even) {
  background-color: #f9f9f9;
}

.data-table tr:hover {
  background-color: #f1f7ff;
}

.data-table img {
  border-radius: 10px;
  transition: transform 0.3s ease;
}

.data-table img:hover {
  transform: scale(1.08);
}

.data-table a {
  text-decoration: none;
  color: #000000ff;
  font-weight: 500;
  margin: 0 5px;
  transition: 0.3s;
}

.data-table a:hover {
  color: #d63384;
  text-decoration: underline;
}

/* --- Responsive --- */
@media (max-width: 768px) {
  .container {
    padding: 25px;
  }
  form table, .data-table {
    font-size: 13px;
  }
}
</style>
</head>

<body>
  <div class="container">
    <h2>Category Management</h2>

    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <table>
        <tr>
          <td><strong>Photo</strong></td>
          <td><input type="file" name="file_photo" id="file_photo" required /></td>
        </tr>
        <tr>
          <td><strong>Category</strong></td>
          <td>
            <input type="text" name="txt_category" id="txt_category" required value="<?php echo $categoryname; ?>" />
            <input type="hidden" name="txt_hidden" id="txt_hidden" value="<?php echo $categoryid; ?>" />
          </td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
          </td>
        </tr>
      </table>

      <table class="data-table">
        <tr>
          <th>#</th>
          <th>Category</th>
          <th>Photo</th>
          <th>Action</th>
        </tr>
        <?php
        $i=0;
        $selQry="select * from tbl_category";
        $result=$con->query($selQry);
        while($row=$result->fetch_assoc())
        {
          $i++;
        ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row["category_name"]; ?></td>
          <td><img src="../Assets/files/Photo/<?php echo $row["category_photo"]?>" width="90" height="90" /></td>
          <td>
            <a href="category.php?eid=<?php echo $row["category_id"];?>">Edit</a> |
            <a href="category.php?did=<?php echo $row["category_id"];?>">Delete</a>
          </td>
        </tr>
        <?php
        }
        ?>
      </table>
    </form>
  </div>
</body>
</html>
