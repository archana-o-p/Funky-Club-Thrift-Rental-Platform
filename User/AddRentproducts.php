<?php
include('../Assets/Connection/Connection.php');
session_start();
include('Head.php');

if (isset($_POST["btn_submit"])) {
	$name = mysqli_real_escape_string($con, $_POST['txt_name']);
	$details = mysqli_real_escape_string($con, $_POST['txt_details']);
	$photo = $_FILES["file_photo"]["name"];
	$tempPhoto = $_FILES["file_photo"]["tmp_name"];
	if ($photo != '' && $tempPhoto != '') {
		move_uploaded_file($tempPhoto, "../Assets/files/Product/" . $photo);
	}
	$color = $_POST['sel_color'];
	$size = $_POST['sel_size'];
	$price = $_POST['txt_price'];
	$material = $_POST['sel_material'];
	$subcategory = $_POST['sel_subcategory'];
	$gender = $_POST['sel_gender'];

	$insQry = "INSERT INTO tbl_rentproducts
    (rentproduct_name, rentproduct_details, rentproduct_photo, material_id, subcategory_id, user_id, rentproduct_price, color_id, size_id, gender_id)
    VALUES ('$name','$details','$photo','$material','$subcategory','" . $_SESSION['uid'] . "','$price','$color','$size','$gender')";

	if ($con->query($insQry)) {
		?>
		<script>
			alert("Data inserted successfully!");
			window.location = "AddRentproducts.php?pid=<?php echo $_SESSION['uid'] ?>";
		</script>
		<?php
	}
}

