<?php
$obj = new adminBack();
$ctg = $obj->p_display_category();
$ctgDatas = array();
while ($data = mysqli_fetch_assoc($ctg)) {
    $ctgDatas[] = $data;
}

if (isset($_POST['addtocart'])) {
    if (isset($_SESSION['cart'])) {
        $products_name = array_column($_SESSION['cart'], 'pdt_name');
        if (in_array($_POST['pdt_name'], $products_name)) {
            echo "
                <script>
                    alert('This product already added!');
                </script>
            ";
        } else {

            $count = count($_SESSION['cart']);
            $_SESSION['cart'][$count] = array(
                'pdt_name' => $_POST['pdt_name'],
                'pdt_price' => $_POST['pdt_price'],
                'pdt_img' => $_POST['pdt_img'],
                'quantity' => 1,
            );
        }
    } else {
        $_SESSION['cart'][0] = array(
            'pdt_name' => $_POST['pdt_name'],
            'pdt_price' => $_POST['pdt_price'],
            'pdt_img' => $_POST['pdt_img'],
            'quantity' => 1,
        );
    }
}
if(isset($_POST['remove_product'])){
    foreach($_SESSION['cart'] as $key => $value){
        if($value['pdt_name']== $_POST['remove_pdt_name']){
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart']=array_values($_SESSION['cart']);
        }
    }
}

?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Biolife - Organic Food</title>
    
    <link rel="stylesheet" href="assets2/css/animate.min.css">
    <link rel="stylesheet" href="assets2/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets2/css/nice-select.css">
    <link rel="stylesheet" href="assets2/css/slick.min.css">
    <link rel="stylesheet" href="assets2/css/style.css">
    <link rel="stylesheet" href="assets2/css/main-color.css">
</head>

<body class="biolife-body">


    <!--Cart Table-->
    <div class="shopping-cart-container">
        <div class="row">
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <h3 class="box-title">Your cart items</h3>
                <form class="shopping-cart-form" action="#" method="post">
                    <table class="shop_table cart-form">
                        <thead>
                            <tr>
                                <th class="product-name">Product Name</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Remove</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-subtotal">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($_SESSION['cart'])){foreach ($_SESSION['cart'] as $key => $value){ ?>
                            <tr class="cart_item">
                                <td class="product-thumbnail" data-title="Product Name">
                                    <a class="prd-thumb" href="#">
                                        <figure><img width="113" height="113" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvoYoAzSLYwbpqcym261i1pkDldVJDv04mh85WHWo6G9IAJ-HcRen4cbdHAqq-x8BnvpQ&usqp=CAU" alt="shipping cart"></figure>
                                    </a>
                                    <a class="prd-name" href="#"><?php echo $value['pdt_name']; ?></a>
                                </td>
                                <td class="product-price" data-title="Price">
                                    <div class="price price-contain">
                                        <ins><span class="price-amount"><span class="currencySymbol">TK.</span><?php echo $value['pdt_price']; ?></span></ins>
                                    </div>
                                </td>
                                <td class="product-quantity" data-title="Remove">
                                            <form action="" method="POST">
                                                <input type="hidden" name="remove_pdt_name" value="<?php echo $value['pdt_name']; ?>">
                                                    <input class="btn btn_warning" type="submit" value="Remove" name="remove_product">
                                                </div>
                                            </div>
                                        </td>
                                <td class="product-quantity" data-title="Quantity">
                                            <div class="quantity-box type1">
                                                <div class="qty-input">
                                                    <input type="text" name="qty12554" value="1" data-max_value="20" data-min_value="1" data-step="1">
                                                    <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                                    <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal" data-title="Total">
                                            <div class="price price-contain">
                                                <ins><span class="price-amount"><span class="currencySymbol">TK.</span>85.00</span></ins>
                                            </div>
                                        </td>
                            </tr>
                            <?php }}else{
                                    echo "Your Cart is now empty";
                            } ?>

                            <tr class="cart_item wrap-buttons">
                                <td class="wrap-btn-control" colspan="4">
                                    <a href="add-order.php" class="btn back-to-shop">Back to Shop</a>
                                    <button class="btn btn-update" type="submit" disabled>update</button>
                                    <button class="btn btn-clear" type="reset">clear all</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                <div class="shpcart-subtotal-block">
                    <div class="subtotal-line">
                        <b class="stt-name">Subtotal <span class="sub">(2ittems)</span></b>
                        <span class="stt-price">£170.00</span>
                    </div>
                    <div class="subtotal-line">
                        <b class="stt-name">Shipping</b>
                        <span class="stt-price">£0.00</span>
                    </div>
                    <div class="tax-fee">
                        <p class="title">Est. Taxes & Fees</p>
                        <p class="desc">Based on 56789</p>
                    </div>
                    <div class="btn-checkout">
                        <a href="#" class="btn checkout">Check out</a>
                    </div>

                </div>
            </div>
        </div>
    </div>



    </div>
    </div>
    </div>




    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <script src="assets2/js/jquery-3.4.1.min.js"></script>
    <script src="assets2/js/bootstrap.min.js"></script>
    <script src="assets2/js/jquery.countdown.min.js"></script>
    <script src="assets2/js/jquery.nice-select.min.js"></script>
    <script src="assets2/js/jquery.nicescroll.min.js"></script>
    <script src="assets2/js/slick.min.js"></script>
    <script src="assets2/js/biolife.framework.js"></script>
    <script src="assets2/js/functions.js"></script>
</body>

</html>