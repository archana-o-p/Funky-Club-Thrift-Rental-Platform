<?php
include("../Connection/Connection.php");
session_start();

$pid = $_GET["pid"];
$sid = $_GET["sid"];
$cid = $_GET["cid"];
$uid = $_SESSION["uid"];

$selqry = "SELECT * FROM tbl_booking WHERE user_id='$uid' AND booking_status='0'";
$result = $con->query($selqry);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $bid = $row["booking_id"];
} else {
    $insQry = "INSERT INTO tbl_booking(user_id, booking_date) VALUES('$uid', CURDATE())";
    if ($con->query($insQry)) {
        $selqry1 = "SELECT MAX(booking_id) as id FROM tbl_booking WHERE user_id='$uid'";
        $result = $con->query($selqry1);
        $row = $result->fetch_assoc();
        $bid = $row["id"];
    } else {
        echo "Failed to create booking";
        exit;
    }
}

$chkQry = "SELECT * FROM tbl_cart 
           WHERE booking_id='$bid' 
           AND product_id='$pid' 
           AND size_id='$sid' 
           AND color_id='$cid'";
$result = $con->query($chkQry);

if ($result->num_rows > 0) {
    echo "Already Added to Cart";
    exit;
}

$selStock = "SELECT SUM(stock_count) as stock 
             FROM tbl_stock 
             WHERE product_id='$pid' AND size_id='$sid' AND color_id='$cid'";
$stockRes = $con->query($selStock)->fetch_assoc();
$totalStock = $stockRes['stock'] ? $stockRes['stock'] : 0;

$selCart = "SELECT SUM(cart_qty) as cart_qty 
            FROM tbl_cart 
            WHERE product_id='$pid' AND size_id='$sid' AND color_id='$cid' AND cart_status>0";
$cartRes = $con->query($selCart)->fetch_assoc();
$totalCart = $cartRes['cart_qty'] ? $cartRes['cart_qty'] : 0;

$remaining = $totalStock - $totalCart;

if ($remaining <= 0) {
    echo "Out of Stock";
    exit;
}

$insQry1 = "INSERT INTO tbl_cart(product_id, booking_id, size_id, color_id, cart_qty) 
            VALUES('$pid', '$bid', '$sid', '$cid', 1)";
if ($con->query($insQry1)) {
    echo "Added to Cart";
} else {
    echo "Failed";
}
?>
