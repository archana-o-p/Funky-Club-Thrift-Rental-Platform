<?php
include('../Assets/connection/connection.php');
$materialname='';
if(isset($_POST['btn_submit']))
{
$material=$_POST['txt_material'];
$materialid=$_POST['txt_hidden'] ?? '';

if($materialid!="")
{
	$up="update tbl_material set material_name='".$material."' where material_id=".$materialid;
	if($con->query($up))
{
?>
<script>
alert("data updated")
window.location="material.php"
</script>
<?php
}
}
else
{
$ins="insert into tbl_material(material_name) value('".$material."')";
if($con->query($ins))
{
?>
<script>
alert("data inserted")
window.location="material.php"
</script>
<?php
}
}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_material where material_id=".$_GET["did"];
	if($con->query($delQry))
{
	?>
    <script>	
alert("data successfully deleted");
window.location="material.php";
</script>
<?php
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Material Management</title>

<!-- ✅ Professional CSS -->
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #f9f9f9, #eef1f7);
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
  color: #333;
}

h1 {
  margin-top: 40px;
  color: #222;
  letter-spacing: 1px;
  font-size: 28px;
  text-transform: uppercase;
  border-bottom: 3px solid #6c63ff;
  padding-bottom: 8px;
}

form {
  background: #fff;
  padding: 25px 40px;
  border-radius: 15px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
  margin-top: 30px;
  transition: 0.3s ease;
}
form:hover {
  transform: translateY(-3px);
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 25px;
  font-size: 15px;
}

table th, table td {
  border: 1px solid #ddd;
  padding: 12px 15px;
  text-align: center;
}

table th {
  background: #46414fff;
  color: white;
  font-weight: 600;
}

table tr:nth-child(even) {
  background: #f8f8ff;
}

table tr:hover {
  background-color: #f2f2ff;
  transition: 0.3s;
}

input[type="text"] {
  width: 250px;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #ccc;
  outline: none;
  transition: 0.3s;
}
input[type="text"]:focus {
  border-color: #404044ff;
  box-shadow: 0 0 5px rgba(108,99,255,0.3);
}

input[type="submit"] {
  background: #8f8dc2ff;
  border: none;
  color: white;
  padding: 10px 20px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 500;
  transition: 0.3s;
}
input[type="submit"]:hover {
  background: #5a52e0;
}

a {
  text-decoration: none;
  color: #6e6e70ff;
  font-weight: 500;
  transition: 0.3s;
}
a:hover {
  color: #777687ff;
  text-decoration: underline;
}
.container {
  width: 80%;
  max-width: 700px;
}
</style>
</head>

<body>
  <h1>Material Management</h1>
  <div class="container">
    <form action="" method="post">
      <table>
        <tr>
          <th>Material Name</th>
          <td><input type="text" name="txt_material" id="txt_material" required/></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align:center;">
            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
          </td>
        </tr>
      </table>

      <table>
        <thead>
          <tr>
            <th>SI No</th>
            <th>Material Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i=0;
          $selQry="select * from tbl_material";
          $result=$con->query($selQry);
          while($row=$result->fetch_assoc())
          {
            $i++;
          ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $row["material_name"]; ?></td>
            <td>
              <a href="material.php?did=<?php echo $row['material_id']; ?>">Delete</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </form>
  </div>
</body>
</html>
