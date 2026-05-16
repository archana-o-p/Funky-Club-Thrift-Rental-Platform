<?php
include('../Assets/connection/connection.php');
if(isset($_POST["btn_submit"]))
{
	$district=$_POST['sel_district'];
	$place=$_POST['txt_place'];
	$insQry="insert into tbl_place(place_name,district_id) value('".$place."','".$district."')";
	if($con->query($insQry))
	{
		?>
<script>
alert("Data inserted successfully");
window.location="place.php";
</script>
<?php
	}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_place where district_id=".$_GET["did"];
	if($con->query($delQry))
{
	?>
    <script>	
alert("Data successfully deleted");
window.location="place.php";
</script>
<?php
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Place Management</title>
<style>
  /* ===== Professional Dashboard Styling ===== */
  body {
    font-family: "Poppins", sans-serif;
    background: linear-gradient(135deg, #e3f2fd, #bbdefb);
    margin: 0;
    padding: 0;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
  }

  h2 {
    margin-top: 50px;
    font-size: 26px;
    color: #0d47a1;
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  /* ===== Form Card ===== */
  .form-card {
    background: #fff;
    margin-top: 30px;
    padding: 35px 40px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    width: 420px;
    transition: all 0.3s ease;
  }

  .form-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  label {
    font-weight: 500;
    color: #333;
    margin-bottom: 5px;
  }

  select, input[type="text"] {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    outline: none;
    font-size: 15px;
    transition: all 0.3s;
  }

  select:focus, input[type="text"]:focus {
    border-color: #1565c0;
    box-shadow: 0 0 6px rgba(21, 101, 192, 0.2);
  }

  input[type="submit"] {
    background: linear-gradient(135deg, #1565c0, #0d47a1);
    color: white;
    border: none;
    padding: 12px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
    letter-spacing: 0.5px;
    transition: all 0.3s;
  }

  input[type="submit"]:hover {
    background: linear-gradient(135deg, #0d47a1, #1976d2);
    transform: scale(1.03);
  }

  /* ===== Table Section ===== */
  .table-container {
    margin-top: 50px;
    background: #fff;
    padding: 25px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    width: 85%;
    max-width: 850px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th, td {
    text-align: center;
    padding: 12px 10px;
  }

  th {
    background: #0d47a1;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    font-size: 15px;
  }

  tr:nth-child(even) {
    background-color: #f1f5ff;
  }

  tr:hover {
    background-color: #e3f2fd;
  }

  td {
    border-bottom: 1px solid #ddd;
  }

  a {
    text-decoration: none;
    color: #e53935;
    font-weight: 500;
    transition: 0.2s;
  }

  a:hover {
    color: #b71c1c;
    text-decoration: underline;
  }

  @media (max-width: 768px) {
    .form-card {
      width: 90%;
    }
    .table-container {
      width: 95%;
    }
  }
</style>
</head>

<body>

<h2>Place Management</h2>

<div class="form-card">
  <form action="" method="post">
    <div>
      <label for="sel_district">District</label>
      <select name="sel_district" id="sel_district" required>
        <option value="">Select District</option>
        <?php
        $selQry="select * from tbl_district";
        $result=$con->query($selQry);
        while($row=$result->fetch_assoc())
        {
        ?>
          <option value="<?php echo $row["district_id"] ?>">
            <?php echo $row["district_name"] ?>
          </option>
        <?php
        }
        ?>
      </select>
    </div>

    <div>
      <label for="txt_place">Place</label>
      <input type="text" name="txt_place" id="txt_place" required />
    </div>

    <div>
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
    </div>
  </form>
</div>

<div class="table-container">
  <table>
    <tr>
      <th>#</th>
      <th>District</th>
      <th>Place</th>
      <th>Action</th>
    </tr>
    <?php
    $i=0;
    $selQry="select * from tbl_place p INNER JOIN tbl_district d on p.district_id=d.district_id";
    $result=$con->query($selQry);
    while($row=$result->fetch_assoc())
    {
      $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row["district_name"]; ?></td>
      <td><?php echo $row["place_name"]; ?></td>
      <td><a href="place.php?did=<?php echo $row["district_id"]; ?>" onclick="return confirm('Are you sure you want to delete this place?');">Delete</a></td>
    </tr>
    <?php
    }
    ?>
  </table>
</div>

</body>
</html>
