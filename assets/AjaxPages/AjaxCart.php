<?php
include("../Connection/Connection.php");

if($_GET["action"]=="Update") {
    $cartid = $_GET["id"];
    $qty = $_GET["qty"];
    $up = "UPDATE tbl_cart SET cart_qty='$qty' WHERE cart_id='$cartid'";
    $con->query($up);
}

if($_GET["action"]=="Delete") {
    $cartid = $_GET["id"];
    $del = "DELETE FROM tbl_cart WHERE cart_id='$cartid'";
    $con->query($del);
}

if($_GET["action"]=="ChangeSize") {
    $cartid = $_GET["id"];
    $sizeid = $_GET["size"];
    $up = "UPDATE tbl_cart SET size_id='$sizeid' WHERE cart_id='$cartid'";
    if($con->query($up)) echo "Size updated"; else echo "Failed";
}

if($_GET["action"]=="ChangeColor") {
    $cartid = $_GET["id"];
    $colorid = $_GET["color"];
    $up = "UPDATE tbl_cart SET color_id='$colorid' WHERE cart_id='$cartid'";
    if($con->query($up)) echo "Color updated"; else echo "Failed";
}
?>
