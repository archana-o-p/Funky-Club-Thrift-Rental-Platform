<?php
include('../Assets/Connection/Connection.php');
session_start();
include('Head.php');
$genderFilter = "";
if (isset($_GET['gender']) && $_GET['gender'] != "") {
    $genderFilter = " AND p.gender_id = '" . $_GET['gender'] . "'";
}
if (isset($_GET["did"])) {
    $delQry = "DELETE FROM tbl_rentproducts WHERE rentproduct_id=" . $_GET["did"];
    if ($con->query($delQry)) {
        ?>
        <script>
            alert("Data successfully deleted");
            window.location = "Viewrentproducts.php";
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>View Rent Products</title>

    <!-- ✅ Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../Assets/JQ/jQuery.js"></script>

    <style>
        body {
            background: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .filter-section {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            width: 95%;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            cursor: pointer;
            background: #fff;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card img {
            border-radius: 15px 15px 0 0;
            object-fit: cover;
            height: 200px;
            width: 100%;
        }

        .card-body {
            padding: 15px;
        }

        .card-body p {
            margin: 0;
            font-size: 0.9rem;
        }

        .modal-content {
            border-radius: 20px;
        }

        .modal-body img {
            border-radius: 15px;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <div class="container my-4">
        <div class="filter-section">
            <form id="form1" name="form1" method="post" action="">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label class="form-label">Category</label>
                        <select name="sel_category" id="sel_category" class="form-select"
                            onchange="getajaxsearch(),getSubcategory(this.value)">
                            <option value="">Select</option>
                            <?php
                            $selQry = "select * from tbl_category";
                            $result = $con->query($selQry);
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row["category_id"] ?>"><?php echo $row["category_name"] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Subcategory</label>
                        <select name="sel_subcategory" id="sel_subcategory" class="form-select"
                            onchange="getajaxsearch()">
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Material</label>
                        <select name="sel_material" id="sel_material" class="form-select" onchange="getajaxsearch()">
                            <option value="">Select</option>
                            <?php
                            $selQry = "select * from tbl_material";
                            $result = $con->query($selQry);
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row["material_id"] ?>"><?php echo $row["material_name"] ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Size</label>
                        <select name="sel_size" id="sel_size" class="form-select" onchange="getajaxsearch()">
                            <option value="">Select</option>
                            <?php
                            $selQry = "select * from tbl_size";
                            $result = $con->query($selQry);
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row["size_id"] ?>"><?php echo $row["size_name"] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Color</label>
                        <select name="sel_color" id="sel_color" class="form-select" onchange="getajaxsearch()">
                            <option value="">Select</option>
                            <?php
                            $selQry = "select * from tbl_color";
                            $result = $con->query($selQry);
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row["color_id"] ?>"><?php echo $row["color_name"] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <div id="result" class="mt-4">
            <div class="row g-4">
                <?php
                $i = 0;
                $sel = "SELECT * FROM tbl_rentproducts p 
        INNER JOIN tbl_material m ON m.material_id=p.material_id 
        INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id 
        INNER JOIN tbl_category c ON c.category_id=s.category_id 
        INNER JOIN tbl_size sz ON sz.size_id = p.size_id 
        INNER JOIN tbl_color co ON co.color_id = p.color_id  
        INNER JOIN tbl_gender g ON g.gender_id = p.gender_id
        WHERE 1=1 $genderFilter";

                $result = $con->query($sel);

                while ($row = $result->fetch_assoc()) {
                    $i++;
                    ?>
                    <div class="col-md-3">
                        <div class="card"
                            onclick="showDetails('<?php echo $row['rentproduct_id']; ?>','<?php echo addslashes($row['rentproduct_name']); ?>','<?php echo addslashes($row['rentproduct_details']); ?>','<?php echo $row['rentproduct_photo']; ?>','<?php echo $row['gender_name']; ?>','<?php echo $row['color_name']; ?>','<?php echo $row['size_name']; ?>','<?php echo $row['material_name']; ?>','<?php echo $row['category_name']; ?>','<?php echo $row['subcategory_name']; ?>')">
                            <img src="../Assets/files/Product/<?php echo $row["rentproduct_photo"]; ?>" class="card-img-top"
                                alt="Product">
                            <div class="card-body text-center">
                                <h5 class="card-title mb-1"><?php echo $row["rentproduct_name"]; ?></h5>
                                <p class="text-muted mb-1">
                                    <strong>Category:</strong> <?php echo $row["category_name"]; ?>
                                </p>
                                <p class="text-muted mb-1">
                                    <strong>Size:</strong> <?php echo $row["size_name"]; ?> | <strong>Color:</strong>
                                    <?php echo $row["color_name"]; ?>
                                </p>
                                <p class="text-muted mb-2">
                                    <strong>Gender:</strong> <?php echo $row["gender_name"]; ?>
                                </p>
                                <button class="btn btn-outline-danger btn-sm">View Details</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header">
                    <h5 id="productName" class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body d-flex flex-wrap justify-content-between">
                    <div class="col-md-5 text-center mb-3">
                        <img id="productImage" src="" class="img-fluid" alt="Product">
                    </div>
                    <div class="col-md-6">
                        <p id="productDetails" class="mb-2"></p>
                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item"><strong>Gender:</strong> <span id="gender"></span></li>
                            <li class="list-group-item"><strong>Color:</strong> <span id="color"></span></li>
                            <li class="list-group-item"><strong>Size:</strong> <span id="size"></span></li>
                            <li class="list-group-item"><strong>Material:</strong> <span id="material"></span></li>
                            <li class="list-group-item"><strong>Category:</strong> <span id="category"></span></li>
                            <li class="list-group-item"><strong>Subcategory:</strong> <span id="subcategory"></span>
                            </li>
                        </ul>
                        <div class="text-end">
                            <a id="bookBtn" href="#" class="btn btn-success px-4">Book Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetails(id, name, details, photo, gender, color, size, material, category, subcategory) {
            $('#productName').text(name);
            $('#productDetails').text(details);
            $('#productImage').attr('src', '../Assets/files/Product/' + photo);
            $('#gender').text(gender);
            $('#color').text(color);
            $('#size').text(size);
            $('#material').text(material);
            $('#category').text(category);
            $('#subcategory').text(subcategory);
            $('#bookBtn').attr('href', 'Rentbooking.php?pid=' + id);
            var modal = new bootstrap.Modal(document.getElementById('productModal'));
            modal.show();
        }

        function getSubcategory(did) {
            $.ajax({
                url: "../Assets/AjaxPages/AjaxSubcategory.php?did=" + did,
                success: function (result) {
                    $("#sel_subcategory").html(result);
                }
            });
        }

        function getajaxsearch() {
            var catid = document.getElementById('sel_category').value
            var subcatid = document.getElementById('sel_subcategory').value
            var matid = document.getElementById('sel_material').value
            var sizeid = document.getElementById('sel_size').value
            var colorid = document.getElementById('sel_color').value
            $.ajax({
                url: "../Assets/AjaxPages/Ajaxrentproduct.php?catid=" + catid +
                    "&subcatid=" + subcatid +
                    "&matid=" + matid +
                    "&sizeid=" + sizeid +
                    "&colorid=" + colorid,
                success: function (result) {
                    $("#result").html(result);
                }
            });
        }
    </script>

</body>

</html>
<?php
include("Foot.php");
?>