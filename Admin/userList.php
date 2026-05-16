<?php
include('../Assets/connection/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>User Details</title>

<style>
/* ---------- Base ---------- */
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #e3eeff, #f8f9fc);
  margin: 0;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: flex-start;
  min-height: 100vh;
  color: #333;
}

/* ---------- Container ---------- */
.container {
  width: 95%;
  max-width: 1100px;
  background: #fff;
  margin-top: 60px;
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 8px 30px rgba(0,0,0,0.1);
  backdrop-filter: blur(10px);
  transition: transform 0.3s ease;
}

.container:hover {
  transform: translateY(-5px);
}

/* ---------- Title ---------- */
h2 {
  text-align: center;
  font-size: 28px;
  margin-bottom: 30px;
  color: #1a1a1a;
  letter-spacing: 1px;
}

/* ---------- Table ---------- */
table {
  width: 100%;
  border-collapse: collapse;
  border-radius: 12px;
  overflow: hidden;
  background-color: #fff;
}

th, td {
  padding: 14px 16px;
  text-align: center;
  border-bottom: 1px solid #eaeaea;
  font-size: 15px;
}

th {
  background: linear-gradient(135deg, #007bff, #0056b3);
  color: white;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-weight: 600;
}

tr:hover {
  background-color: #f2f8ff;
  transition: background 0.3s ease;
}

/* ---------- Image Cell ---------- */
td img {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  object-fit: cover;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

/* ---------- Responsive ---------- */
@media (max-width: 768px) {
  .container {
    padding: 20px;
  }

  th, td {
    font-size: 13px;
    padding: 10px;
  }

  h2 {
    font-size: 22px;
  }
}
</style>
</head>

<body>
  <div class="container">
    <h2>User Details</h2>
    <form action="" method="post">
      <table>
        <tr>
          <th>SI No</th>
          <th>Name</th>
          <th>Email</th>
          <th>Contact</th>
          <th>Address</th>
          <th>Photo</th>
          <th>District</th>
          <th>Place</th>
        </tr>
        <?php
        $i = 0;
        $qry = "SELECT u.*, d.district_name, p.place_name
                FROM tbl_user u
                INNER JOIN tbl_place p ON u.place_id = p.place_id
                INNER JOIN tbl_district d ON p.district_id = d.district_id";
        $result = $con->query($qry);
        while ($row = $result->fetch_assoc()) {
            $i++;
        ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $row["user_name"]; ?></td>
          <td><?php echo $row["user_email"]; ?></td>
          <td><?php echo $row["user_contact"]; ?></td>
          <td><?php echo $row["user_address"]; ?></td>
          <td>
           <img src="../Assets/files/UserPhotos/<?php echo $row['user_photo']; ?>" alt="User Photo" />

          </td>
          <td><?php echo $row["district_name"]; ?></td>
          <td><?php echo $row["place_name"]; ?></td>
        </tr>
        <?php
        }
        ?>
      </table>
    </form>
  </div>
</body>
</html>
