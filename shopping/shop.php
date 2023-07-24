<?php
require '../db/db.php';
session_start();
$sql = "SELECT *FROM products";
$res = $conn->query($sql);
$user_id = $_SESSION['login']['User_id'];


?>
<!doctype html>
<html class="no-js" lang="">

<!-- Mirrored from themebeyond.com/pre/ganic-prev/ganic-live/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Jun 2023 14:28:18 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ganic - Organic Food & Grocery Market Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>

    <!-- preloader -->
    <div id="preloader">
        <div id="loading-center">
            <div class="loader">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- preloader-end -->

    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    <header>



        <!-- header-search-area -->
        <div class="header-search-area">
            <div class="container custom-container">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-3 d-none d-lg-block">
                        <div class="logo">
                            <a href="index.html"><img class="logo2" src="img/logo/snapedit_1687489281555.jpeg" alt="Logo"></a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-9">
                        <div class="d-block d-sm-flex align-items-center justify-content-end">
                            <div class="header-search-wrap">
                                <form action="#">
                                    <select class="custom-select">
                                        <option selected="">All Categories</option>
                                        <option>-- Grocery & Frozen</option>
                                        <option>-- Fresh Fruits</option>
                                        <option>-- Fresh Fish</option>
                                        <option>-- Fresh Nuts</option>
                                        <option>-- Fresh Meats</option>
                                        <option>-- Bread & Bakery</option>
                                        <option>-- Vegetable</option>
                                        <option>-- Kids Food</option>
                                        <option>-- Dried Fruits</option>
                                        <option>-- Others Food</option>
                                    </select>
                                    <input type="text" placeholder="Search Product...">
                                    <button><i class="flaticon-loupe-1"></i></button>
                                </form>
                            </div>
                            <div class="header-action">
                                <ul>
                                    <li class="header-phone">
                                        <div class="icon"><i class="flaticon-telephone"></i></div>
                                        <a href="tel:1234566789"><span>Call Us Now</span>+185 4124 650</a>
                                    </li>
                                    <li class="header-user"><a href="#"><i class="flaticon-user"></i></a></li>
                                    <li class="header-wishlist">
                                        <a href="#"><i class="flaticon-heart-shape-outline"></i></a>
                                    </li>
                                    <li class="header-cart-action">
                                        <div class="header-cart-wrap">
                                            <a href="cart.php"><i class="flaticon-shopping-basket"></i></a>
                                            <ul class="minicart">
                                                <?php
                                                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'][$user_id]) && $_SESSION['login']) {
                                                    foreach ($_SESSION['cart'][$user_id] as $product_id => $value) {
                                                ?>
                                                        <li class="d-flex align-items-start">
                                                            <div class="cart-img">
                                                                <a href="shop-details.html"><img src="../admin/upload_mau/<?php echo $value['img']; ?>" alt=""></a>
                                                            </div>
                                                            <div class="cart-content">
                                                                <h4><a href="shop-details.html"><?php echo $value['name_sp']; ?></a></h4>
                                                                <div class="cart-price">
                                                                    <span class="new"><?php echo number_format($value['price'], 2); ?>_VND</span>
                                                                </div>
                                                                <div>
                                                                    SL: <span><?php echo $value['quantity']; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="del-icon">
                                                                <form action="./xoa.php" class="num-block" method="post">
                                                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                                                    <button type="submit" name="xoa" style="border: none; background: none; cursor: pointer;"><i class="far fa-trash-alt"></i></button>
                                                                </form>
                                                            </div>
                                                        </li>
                                                <?php }
                                                } else {
                                                    echo "Giỏ hàng rỗng.";
                                                } ?>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-search-area-end -->

        <div id="sticky-header" class="menu-area">
            <div class="container custom-container">
                <div class="row">
                    <div class="col-12">
                        <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                        <div class="menu-wrap">
                            <nav class="menu-nav">
                                <div class="logo d-block d-lg-none">
                                <a href="index.php"><img src="img/logo/logo.png" alt=""></a>
                                </div>
                                <div class="header-category d-none d-lg-block">
                                    <a href="#" class="cat-toggle"><i class="fas fa-bars"></i>ALL DEPARTMENT<i class="fas fa-angle-down"></i></a>
                                    <ul class="category-menu">
                                        <li class="menu-item-has-children"><a href="shop.html"><i class="flaticon-groceries"></i> Grocery & Frozen</a>
                                            <ul class="megamenu">
                                                <li class="sub-column-item"><a href="shop.html">Grocery & Frozen</a>
                                                    <ul>
                                                        <li><a href="shop.html">Organic Broccoli</a></li>
                                                        <li><a href="shop.html">Walnuts Max</a></li>
                                                        <li><a href="shop.html">Mat Orange</a></li>
                                                        <li><a href="shop.html">France Potato</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Organic Fresh Fruits</a>
                                                    <ul>
                                                        <li><a href="shop.html">Watermelon</a></li>
                                                        <li><a href="shop.html">Black Grapes</a></li>
                                                        <li><a href="shop.html">Grassland Dairy</a></li>
                                                        <li><a href="shop.html">Organic Broccoli</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Fresh Bread & Bakery</a>
                                                    <ul>
                                                        <li><a href="shop.html">Grassland Dairy</a></li>
                                                        <li><a href="shop.html">Walnuts Max</a></li>
                                                        <li><a href="shop.html">Powders Dairy</a></li>
                                                        <li><a href="shop.html">Ice cream</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Organic Fresh Meat</a>
                                                    <ul>
                                                        <li><a href="shop.html">Fresh Butter</a></li>
                                                        <li><a href="shop.html">Orange Sliced</a></li>
                                                        <li><a href="shop.html">Carrots Group</a></li>
                                                        <li><a href="shop.html">Poultry Farm</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Organic Dried Fruit</a>
                                                    <ul>
                                                        <li><a href="shop.html">Fresh Nuts</a></li>
                                                        <li><a href="shop.html">France Potato</a></li>
                                                        <li><a href="shop.html">Green Chilies</a></li>
                                                        <li><a href="shop.html">Organic Broccoli</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Organic Other Foods</a>
                                                    <ul>
                                                        <li class="mega-menu-banner"><a href="shop.html"><img src="img/images/megamenu_banner.jpg" alt=""></a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="shop.html"><i class="flaticon-cherry"></i> Fresh Fruits</a></li>
                                        <li><a href="shop.html"><i class="flaticon-fish"></i> Fresh Fish</a></li>
                                        <li class="menu-item-has-children"><a href="shop.html"><i class="flaticon-hazelnut"></i> Fresh Nuts</a>
                                            <ul class="megamenu">
                                                <li class="sub-column-item"><a href="shop.html">Grocery & Frozen</a>
                                                    <ul>
                                                        <li><a href="shop.html">Organic Broccoli</a></li>
                                                        <li><a href="shop.html">Walnuts Max</a></li>
                                                        <li><a href="shop.html">Mat Orange</a></li>
                                                        <li><a href="shop.html">France Potato</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Organic Fresh Fruits</a>
                                                    <ul>
                                                        <li><a href="shop.html">Watermelon</a></li>
                                                        <li><a href="shop.html">Black Grapes</a></li>
                                                        <li><a href="shop.html">Grassland Dairy</a></li>
                                                        <li><a href="shop.html">Organic Broccoli</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Fresh Bread & Bakery</a>
                                                    <ul>
                                                        <li><a href="shop.html">Grassland Dairy</a></li>
                                                        <li><a href="shop.html">Walnuts Max</a></li>
                                                        <li><a href="shop.html">Powders Dairy</a></li>
                                                        <li><a href="shop.html">Ice cream</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Organic Fresh Meat</a>
                                                    <ul>
                                                        <li><a href="shop.html">Fresh Butter</a></li>
                                                        <li><a href="shop.html">Orange Sliced</a></li>
                                                        <li><a href="shop.html">Carrots Group</a></li>
                                                        <li><a href="shop.html">Poultry Farm</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Organic Dried Fruit</a>
                                                    <ul>
                                                        <li><a href="shop.html">Fresh Nuts</a></li>
                                                        <li><a href="shop.html">France Potato</a></li>
                                                        <li><a href="shop.html">Green Chilies</a></li>
                                                        <li><a href="shop.html">Organic Broccoli</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Organic Other Foods</a>
                                                    <ul>
                                                        <li class="mega-menu-banner"><a href="shop.html"><img src="img/images/megamenu_banner02.jpg" alt=""></a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="shop.html"><i class="flaticon-meat"></i> Fresh Meat</a></li>
                                        <li class="menu-item-has-children"><a href="shop.html"><i class="flaticon-cupcake"></i> Bread & Bakery</a>
                                            <ul class="megamenu">
                                                <li class="sub-column-item"><a href="shop.html">Grocery & Frozen</a>
                                                    <ul>
                                                        <li><a href="shop.html">Organic Broccoli</a></li>
                                                        <li><a href="shop.html">Walnuts Max</a></li>
                                                        <li><a href="shop.html">Mat Orange</a></li>
                                                        <li><a href="shop.html">France Potato</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Organic Fresh Fruits</a>
                                                    <ul>
                                                        <li><a href="shop.html">Watermelon</a></li>
                                                        <li><a href="shop.html">Black Grapes</a></li>
                                                        <li><a href="shop.html">Grassland Dairy</a></li>
                                                        <li><a href="shop.html">Organic Broccoli</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Fresh Bread & Bakery</a>
                                                    <ul>
                                                        <li><a href="shop.html">Grassland Dairy</a></li>
                                                        <li><a href="shop.html">Walnuts Max</a></li>
                                                        <li><a href="shop.html">Powders Dairy</a></li>
                                                        <li><a href="shop.html">Ice cream</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Organic Fresh Meat</a>
                                                    <ul>
                                                        <li><a href="shop.html">Fresh Butter</a></li>
                                                        <li><a href="shop.html">Orange Sliced</a></li>
                                                        <li><a href="shop.html">Carrots Group</a></li>
                                                        <li><a href="shop.html">Poultry Farm</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Organic Dried Fruit</a>
                                                    <ul>
                                                        <li><a href="shop.html">Fresh Nuts</a></li>
                                                        <li><a href="shop.html">France Potato</a></li>
                                                        <li><a href="shop.html">Green Chilies</a></li>
                                                        <li><a href="shop.html">Organic Broccoli</a></li>
                                                    </ul>
                                                </li>
                                                <li class="sub-column-item"><a href="shop.html">Organic Other Foods</a>
                                                    <ul>
                                                        <li class="mega-menu-banner"><a href="shop.html"><img src="img/images/megamenu_banner.jpg" alt=""></a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a href="shop.html"><i class="flaticon-broccoli"></i> Vegetable</a></li>
                                        <li><a href="shop.html"><i class="flaticon-pop-corn-1"></i> Popcorn</a></li>
                                        <li><a href="shop.html"><i class="flaticon-nut"></i> Dried Fruit</a></li>
                                    </ul>
                                </div>
                                <div class="navbar-wrap main-menu d-none d-lg-flex">
                                    <ul class="navigation">
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="cart.php">Cart</a></li>
                                        <li><a href="shop.php">Grocery</a></li>
                                    </ul>
                                </div>

                            </nav>
                        </div>
                        <!-- Mobile Menu  -->
                        <div class="mobile-menu">
                            <nav class="menu-box">
                                <div class="close-btn"><i class="fas fa-times"></i></div>
                                <div class="nav-logo"><a href="index.html"><img src="img/logo/logo.png" alt="" title=""></a>
                                </div>
                                <div class="menu-outer">
                                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                                </div>
                                <div class="social-links">
                                    <ul class="clearfix">
                                        <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                                        <li><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                                        <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                                        <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                        <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="menu-backdrop"></div>
                        <!-- End Mobile Menu -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area-end -->


    <!-- main-area -->
    <main>



        <!-- shop-area -->
        <section class="shop--area pt-90 pb-90">
            <div class="container">
                <div class="row justify-content-center">

                    <div class="col-9">
                        <div class="shop-discount-area">
                            <div class="discount-content shop-discount-content">
                                <span>healthy food</span>
                                <h4 class="title"><a href="shop.html">organic farm for ganic</a></h4>
                                <p>Super Offer TO 50% OFF</p>
                                <a href="shop.html" class="btn rounded-btn">shop now</a>
                            </div>
                        </div>

                        <div class="shop-products-wrap">
                            <div class="row justify-content-center">
                                <?php while ($product = $res->fetch_assoc()) { ?>

                                    <div class="col-xl-3 col-md-4 col-sm-6">

                                        <div class="sp-product-item">
                                            <div class="sp-product-thumb">
                                                <a href="shop-details.html"> <img src="../admin/upload_mau/<?php echo $product["img"]; ?>" alt="<?php echo $product["name_sp"]; ?>">
                                                </a>
                                            </div>
                                            <div class="sp-product-content">
                                                <div class="rating">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <h6 class="title">
                                                    <a href="shop-details.php?detail=<?php echo $product['product_id']; ?>">
                                                        <?php echo $product["name_sp"]; ?>
                                                    </a>
                                                </h6>
                                                <p><?php echo number_format($product["price"]); ?> VND</p>
                                                <div class="sp-cart-wrap">
                                                    <div class="shop-perched-info">
                                                        <form action="./cart.php" method="get">
                                                            <button class="btn btn-primary" name="product_id" type="submit" value="<?php echo $product['product_id']; ?>">mua ngay</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php } ?>


                            </div>
                        </div>
                        <div class="pagination-wrap">
                            <ul>
                                <li class="prev"><a href="shop.php">Prev</a></li>
                                <li><a href="shop.php">1</a></li>
                                <li class="active"><a href="shop.php">2</a></li>
                                <li><a href="shop.php">3</a></li>
                                <li><a href="shop.php">4</a></li>
                                <li><a href="shop.php">...</a></li>
                                <li><a href="shop.php">10</a></li>
                                <li class="next"><a href="shop.html">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- shop-area-end -->

    </main>
    <!-- main-area-end -->


    <!-- footer-area -->
    <footer>
        <div class="footer-area gray-bg pt-80 pb-30">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="footer-widget mb-50">
                            <div class="footer-logo mb-25">
                                <a href="index.html"><img src="img/logo/logo.png" alt=""></a>
                            </div>
                            <div class="footer-contact-list">
                                <ul>
                                    <li>
                                        <div class="icon"><i class="flaticon-place"></i></div>
                                        <p>PO Box W75 Street West New Queens, TX 16819</p>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="flaticon-telephone-1"></i></div>
                                        <h5 class="number"><a href="tel:12027993245">+120 279 932 45</a></h5>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="flaticon-mail"></i></div>
                                        <p><a href="https://themebeyond.com/cdn-cgi/l/email-protection#097a7c7979667b7d497f6c6e6c67276a6664"><span class="__cf_email__" data-cfemail="6c1f191c1c031e182c1a090b0902420f0301">[email&#160;protected]</span></a></p>
                                    </li>
                                    <li>
                                        <div class="icon"><i class="flaticon-wall-clock"></i></div>
                                        <p>Week 7 days from 7:00 to 20:00</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="footer-social">
                                <ul>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-widget mb-50">
                            <div class="fw-title">
                                <h5 class="title">Customer Service</h5>
                            </div>
                            <div class="fw-link">
                                <ul>
                                    <li><a href="shop.html">Secure Shopping</a></li>
                                    <li><a href="cart.html">Order Status</a></li>
                                    <li><a href="shop.html">International Shipping</a></li>
                                    <li><a href="checkout.html">Payment Method</a></li>
                                    <li><a href="blog.html">Our Blog</a></li>
                                    <li><a href="terms-conditios.html">Orders and Returns</a></li>
                                    <li><a href="checkout.html">Track Your Orders</a></li>
                                    <li><a href="index.html">Footer Links</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                        <div class="footer-widget mb-50">
                            <div class="fw-title">
                                <h5 class="title">Useful Links</h5>
                            </div>
                            <div class="fw-link">
                                <ul>
                                    <li><a href="checkout.html">Delivery</a></li>
                                    <li><a href="terms-conditios.html">Legal Notice</a></li>
                                    <li><a href="about-us.html">About us</a></li>
                                    <li><a href="contact.html">Sitemap</a></li>
                                    <li><a href="checkout.html">Track Your Orders</a></li>
                                    <li><a href="index.html">Footer Links</a></li>
                                    <li><a href="terms-conditios.html">Orders and Returns</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="footer-widget footer-box-widget mb-50">
                            <div class="f-download-wrap">
                                <div class="fw-title">
                                    <h5 class="title">Download App</h5>
                                </div>
                                <div class="download-btns">
                                    <a href="index.html"><img src="img/icon/g_play.png" alt=""></a>
                                    <a href="index.html"><img src="img/icon/app_store.png" alt=""></a>
                                </div>
                            </div>
                            <div class="f-newsletter">
                                <div class="fw-title">
                                    <h5 class="title">Newsletter</h5>
                                </div>
                                <form action="#">
                                    <input type="email" placeholder="Email Address">
                                    <button><i class="flaticon-send"></i></button>
                                </form>
                                <p>Do Not Show Your Mail</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="copyright-text">
                            <p>Copyright &copy; 2021 Ganic All Rights Reserved</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-accepted text-center text-md-right">
                            <img src="img/images/payment_card.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer-area-end -->





    <!-- JS here -->
    <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="js/vendor/jquery-3.6.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
</body>

<!-- Mirrored from themebeyond.com/pre/ganic-prev/ganic-live/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Jun 2023 14:28:43 GMT -->

</html>