// ===== Delete Product =====
if (isset($_GET["did"])) {
	$delQry = "delete from tbl_rentproducts where rentproduct_id=" . $_GET["did"];
	if ($con->query($delQry)) {
		?>
		<script>
			alert("Data successfully deleted");
			window.location = "AddRentproducts.php";
		</script>
		<?php
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>Manage Rent Products</title>
	<style>
		/* ========= RESET ========= */
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'Poppins', sans-serif;
		}

		/* ========= BODY ========= */
		body {
			background: linear-gradient(135deg, #141e30, #243b55);
			min-height: 100vh;


			color: #333;
		}

		/* ========= MAIN CONTAINER ========= */
		.rent-management-wrapper {
			width: 95%;
			max-width: 1200px;
			background: #fff;
			border-radius: 20px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
			padding: 40px;
			animation: rent-fade-in 0.8s ease;
		}

		/* ========= ANIMATION ========= */
		@keyframes rent-fade-in {
			from {
				opacity: 0;
				transform: translateY(20px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		/* ========= PAGE HEADING ========= */
		.rent-page-title {
			text-align: center;
			margin-bottom: 30px;
			color: #222;
			font-weight: 600;
			letter-spacing: 1px;
		}

		/* ========= ADD FORM SECTION ========= */
		.rent-add-form-section {
			background: #f7f8fb;
			padding: 25px 30px;
			border-radius: 15px;
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
			margin-bottom: 40px;
		}

		/* ========= FORM GRID LAYOUT ========= */
		.rent-form-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
			gap: 20px;
			align-items: end;
		}

		/* ========= FORM FIELD WRAPPER ========= */
		.rent-form-field {
			display: flex;
			flex-direction: column;
		}

		/* ========= FORM LABELS ========= */
		.rent-form-label {
			font-weight: 500;
			margin-bottom: 8px;
			color: #555;
			font-size: 14px;
		}

		/* ========= FORM INPUTS AND SELECTS ========= */
		.rent-form-input,
		.rent-form-select,
		.rent-form-textarea {
			width: 100%;
			padding: 10px 12px;
			border: 1px solid #ccc;
			border-radius: 8px;
			font-size: 14px;
			transition: 0.3s;
			background: #fff;
		}

		.rent-form-input:focus,
		.rent-form-select:focus,
		.rent-form-textarea:focus {
			border-color: #243b55;
			box-shadow: 0 0 5px rgba(36, 59, 85, 0.3);
			outline: none;
		}

		.rent-form-textarea {
			resize: vertical;
			min-height: 80px;
		}

		/* ========= FILE INPUT WRAPPER ========= */
		.rent-file-wrapper {
			position: relative;
			overflow: hidden;
			display: inline-block;
			width: 100%;
		}

		.rent-file-input {
			position: absolute;
			left: -9999px;
		}

		.rent-file-label {
			display: block;
			padding: 10px 12px;
			background: #243b55;
			color: #fff;
			border-radius: 8px;
			text-align: center;
			cursor: pointer;
			transition: 0.3s;
			font-size: 14px;
		}

		.rent-file-label:hover {
			background: #141e30;
		}

		/* ========= SUBMIT BUTTON ========= */
		.rent-submit-button {
			background: linear-gradient(90deg, #243b55, #141e30);
			color: #fff;
			border: none;
			border-radius: 25px;
			padding: 10px 30px;
			font-size: 15px;
			cursor: pointer;
			transition: 0.3s;
			grid-column: 1 / -1;
			justify-self: center;
		}

		.rent-submit-button:hover {
			transform: scale(1.05);
			box-shadow: 0 4px 10px rgba(36, 59, 85, 0.4);
		}

		/* ========= PRODUCTS TABLE ========= */
		.rent-products-table {
			width: 100%;
			border-collapse: collapse;
			background: #fff;
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
			border-radius: 12px;
			overflow: hidden;
		}

		.rent-table-header {
			background: #243b55;
			color: white;
		}

		.rent-table-header th {
			padding: 12px;
			font-weight: 500;
			text-transform: uppercase;
			letter-spacing: 0.5px;
		}

		.rent-table-row {
			transition: 0.3s;
		}

		.rent-table-row:hover {
			background: #f3f6fa;
		}

		.rent-table-cell {
			padding: 12px;
			text-align: center;
			border-bottom: 1px solid #eee;
			font-size: 14px;
		}

		.rent-product-image {
			border-radius: 10px;
			object-fit: cover;
			width: 80px;
			height: 80px;
		}

		/* ========= ACTION LINKS ========= */
		.rent-action-link {
			text-decoration: none;
			color: #243b55;
			font-weight: 500;
			transition: 0.2s;
			padding: 5px 10px;
			border-radius: 5px;
			display: inline-block;
		}

		.rent-action-link:hover {
			color: #ff4b2b;
			background: #f0f0f0;
		}

		/* ========= RESPONSIVE DESIGN ========= */
		@media (max-width: 768px) {
			.rent-management-wrapper {
				padding: 20px;
			}

			.rent-form-grid {
				grid-template-columns: 1fr;
				gap: 15px;
			}

			.rent-products-table {
				font-size: 12px;
			}

			.rent-table-cell {
				padding: 8px;
			}
		}

		@media (max-width: 480px) {

			.rent-table-header th,
			.rent-table-cell {
				font-size: 11px;
				padding: 6px;
			}
		}
	</style>
</head>

<body>
	<div class="rent-management-wrapper">
		<h1 class="rent-page-title">Manage Rent Products</h1>

		<div class="rent-add-form-section">
			<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
				<div class="rent-form-grid">
					<div class="rent-form-field">
						<label for="txt_name" class="rent-form-label">Name</label>
						<input type="text" class="rent-form-input" name="txt_name" id="txt_name" required />
					</div>
					<div class="rent-form-field">
						<label for="txt_details" class="rent-form-label">Details</label>
						<textarea class="rent-form-textarea" name="txt_details" id="txt_details" required></textarea>
					</div>
					<div class="rent-form-field">
						<label for="file_photo" class="rent-form-label">Photo</label>
						<div class="rent-file-wrapper">
							<input type="file" class="rent-file-input" name="file_photo" id="file_photo" required />
							<label for="file_photo" class="rent-file-label">Choose Photo</label>
						</div>
					</div>
					<div class="rent-form-field">
						<label for="sel_gender" class="rent-form-label">Gender</label>
						<select class="rent-form-select" name="sel_gender" id="sel_gender" required>
							<option value="">--Select--</option>
							<?php
							$selGender = "SELECT * FROM tbl_gender";
							$resGender = $con->query($selGender);
							while ($rowG = $resGender->fetch_assoc()) {
								echo "<option value='" . $rowG['gender_id'] . "'>" . $rowG['gender_name'] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="rent-form-field">
						<label for="sel_size" class="rent-form-label">Size</label>
						<select class="rent-form-select" name="sel_size" id="sel_size" required>
							<option>--Select--</option>
							<?php
							$selQry = "select * from tbl_size";
							$result = $con->query($selQry);
							while ($row = $result->fetch_assoc()) {
								echo "<option value='" . $row["size_id"] . "'>" . $row["size_name"] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="rent-form-field">
						<label for="sel_color" class="rent-form-label">Color</label>
						<select class="rent-form-select" name="sel_color" id="sel_color" required>
							<option>--Select--</option>
							<?php
							$selQry = "select * from tbl_color";
							$result = $con->query($selQry);
							while ($row = $result->fetch_assoc()) {
								echo "<option value='" . $row["color_id"] . "'>" . $row["color_name"] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="rent-form-field">
						<label for="txt_price" class="rent-form-label">Price</label>
						<input type="text" class="rent-form-input" name="txt_price" id="txt_price" required />
					</div>
					<div class="rent-form-field">
						<label for="sel_material" class="rent-form-label">Material</label>
						<select class="rent-form-select" name="sel_material" id="sel_material" required>
							<option>--Select--</option>
							<?php
							$selQry = "select * from tbl_material";
							$result = $con->query($selQry);
							while ($row = $result->fetch_assoc()) {
								echo "<option value='" . $row["material_id"] . "'>" . $row["material_name"] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="rent-form-field">
						<label for="sel_category" class="rent-form-label">Category</label>
						<select class="rent-form-select" name="sel_category" id="sel_category"
							onChange="getSubcategory(this.value)" required>
							<option>--Select--</option>
							<?php
							$selQry = "select * from tbl_category";
							$result = $con->query($selQry);
							while ($row = $result->fetch_assoc()) {
								echo "<option value='" . $row["category_id"] . "'>" . $row["category_name"] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="rent-form-field">
						<label for="sel_subcategory" class="rent-form-label">Subcategory</label>
						<select class="rent-form-select" name="sel_subcategory" id="sel_subcategory" required>
							<option>--Select--</option>
							<?php
							$selQry = "select * from tbl_subcategory";
							$result = $con->query($selQry);
							while ($row = $result->fetch_assoc()) {
								echo "<option value='" . $row["subcategory_id"] . "'>" . $row["subcategory_name"] . "</option>";
							}
							?>
						</select>
					</div>
					<input type="submit" class="rent-submit-button" name="btn_submit" id="btn_submit"
						value="Add Product" />
				</div>
			</form>
		</div>

		<!-- ===== PRODUCTS DISPLAY TABLE ===== -->
		<table class="rent-products-table">
			<thead class="rent-table-header">
				<tr>
					<th>SI NO</th>
					<th>Name</th>
					<th>Details</th>
					<th>Photo</th>
					<th>Gender</th>
					<th>Color</th>
					<th>Size</th>
					<th>Price</th>
					<th>Material</th>
					<th>Category</th>
					<th>Subcategory</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				$sel = "SELECT * 
				FROM tbl_rentproducts p 
				INNER JOIN tbl_material m ON m.material_id=p.material_id 
				INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id 
				INNER JOIN tbl_category c ON c.category_id=s.category_id 
				INNER JOIN tbl_color co ON co.color_id=p.color_id  
				INNER JOIN tbl_size si ON si.size_id=p.size_id  
				INNER JOIN tbl_gender g ON g.gender_id=p.gender_id
				WHERE p.user_id='" . $_SESSION['uid'] . "'";
				$result = $con->query($sel);

				while ($row = $result->fetch_assoc()) {
					$i++;
					?>
					<tr class="rent-table-row">
						<td class="rent-table-cell"><?php echo $i; ?></td>
						<td class="rent-table-cell"><?php echo $row["rentproduct_name"]; ?></td>
						<td class="rent-table-cell"><?php echo $row["rentproduct_details"]; ?></td>
						<td class="rent-table-cell">
							<img src="../Assets/files/Product/<?php echo $row["rentproduct_photo"]; ?>" alt="Product Photo"
								class="rent-product-image">
						</td>
						<td class="rent-table-cell"><?php echo $row["gender_name"]; ?></td>
						<td class="rent-table-cell"><?php echo $row["color_name"]; ?></td>
						<td class="rent-table-cell"><?php echo $row["size_name"]; ?></td>
						<td class="rent-table-cell">₹<?php echo $row["rentproduct_price"]; ?></td>
						<td class="rent-table-cell"><?php echo $row["material_name"]; ?></td>
						<td class="rent-table-cell"><?php echo $row["category_name"]; ?></td>
						<td class="rent-table-cell"><?php echo $row["subcategory_name"]; ?></td>
						<td class="rent-table-cell">
							<a href="AddRentproducts.php?did=<?php echo $row["rentproduct_id"]; ?>"
								class="rent-action-link">Delete</a>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		function getSubcategory(cid) {
			$("#sel_subcategory").html("<option>Loading...</option>");
			$.ajax({
				url: "../Assets/AjaxPages/AjaxSubcategory.php?did=" + cid,
				success: function (data) {
					$("#sel_subcategory").html(data);
				}
			});
		}
	</script>
</body>

</html>
<?php
include("Foot.php");
?>