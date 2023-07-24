<?php
session_start();
if (empty($_SESSION['loggedin'])) {
    header('location:index.php');
    exit();
} else {
    require '../db/db.php';
    $errors = [];
    $product_company_id = $_GET['product_company_id'];



    if (isset($_POST['save'])) {
        $edit_company = $_POST['edit_company'];
        $Update = "UPDATE product_company SET product_company_name = ? WHERE product_company_id = ?";
        $stmt = mysqli_prepare($conn, $Update);
        mysqli_stmt_bind_param($stmt, "si", $edit_company, $product_company_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    if(alert('Sửa thành công. Bạn có muốn quay lại trang danh mục không?')){
                        header('Location:product_company.php');
                    }
                  </script>";
        } else {
            $errors[] = "Lỗi cập nhật tên danh mục";
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
    <title>Thêm các loại sản phẩm</title>
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
                    <div class="card mb-4">
                        <form action="" method="post">

                            <div class="card-body">
                                <table style="width: 100%;">
                                    <?php $sql = "SELECT * FROM product_company WHERE product_company_id ='$product_company_id' ";
                                    $result = $conn->query($sql);
                                    $row = mysqli_fetch_assoc($result); ?>
                                    <tr>
                                        <th>
                                            <h3>Sửa Hãng Sản Phẩm</h3>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Tên Loại SP : <input type="text" name="edit_company" value="<?php echo $row['product_company_name']; ?>"></th>

                                    </tr>
                                    <tr>
                                        <th>
                                            Chức năng :<button class="btn btn-primary" type="submit" name="save">Save</button>
                                        </th>
                                    </tr>
                                </table>


                            </div>
                        </form>
                    </div>
                </div>
            </main>
            </main>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>