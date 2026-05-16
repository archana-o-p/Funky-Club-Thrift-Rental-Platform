<?php
include('../Assets/connection/connection.php');
$colorname='';
if(isset($_POST['btn_submit']))
{
$color=$_POST['txt_color'];
$colorid=$_POST['txt_hidden'];
if($sizeid!="")
{
	$up="update tbl_color set color_name='".$color."' where color_id=.$colorid";
	if($con->query($up))
{
?>
<script>
alert("data updated")
window.location="Color.php"
</script>
<?php
}
}
else
{
$ins="insert into tbl_color(color_name) value('".$color."')";
if($con->query($ins))
{
?>
<script>
alert("data inserted")
window.location="Color.php"
</script>
<?php
}
}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_color where color_id=".$_GET["did"];
	if($con->query($delQry))
{
	?>
    <script>	
alert("data succesfully deleted");
window.location="color.php";
</script>
<?php
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Color Management</title>
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #c7d2dfff, #c7d2dfff);
    margin: 0;
    padding: 0;
    color: #333;
  }

  .container {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
    padding-top: 50px;
    flex-direction: column;
    align-items: center;
  }

  .form-card {
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.1);
    width: 400px;
    transition: all 0.3s ease-in-out;
  }

  .form-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 35px rgba(0,0,0,0.15);
  }

  h2 {
    text-align: center;
    color: #1b263b;
    font-size: 24px;
    margin-bottom: 20px;
    letter-spacing: 1px;
  }

  label {
    font-weight: 500;
    color: #444;
  }

  input[type="text"] {
    width: 100%;
    padding: 10px 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    outline: none;
    transition: 0.3s;
    margin-top: 5px;
  }

  input[type="text"]:focus {
    border-color: #1b263b;
    box-shadow: 0 0 0 3px rgba(27,38,59,0.15);
  }

  input[type="submit"] {
    background: #1b263b;
    border: none;
    color: white;
    padding: 10px 25px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
    width: 100%;
    margin-top: 15px;
  }

  input[type="submit"]:hover {
    background: #415a77;
  }

  .data-table {
    width: 70%;
    margin-top: 40px;
    border-collapse: collapse;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    background: white;
    border-radius: 12px;
    overflow: hidden;
  }

  .data-table th, .data-table td {
    text-align: center;
    padding: 12px;
    font-size: 15px;
  }

  .data-table th {
    background: #1b263b;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.8px;
  }

  .data-table tr:nth-child(even) {
    background-color: #f8f9fa;
  }

  .data-table a {
    text-decoration: none;
    color: #e63946;
    font-weight: 500;
    transition: 0.2s;
  }

  .data-table a:hover {
    color: #c53030;
    text-decoration: underline;
  }

  @media(max-width:768px){
    .form-card{
      width: 90%;
    }
    .data-table{
      width: 95%;
      font-size: 14px;
    }
  }
</style>
</head>

<body>
<div class="container">
  <div class="form-card">
    <h2>Manage Colors</h2>
    <form action="" method="post">
      <label for="txt_color">Color Name</label>
      <input type="text" name="txt_color" id="txt_color" required />
      <input type="hidden" name="txt_hidden" id="txt_hidden" />
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
    </form>
  </div>

  <table class="data-table">
    <tr>
      <th>SI No</th>
      <th>Color</th>
      <th>Action</th>
    </tr>
    <?php
    $i=0;
    $selQry="select * from tbl_color";
    $result=$con->query($selQry);
    while($row=$result->fetch_assoc())
    {
      $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row["color_name"]; ?></td>
      <td><a href="color.php?did=<?php echo $row["color_id"];?>">Delete</a></td>
    </tr>
    <?php
    }
    ?>
  </table>
</div>
</body>
</html>
