<?php
session_start();
if (empty($_SESSION['loggedin'])) {
    header('location:index.php');
    exit();
} else {
    require '../db/db.php';
    require '../db/thong_tin.php';
    $errors = [];

    mysqli_select_db($conn, "shopping");
    $sql = "SELECT * FROM product_company  
        INNER JOIN Products ON product_company.product_company_id = Products.product_company_id2
        INNER JOIN Galery ON  Galery.product_id2 = Products.product_id 
        
     GROUP BY Galery.product_id2 ";
    $result = $conn->query($sql);

    if (isset($_POST['xoa'])) {
        $productId = $_POST['productId'];

        $sqlDeleteGalery = "DELETE FROM Galery WHERE product_id2='$productId'";
        $conn->query($sqlDeleteGalery);

        // $sqlDeleteGalery2 = "DELETE FROM Order_Details WHERE product_id='$productId'";
        // $conn->query($sqlDeleteGalery2);

        $sqlDeleteProduct = "DELETE FROM Products WHERE product_id='$productId'";
        if ($conn->query($sqlDeleteProduct) === true) {
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        } else {
            echo "Lỗi khi xóa sản phẩm: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tables</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                        <a class="nav-link" href="./more_product.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Thêm các loại sản phẩm
                        </a>
                        <a class="nav-link" href="./product_company.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Thêm hãng
                        </a>
                        <a class="nav-link" href="products.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Thêm Sản Phẩm
                        </a>
                        <a class="nav-link collapsed" href="oder.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Danh Sách Đặt Hàng
                        </a>
                        <a class="nav-link" href="login_out.php">
                            <div class="sb-nav-link-icon"><i class="fa-sharp fa-light fa-right-from-bracket"></i></div>
                            Đăng Xuất
                        </a>
                    </div>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Tables</h1>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>

                                        <th>ID</th>
                                        <th>Loại Sản Phẩm </th>
                                        <th>Tên</th>
                                        <th>Ảnh</th>
                                        <th>Ảnh Chi Tiết</th>
                                        <th>Giá Nhập </th>
                                        <th>Giá Bán</th>
                                        <th>Mô Tả Sản Phẩm</th>
                                        <th>Chức Năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $i++; ?>
                                        <tr>
                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['product_company_name']; ?>
                                            </td>

                                            <td>
                                                <?php echo $row['name_sp']; ?>
                                            </td>
                                            <td><img src="./upload_mau/<?php echo $row['img']; ?>" alt="<?php echo $row['name_sp']; ?>" width="150px" height="100px"></td>
                                            <td><img src="./upload_chi_tiet/<?php echo $row['img2']; ?>" alt="<?php echo $row['name_sp']; ?>" width="150px" height="100px"></td>
                                            <td>
                                                <?php echo number_format($row['price']) . '_VNĐ'; ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($row['discount']) . '_VNĐ'; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['description']; ?>
                                            </td>
                                            <td>
                                                <form method="post">

                                                    <input type="hidden" name="productId" value="<?php echo $row['product_id']; ?>">

                                                    <button type="submit" name="xoa" value="xoa" class="btn btn-primary">Delete</button>

                                                </form>
                                                <a href="./edit_product.php?product_id=<?php echo $row['product_id']; ?>&category_id=<?php echo $row['category_id3']; ?> &product_company_id2=<?php echo $row['product_company_id2']; ?> " class="btn btn-primary">Edit</a>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>