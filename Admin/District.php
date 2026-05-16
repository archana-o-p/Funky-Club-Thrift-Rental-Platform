<?php
include('../Assets/connection/connection.php');
$districtname=$districtid="";
if(isset($_POST['btn_sub']))
{

$district=$_POST['txt_dis'];
$districtid=$_POST['txt_hidden'];
if($districtid!="")
{
	$up="update tbl_district set district_name='".$district."' where district_id=".$districtid;
	if($con->query($up))
{
?>
<script>
alert("Data Updated");
window.location="district.php";
</script>
<?php
}
}
else
{
	$ins="insert into tbl_district(district_name) value('".$district."')";
if($con->query($ins))
{
?>
<script>
alert("Data Inserted");
window.location="district.php";
</script>
<?php
}
}

}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_district where district_id=".$_GET["did"];
	if($con->query($delQry))
{
	?>
    <script>	
alert("Data Successfully Deleted");
window.location="district.php";
</script>
<?php
}
}

if(isset($_GET["eid"]))
{
	$sel="select * from tbl_district where district_id=".$_GET["eid"];
	$res=$con->query($sel);
	$data=$res->fetch_assoc();
	$districtname=$data['district_name'];
	$districtid=$data['district_id'];
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>District Management</title>

<style>
/* ===== Premium Admin Styling ===== */
body {
  font-family: "Poppins", sans-serif;
  background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
  align-items: center;
  min-height: 100vh;
}

h2 {
  margin-top: 40px;
  color: #333;
  font-size: 26px;
  font-weight: 600;
  letter-spacing: 1px;
  text-transform: uppercase;
}

form {
  background: #fff;
  padding: 30px 40px;
  border-radius: 16px;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
  margin-top: 30px;
  width: 350px;
  transition: 0.3s ease;
}

form:hover {
  transform: translateY(-3px);
}

form table {
  width: 100%;
  border: none;
}

td {
  padding: 10px;
}

input[type="text"] {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 10px;
  outline: none;
  font-size: 15px;
  transition: 0.2s;
}

input[type="text"]:focus {
  border-color: #4b6cb7;
  box-shadow: 0 0 6px rgba(75, 108, 183, 0.3);
}

input[type="submit"] {
  background: linear-gradient(135deg, #4b6cb7, #182848);
  color: #fff;
  border: none;
  padding: 10px 25px;
  border-radius: 10px;
  cursor: pointer;
  font-size: 15px;
  transition: 0.3s;
}

input[type="submit"]:hover {
  background: linear-gradient(135deg, #182848, #4b6cb7);
  transform: scale(1.05);
}

.table-container {
  margin-top: 40px;
  background: #fff;
  padding: 25px;
  border-radius: 16px;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
  width: 80%;
  max-width: 700px;
}

table {
  width: 100%;
  border-collapse: collapse;
  text-align: center;
}

th {
  background: #4b6cb7;
  color: white;
  padding: 12px;
  font-size: 15px;
  text-transform: uppercase;
}

td {
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

tr:hover {
  background-color: #f1f5ff;
}

a {
  text-decoration: none;
  color: #4b6cb7;
  font-weight: 500;
  margin: 0 6px;
  transition: 0.2s;
}

a:hover {
  color: #182848;
  text-decoration: underline;
}

</style>
</head>

<body>

<h2>District Management</h2>

<form action="" method="post">
  <table>
    <tr>
      <td><label for="txt_dis">District</label></td>
      <td>
        <input name="txt_dis" type="text" id="txt_dis" required 
               value="<?php echo $districtname; ?>" />
        <input type="hidden" name="txt_hidden" value="<?php echo $districtid; ?>" />
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_sub" id="btn_sub" value="Submit" />
      </td>
    </tr>
  </table>
</form>

<div class="table-container">
  <table>
    <tr>
      <th>#</th>
      <th>District</th>
      <th>Action</th>
    </tr>

    <?php
    $i=0;
    $selQry="select * from tbl_district";
    $result=$con->query($selQry);
    while($row=$result->fetch_assoc())
    {
      $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $row["district_name"]; ?></td>
      <td>
        <a href="district.php?eid=<?php echo $row["district_id"]; ?>"> Edit</a>
        <a href="district.php?did=<?php echo $row["district_id"]; ?>" onclick="return confirm('Are you sure you want to delete this district?');"> Delete</a>
      </td>
    </tr>
    <?php
    }
    ?>
  </table>
</div>

</body>
</html>
