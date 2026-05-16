<?php
session_start();
include("../Assets/Connection/Connection.php");
include("Head.php");

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 60px 20px;
            color: #333;
        }

        h1 {
            font-weight: 600;
            font-size: 32px;
            text-align: center;
            margin-bottom: 40px;
            color: #222;
        }

        .cantainer {
            max-width: 1150px;
            margin: 0 auto;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
        }

        /* --- Table Header --- */
        .column-labels {
            display: grid;
            grid-template-columns: 13% 18% 10% 10% 10% 10% 10% 9%;
            font-weight: 600;
            font-size: 14px;
            color: #555;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
            text-align: center;
        }

        /* --- Product Row --- */
        .product {
            display: grid;
            grid-template-columns: 13% 18% 10% 10% 10% 10% 10% 9%;
            align-items: center;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 14px;
            padding: 15px 10px;
            margin-bottom: 15px;
            transition: all 0.25s ease;
        }

        .product:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        /* --- Image --- */
        .product-image img {
            width: 90px;
            height: 90px;
            border-radius: 10px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* --- Details --- */
        .product-details {
            text-align: left;
        }

        .product-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 4px;
            color: #222;
        }

        .product-description {
            font-size: 13px;
            color: #777;
            margin: 0;
        }

        /* --- Select Fields --- */
        .product select {
            width: 80%;
            padding: 6px 8px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
            background: #f9f9f9;
            outline: none;
        }

        /* --- Price & Total --- */
        .product-price,
        .product-line-price {
            font-weight: 600;
            font-size: 15px;
            color: #111;
            text-align: center;
        }

        /* --- Remove Button --- */
        .remove-product {
            border: none;
            background: #ff5c5c;
            color: #fff;
            padding: 8px 14px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            transition: 0.3s;
        }

        .remove-product:hover {
            background: #e04646;
            transform: scale(1.05);
        }

        /* --- Totals Section --- */
        .totals {
            margin-top: 30px;
            border-top: 2px solid #eee;
            padding-top: 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .totals-item {
            display: flex;
            gap: 10px;
            align-items: center;
            font-size: 18px;
            font-weight: 600;
        }

        .totals-value {
            font-size: 22px;
            color: #111;
        }

        /* --- Checkout Section --- */
        .checkout-section {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
        }

        .checkout {
            border: none;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: #fff;
            padding: 12px 30px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.25);
        }

        .checkout:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 123, 255, 0.35);
        }

        /* --- Switch Button --- */
        .switch2 {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 32px;
            border-radius: 25px;
            background-color: #ccc;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .switch2 input {
            display: none;
        }

        .switch2 div {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 26px;
            height: 26px;
            background: #fff;
            border-radius: 50%;
            transition: 0.3s;
        }

        .switch2 input:checked+div {
            left: 31px;
        }

        .switch2-checked {
            background-color: #2ecc71;
        }

        @media (max-width: 900px) {

            .column-labels,
            .product {
                grid-template-columns: repeat(2, 1fr);
                row-gap: 12px;
            }

            .checkout-section {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
    </style>
</head>

<?php
if (isset($_POST["btn_checkout"])) {
    // Get cart items for checkout
    $sel = "SELECT * FROM tbl_booking b 
            INNER JOIN tbl_cart c ON c.booking_id=b.booking_id 
            WHERE b.user_id='" . $_SESSION["uid"] . "' AND booking_status='0' AND cart_status=0";
    $res = $con->query($sel);

    if ($res->num_rows > 0) {
        $firstItem = $res->fetch_assoc();

        // Redirect to checkout with product details
        echo "<script>
                window.location='Checkout.php?pid=" . $firstItem["product_id"] .
            "&sid=" . $firstItem["size_id"] .
            "&cid=" . $firstItem["color_id"] .
            "&qty=" . $firstItem["cart_qty"] . "';
              </script>";
        exit;
    } else {
        echo "<script>alert('No products selected!');</script>";
    }
}
?>

<body onload="recalculateCart()">
    <div class="cantainer">
        <h1><i class="fa-solid fa-cart-shopping"></i> Your Cart</h1>

        <div class="column-labels">
            <label>Image</label>
            <label>Details</label>
            <label>Price</label>
            <label>Size</label>
            <label>Color</label>
            <label>Qty</label>
            <label>Remove</label>
            <label>Total</label>
        </div>

        <form method="post">
            <div class="shopping-cart">
                <?php
                $sel = "SELECT * FROM tbl_booking b 
                    INNER JOIN tbl_cart c ON c.booking_id=b.booking_id 
                    LEFT JOIN tbl_size sz ON sz.size_id=c.size_id
                    LEFT JOIN tbl_color co ON co.color_id=c.color_id
                    WHERE b.user_id='" . $_SESSION["uid"] . "' AND booking_status='0' AND cart_status=0";
                $res = $con->query($sel);
                while ($row = $res->fetch_assoc()) {
                    $selPr = "SELECT * FROM tbl_product WHERE product_id='" . $row["product_id"] . "'";
                    $respr = $con->query($selPr);
                    if ($rowpr = $respr->fetch_assoc()) {
                        ?>
                        <div class="product">
                            <div class="product-image">
                                <img src="../Assets/files/Product/<?php echo $rowpr["product_photo"] ?>" />
                            </div>
                            <div class="product-details">
                                <div class="product-title"><?php echo $rowpr["product_name"] ?></div>
                                <p class="product-description"><?php echo $rowpr["product_details"] ?></p>
                            </div>
                            <div class="product-price"><?php echo $rowpr["product_price"] ?></div>
                            <div class="product-size">
                                <select class="cart-size" data-cartid="<?php echo $row["cart_id"]; ?>">
                                    <?php
                                    $sizeQry = "SELECT DISTINCT st.size_id, sz.size_name 
                                    FROM tbl_stock st 
                                    INNER JOIN tbl_size sz ON sz.size_id=st.size_id
                                    WHERE st.product_id='" . $rowpr["product_id"] . "' AND st.stock_count>0";
                                    $sizeRes = $con->query($sizeQry);
                                    while ($sz = $sizeRes->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $sz["size_id"]; ?>" <?php if ($row["size_id"] == $sz["size_id"])
                                               echo "selected"; ?>>
                                            <?php echo $sz["size_name"]; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="product-color">
                                <select class="cart-color" data-cartid="<?php echo $row["cart_id"]; ?>">
                                    <?php
                                    $colorQry = "SELECT DISTINCT st.color_id, co.color_name 
                                     FROM tbl_stock st 
                                     INNER JOIN tbl_color co ON co.color_id=st.color_id
                                     WHERE st.product_id='" . $rowpr["product_id"] . "' AND st.stock_count>0";
                                    $colorRes = $con->query($colorQry);
                                    while ($cl = $colorRes->fetch_assoc()) {
                                        ?>
                                        <option value="<?php echo $cl["color_id"]; ?>" <?php if ($row["color_id"] == $cl["color_id"])
                                               echo "selected"; ?>>
                                            <?php echo $cl["color_name"]; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="product-quantity">
                                <select id="<?php echo $row["cart_id"] ?>" class="cart-qty">
                                    <?php
                                    $selstock = "SELECT SUM(stock_count) as stock 
                                     FROM tbl_stock 
                                     WHERE product_id='" . $rowpr["product_id"] . "' 
                                     AND size_id='" . $row["size_id"] . "' 
                                     AND color_id='" . $row["color_id"] . "'";
                                    $rowst = $con->query($selstock)->fetch_assoc();
                                    $selstock1 = "SELECT SUM(cart_qty) as quantity 
                                      FROM tbl_cart 
                                      WHERE product_id='" . $rowpr["product_id"] . "' 
                                      AND size_id='" . $row["size_id"] . "' 
                                      AND color_id='" . $row["color_id"] . "' 
                                      AND cart_status >'1'";
                                    $chk = $con->query($selstock1)->fetch_assoc();
                                    $available = ($rowst["stock"] ? $rowst["stock"] : 0) - ($chk["quantity"] ? $chk["quantity"] : 0);
                                    if ($available < 0)
                                        $available = 0;
                                    if ($available > 0) {
                                        for ($k = 1; $k <= $available; $k++) {
                                            ?>
                                            <option <?php if ($row["cart_qty"] == $k) {
                                                echo "selected";
                                            } ?> value="<?php echo $k ?>">
                                                <?php echo $k ?></option>
                                            <?php
                                        }
                                    } else {
                                        echo "<option value='0'>Out of Stock</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="product-removal">
                                <button class="remove-product" value="<?php echo $row["cart_id"] ?>"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                            <div class="product-line-price">
                                <?php echo (int) $rowpr["product_price"] * (int) $row["cart_qty"]; ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <div class="totals">
                <div class="totals-item totals-item-total">
                    <label>Grand Total:</label>
                    <div class="totals-value" id="cart-total">0</div>
                    <input type="hidden" id="cart-totalamt" name="carttotalamt" value="" />
                </div>
            </div>

            <div class="checkout-section">
                <span>COD</span>
                <label class="switch2 switch2-checked">
                    <input type="checkbox" name="cb_checkout" checked />
                    <div></div>
                </label>
                <span>Card</span>
                <button type="submit" class="checkout" name="btn_checkout">Checkout</button>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        var fadeTime = 300;
        $(".cart-qty").change(function () {
            $.ajax({ url: "../Assets/AjaxPages/AjaxCart.php?action=Update&id=" + this.id + "&qty=" + this.value });
            updateQuantity(this);
        });
        $(".product-removal button").click(function () {
            $.ajax({ url: "../Assets/AjaxPages/AjaxCart.php?action=Delete&id=" + this.value });
            removeItem(this);
        });
        $(".cart-size").change(function () {
            var cartid = $(this).data("cartid"), sizeid = $(this).val();
            $.ajax({
                url: "../Assets/AjaxPages/AjaxCart.php?action=ChangeSize&id=" + cartid + "&size=" + sizeid,
                success: function (res) { alert(res); location.reload(); }
            });
        });
        $(".cart-color").change(function () {
            var cartid = $(this).data("cartid"), colorid = $(this).val();
            $.ajax({
                url: "../Assets/AjaxPages/AjaxCart.php?action=ChangeColor&id=" + cartid + "&color=" + colorid,
                success: function (res) { alert(res); location.reload(); }
            });
        });
        function recalculateCart() {
            var subtotal = 0;
            $(".product").each(function () {
                subtotal += parseFloat($(this).children(".product-line-price").text());
            });
            $(".totals-value").fadeOut(fadeTime, function () {
                $("#cart-total").html(subtotal.toFixed(2));
                $("#cart-totalamt").val(subtotal.toFixed(2));
                $(".totals-value").fadeIn(fadeTime);
            });
        }
        function updateQuantity(input) {
            var productRow = $(input).closest(".product"),
                price = parseFloat(productRow.children(".product-price").text()),
                quantity = $(input).val(),
                linePrice = price * quantity;
            productRow.children(".product-line-price").fadeOut(fadeTime, function () {
                $(this).text(linePrice.toFixed(2));
                recalculateCart();
                $(this).fadeIn(fadeTime);
            });
        }
        function removeItem(btn) {
            var row = $(btn).closest(".product");
            row.slideUp(fadeTime, function () {
                row.remove();
                recalculateCart();
            });
        }
    </script>
</body>

</html>
<?php include("Foot.php"); ?>