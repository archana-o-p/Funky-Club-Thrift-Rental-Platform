<?php
include("../Connection/Connection.php");
if(($_GET['subcatid']!='') && ($_GET['matid']!='') && ($_GET['sizeid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND p.subcategory_id='".$_GET['subcatid']."' 
  AND p.material_id='".$_GET['matid']."' 
  AND st.size_id='".$_GET['sizeid']."' 
  AND st.color_id='".$_GET['colorid']."' 
  GROUP BY st.product_id";
}
else if(($_GET['catid']!='') && ($_GET['matid']!='') && ($_GET['sizeid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
    INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND p.material_id='".$_GET['matid']."' 
  AND st.size_id='".$_GET['sizeid']."' 
  AND st.color_id='".$_GET['colorid']."' 
  GROUP BY st.product_id";
}
else if(($_GET['subcatid']!='') && ($_GET['matid']!='') && ($_GET['sizeid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
    INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  AND p.material_id='".$_GET['matid']."' 
  AND st.size_id='".$_GET['sizeid']."' 
  GROUP BY st.product_id";
	}

else if(($_GET['subcatid']!='') && ($_GET['matid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
      INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  AND p.material_id='".$_GET['matid']."' 
  AND st.color_id='".$_GET['colorid']."' 
  GROUP BY st.product_id";
}
else if(($_GET['subcatid']!='') && ($_GET['sizeid']!='') && ($_GET['colorid']!=''))
{
	
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
    INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
      INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  AND st.size_id='".$_GET['sizeid']."' 
  AND st.color_id='".$_GET['colorid']."' 
  GROUP BY st.product_id";
	}
else if(($_GET['matid']!='') && ($_GET['sizeid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
    INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE p.material_id='".$_GET['matid']."' 
  AND st.size_id='".$_GET['sizeid']."' 
  AND st.color_id='".$_GET['colorid']."' 
  GROUP BY st.product_id";
	}
else if(($_GET['catid']!='') && ($_GET['matid']!='') && ($_GET['sizeid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND p.material_id='".$_GET['matid']."' 
  AND st.size_id='".$_GET['sizeid']."' 
  GROUP BY st.product_id";
}
else if(($_GET['catid']!='') && ($_GET['matid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
    INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  INNER JOIN tbl_color co ON co.color_id=st.color_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND p.material_id='".$_GET['matid']."' 
  AND st.color_id='".$_GET['colorid']."' 
  GROUP BY st.product_id";
	}
else if(($_GET['catid']!='') && ($_GET['sizeid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
    INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id   
  INNER JOIN tbl_category c ON c.category_id=s.category_id            
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND st.size_id='".$_GET['sizeid']."' 
  AND st.color_id='".$_GET['colorid']."' 
  GROUP BY st.product_id";
}

else if(($_GET['subcatid']!='') && ($_GET['matid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id        
  INNER JOIN tbl_material m ON m.material_id=p.material_id  
   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id       
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  AND p.material_id='".$_GET['matid']."' 
  GROUP BY st.product_id";
}

else if(($_GET['subcatid']!='')&& ($_GET['sizeid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id
    INNER JOIN tbl_material m ON m.material_id=p.material_id                 INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  AND st.size_id='".$_GET['sizeid']."' 
  GROUP BY st.product_id";
	}
else if(($_GET['subcatid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id
    INNER JOIN tbl_material m ON m.material_id=p.material_id        
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  INNER JOIN tbl_color co ON co.color_id=st.color_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  AND st.color_id='".$_GET['colorid']."' 
  GROUP BY st.product_id";
	}
else if(($_GET['catid']!='') && ($_GET['matid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id   
  INNER JOIN tbl_category c ON c.category_id=s.category_id            
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND p.material_id='".$_GET['matid']."' 
  GROUP BY st.product_id";
}

else if(($_GET['catid']!='') && ($_GET['sizeid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
	  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
    INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE c.category_id='".$_GET['catid']."' 
  AND st.size_id='".$_GET['sizeid']."' 
  GROUP BY st.product_id";
}
else if(($_GET['catid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
    INNER JOIN tbl_material m ON m.material_id=p.material_id        
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE c.category_id='".$_GET['catid']."'  
  AND st.color_id='".$_GET['colorid']."' 
  GROUP BY st.product_id";
	}
else if(($_GET['sizeid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id 
    INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
    INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id
  INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE st.size_id='".$_GET['sizeid']."' 
  AND st.color_id='".$_GET['colorid']."' 
  GROUP BY st.product_id";
	}
else if(($_GET['matid']!='') && ($_GET['colorid']!=''))
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
    INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  INNER JOIN tbl_color co ON co.color_id=st.color_id 
  WHERE  p.material_id='".$_GET['matid']."' 
  AND st.color_id='".$_GET['colorid']."' 
  GROUP BY st.product_id";
	}
else if($_GET['subcatid']!='')
{
	 $sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE p.subcategory_id='".$_GET['subcatid']."' 
  GROUP BY st.product_id";
	}
else if($_GET['catid']!='')
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
  INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  WHERE c.category_id='".$_GET['catid']."' 
  GROUP BY st.product_id";
	}
else if($_GET['sizeid']!='')
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id 
    INNER JOIN tbl_material m ON m.material_id=p.material_id 
    INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  WHERE st.size_id='".$_GET['sizeid']."' 
  GROUP BY st.product_id";
	}
else if($_GET['colorid']!='')
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id 
   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
    INNER JOIN tbl_material m ON m.material_id=p.material_id 
    INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
  WHERE st.color_id='".$_GET['colorid']."' 
  GROUP BY st.product_id";
}
else if($_GET['matid']!='')
{
	$sel="SELECT * FROM tbl_product p 
  INNER JOIN tbl_stock st ON p.product_id=st.product_id 
  INNER JOIN tbl_material m ON m.material_id=p.material_id 
    INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id
  INNER JOIN tbl_category c ON c.category_id=s.category_id 
  INNER JOIN tbl_seller se ON se.seller_id=p.seller_id 
   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
  WHERE p.material_id='".$_GET['matid']."' 
  GROUP BY st.product_id";
	}
else
{
$sel="SELECT * FROM tbl_product p 
      INNER JOIN tbl_material m ON m.material_id=p.material_id 
      INNER JOIN tbl_subcategory s ON s.subcategory_id=p.subcategory_id 
      INNER JOIN tbl_category c ON c.category_id=s.category_id 
	   INNER JOIN tbl_color co ON co.color_id=st.color_id 
  INNER JOIN tbl_size si ON si.size_id=st.size_id 
      INNER JOIN tbl_seller se ON se.seller_id=p.seller_id";
}
	

?>
<table border="1" cellpadding="10" >
  <tr>
    <td>SI NO</td>
    <td>Name</td>
    <td>Details</td>
    <td>Photo</td>
    <td>Material</td>
    <td>Category</td>
    <td>Subcategory</td>
    <td>Action</td>
  </tr>
 <?php
$i=0;

$result = $con->query($sel);

while ($data = $result->fetch_assoc()) {
    $i++;
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $data["product_name"]; ?></td>
        <td><?php echo $data["product_details"]; ?></td>
        <td><img src="../Assets/files/Product/<?php echo $data["product_photo"]; ?>" width="100px" height="100px"/></td>
        <td><?php echo $data["material_name"]; ?></td>
        <td><?php echo $data["category_name"]; ?></td>
        <td><?php echo $data["subcategory_name"]; ?></td>
        <td>
        <?php
        // fetch all stock entries (size/color wise)
        $SelStock = "SELECT st.*, sz.size_name, co.color_name 
                     FROM tbl_stock st
                     LEFT JOIN tbl_size sz ON sz.size_id=st.size_id
                     LEFT JOIN tbl_color co ON co.color_id=st.color_id
                     WHERE st.product_id='".$data['product_id']."'";
        $res = $con->query($SelStock);

        $hasStock = false;
        while($rowS = $res->fetch_assoc()) {
            // total stock for this size/color
            $selstock = "SELECT SUM(stock_count) as stock 
                         FROM tbl_stock 
                         WHERE product_id='".$data["product_id"]."' 
                         AND size_id='".$rowS['size_id']."' 
                         AND color_id='".$rowS['color_id']."'";
            $stockRes = $con->query($selstock)->fetch_assoc();

            // total already in cart for this size/color
            $selcart = "SELECT SUM(cart_qty) as cart_qty 
                        FROM tbl_cart 
                        WHERE product_id='".$data["product_id"]."' 
                        AND size_id='".$rowS['size_id']."' 
                        AND color_id='".$rowS['color_id']."' 
                        AND cart_status > 0";
            $cartRes = $con->query($selcart)->fetch_assoc();

            $totalStock = $stockRes['stock'] ? $stockRes['stock'] : 0;
            $totalCart  = $cartRes['cart_qty'] ? $cartRes['cart_qty'] : 0;
            $remaining  = $totalStock - $totalCart;

            if($remaining > 0) {
                $hasStock = true;
                echo "Size: ".$rowS['size_name']." | Color: ".$rowS['color_name']." | Available: ".$remaining;
                ?>
                <a href="#" onclick="AddtoCart('<?php echo $data['product_id'];?>','<?php echo $rowS['size_id'];?>','<?php echo $rowS['color_id'];?>')"> Add To Cart </a>
                <br/>
                <?php
            } else {
                echo "Size: ".$rowS['size_name']." | Color: ".$rowS['color_name']." | <b style='color:red'>Out of Stock</b><br/>";
            }
        }

        if(!$hasStock) {
            echo "<b style='color:red'>Completely Out of Stock</b>";
        }
        ?>
        </td>
    </tr>
    <?php
}
?>

</table>