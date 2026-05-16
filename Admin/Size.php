<?php
include('../Assets/connection/connection.php');
$materialname='';
if(isset($_POST['btn_submit']))
{
$size=$_POST['txt_size'];
$sizeid=$_POST['txt_hidden'];
if($sizeid!="")
{
	$up="update tbl_size set size_name='".$size."' where size_id=.$sizeid";
	if($con->query($up))
{
?>
<script>
alert("data updated")
window.location="Size.php"
</script>
<?php
}
}
else
{
$ins="insert into tbl_size(size_name) value('".$size."')";
if($con->query($ins))
{
?>
<script>
alert("data inserted")
window.location="Size.php"
</script>
<?php
}
}
}
if(isset($_GET["did"]))
{
	$delQry="delete from tbl_size where size_id=".$_GET["did"];
	if($con->query($delQry))
{
	?>
    <script>	
alert("data succesfully deleted");
window.location="size.php";
</script>
<?php
}
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<title>Manage Size</title>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #f8f9fb;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        min-height: 100vh;
        padding: 50px 0;
        color: #333;
    }

    form {
        background: #fff;
        padding: 30px 40px;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
        width: 480px;
        text-align: center;
    }

    h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #2c3e50;
        letter-spacing: 1px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
    }

    table th, table td {
        border: 1px solid #e0e0e0;
        padding: 12px;
        text-align: center;
    }

    table th {
        background-color: #2c3e50;
        color: white;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    table tr:nth-child(even) {
        background-color: #f2f5f9;
    }

    table tr:hover {
        background-color: #f9f9f9;
        transition: 0.2s;
    }

    input[type="text"] {
        width: 95%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        outline: none;
    }

    input[type="submit"] {
        background: linear-gradient(135deg, #007bff, #0056d6);
        border: none;
        color: #fff;
        font-size: 16px;
        padding: 10px 25px;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 15px;
        transition: all 0.3s ease;
    }

    input[type="submit"]:hover {
        background: linear-gradient(135deg, #0056d6, #003caa);
        transform: scale(1.04);
    }

    a {
        color: #e74c3c;
        text-decoration: none;
        font-weight: 500;
    }

    a:hover {
        text-decoration: underline;
    }

    .table-container {
        margin-top: 40px;
    }
</style>

</head>

<body>
    <form action="" method="post">
        <h2>Manage Size</h2>
        <table>
            <tr>
                <td><strong>Size</strong></td>
                <td><input type="text" name="txt_size" id="txt_size" required /></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
                </td>
            </tr>
        </table>

        <div class="table-container">
            <table>
                <tr>
                    <th>SI No</th>
                    <th>Size</th>
                    <th>Action</th>
                </tr>
                <?php
                    $i=0;
                    $selQry="select * from tbl_size";
                    $result=$con->query($selQry);
                    while($row=$result->fetch_assoc())
                    {
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row["size_name"]; ?></td>
                    <td><a href="size.php?did=<?php echo $row["size_id"];?>">Delete</a></td>
                </tr>
                <?php
                    }
                ?>
            </table>
        </div>
    </form>
</body>
</html>
