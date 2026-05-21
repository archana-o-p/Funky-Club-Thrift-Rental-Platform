<option value="">SELECT</option>
<?php
include("../Connection/Connection.php");
 
  $selQry="select * from tbl_subcategory where category_id='".$_GET['did']."'";
  $result=$con->query($selQry);
  while($row=$result->fetch_assoc())
  {
	  ?>
      <option value="<?php echo $row["subcategory_id"] ?>">
      <?php echo $row["subcategory_name"] ?>
      </option>
      <?php
  }
	  ?>