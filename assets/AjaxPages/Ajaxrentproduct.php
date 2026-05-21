<?php
include("../Connection/Connection.php");

if(($_GET['subcatid']!='') && ($_GET['matid']!='') && ($_GET['sizeid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND p.subcategory_id='".$_GET['subcatid']."' 
  AND p.material_id='".$_GET['matid']."' 
  AND p.size_id='".$_GET['sizeid']."' 
  AND p.color_id='".$_GET['colorid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['catid']!='') && ($_GET['matid']!='') && ($_GET['sizeid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND p.material_id='".$_GET['matid']."' 
  AND p.size_id='".$_GET['sizeid']."' 
  AND p.color_id='".$_GET['colorid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['subcatid']!='') && ($_GET['matid']!='') && ($_GET['sizeid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  AND p.material_id='".$_GET['matid']."' 
  AND p.size_id='".$_GET['sizeid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['subcatid']!='') && ($_GET['matid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
    INNER JOIN tbl_size si ON si.size_id=p.size_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  AND p.material_id='".$_GET['matid']."' 
  AND p.color_id='".$_GET['colorid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['subcatid']!='') && ($_GET['sizeid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
    INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  AND p.size_id='".$_GET['sizeid']."' 
  AND p.color_id='".$_GET['colorid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['matid']!='') && ($_GET['sizeid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  WHERE p.material_id='".$_GET['matid']."' 
  AND p.size_id='".$_GET['sizeid']."' 
  AND p.color_id='".$_GET['colorid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['catid']!='') && ($_GET['matid']!='') && ($_GET['sizeid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
    INNER JOIN tbl_color co ON co.color_id=p.color_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND p.material_id='".$_GET['matid']."' 
  AND p.size_id='".$_GET['sizeid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['catid']!='') && ($_GET['matid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
    INNER JOIN tbl_size si ON si.size_id=p.size_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND p.material_id='".$_GET['matid']."' 
  AND p.color_id='".$_GET['colorid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['catid']!='') && ($_GET['sizeid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
	  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id   
  INNER JOIN tbl_category c ON c.category_id=s.category_id            
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND p.size_id='".$_GET['sizeid']."' 
  AND p.color_id='".$_GET['colorid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['subcatid']!='') && ($_GET['matid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id        
  INNER JOIN tbl_material m ON m.material_id=p.material_id   
   INNER JOIN tbl_color co ON co.color_id=p.color_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id      
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  AND p.material_id='".$_GET['matid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['subcatid']!='')&& ($_GET['sizeid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id     
    INNER JOIN tbl_material m ON m.material_id=p.material_id          
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  AND p.size_id='".$_GET['sizeid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['subcatid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id
    INNER JOIN tbl_material m ON m.material_id=p.material_id               
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
    INNER JOIN tbl_size si ON si.size_id=p.size_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  AND p.color_id='".$_GET['colorid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['catid']!='') && ($_GET['matid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id   
  INNER JOIN tbl_category c ON c.category_id=s.category_id     
          INNER JOIN tbl_color co ON co.color_id=p.color_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND p.material_id='".$_GET['matid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['catid']!='') && ($_GET['sizeid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
	  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id   
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND p.size_id='".$_GET['sizeid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['catid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id  
  	  INNER JOIN tbl_material m ON m.material_id=p.material_id  
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
    INNER JOIN tbl_size si ON si.size_id=p.size_id 
  WHERE c.category_id='".$_GET['catid']."'  
  AND p.color_id='".$_GET['colorid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['sizeid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_user se ON se.user_id=p.user_id
  	  INNER JOIN tbl_material m ON m.material_id=p.material_id 
   INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id   
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  WHERE p.size_id='".$_GET['sizeid']."' 
  AND p.color_id='".$_GET['colorid']."' 
  GROUP BY p.rentproduct_id";
}
else if(($_GET['matid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  	  INNER JOIN tbl_material m ON m.material_id=p.material_id 
   INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
    INNER JOIN tbl_size si ON si.size_id=p.size_id 
  WHERE  p.material_id='".$_GET['matid']."' 
  AND p.color_id='".$_GET['colorid']."' 
  GROUP BY p.rentproduct_id";
}
else if($_GET['subcatid']!='')
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
   INNER JOIN tbl_color co ON co.color_id=p.color_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  GROUP BY p.rentproduct_id";
}
else if($_GET['catid']!='')
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
   INNER JOIN tbl_color co ON co.color_id=p.color_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  WHERE s.category_id='".$_GET['catid']."' 
  GROUP BY p.rentproduct_id";
}
else if($_GET['sizeid']!='')
{
	$sel="SELECT * FROM tbl_rentproducts p 
	INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
   INNER JOIN tbl_color co ON co.color_id=p.color_id 
  INNER JOIN tbl_size si ON si.size_id=p.size_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  WHERE p.size_id='".$_GET['sizeid']."' 
  GROUP BY p.rentproduct_id";
}
else if($_GET['colorid']!='')
{
	$sel="SELECT * FROM tbl_rentproducts p 
  INNER JOIN tbl_color co ON co.color_id=p.color_id 
    INNER JOIN tbl_size si ON si.size_id=p.size_id 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  WHERE p.color_id='".$_GET['colorid']."' 
  GROUP BY p.rentproduct_id";
}
else if($_GET['matid']!='')
{
	$sel="SELECT * FROM tbl_rentproducts p 
	INNER JOIN tbl_color co ON co.color_id=p.color_id 
    INNER JOIN tbl_size si ON si.size_id=p.size_id 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_user se ON se.user_id=p.user_id 
  WHERE p.material_id='".$_GET['matid']."' 
  GROUP BY p.rentproduct_id";
}
else
{
  $sel="SELECT * FROM tbl_rentproducts p 
      INNER JOIN tbl_material m ON m.material_id=p.material_id 
      INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id 
      INNER JOIN tbl_category c ON c.category_id=s.category_id 
      INNER JOIN tbl_user se ON se.user_id=p.user_id 
      INNER JOIN tbl_size sz ON sz.size_id = p.size_id 
      INNER JOIN tbl_color co ON co.color_id = p.color_id";
}
?>

<table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <td>SI NO</td>
    <td>Name</td>
    <td>Details</td>
    <td>Photo</td>
    <td>Color</td>
    <td>Size</td>
    <td>Material</td>
    <td>Category</td>
    <td>Subcategory</td>
    <td>Action</td>
  </tr>
  <?php
  $i=0;
  $result = $con->query($sel);

  while ($row = $result->fetch_assoc()) {
      $i++;
  ?>
  <tr>
    <td><?php echo $i; ?></td>
    <td><?php echo $row["rentproduct_name"]; ?></td>
    <td><?php echo $row["rentproduct_details"]; ?></td>
    <td><img src="../Assets/files/Product/<?php echo $row["rentproduct_photo"]; ?>" width="100px" height="100px"/></td>
    <td><?php echo $row["color_name"]; ?></td>
    <td><?php echo $row["size_name"]; ?></td>
    <td><?php echo $row["material_name"]; ?></td>
    <td><?php echo $row["category_name"]; ?></td>
    <td><?php echo $row["subcategory_name"]; ?></td>
    <td>
      <a href="Viewrentproducts.php?did=<?php echo $row["rentproduct_id"];?>">delete</a>
      <a href="Rentbooking.php?pid=<?php echo $row["rentproduct_id"]; ?>">Book</a>
    </td>
  </tr>
  <?php
  }
  ?>
</table>
