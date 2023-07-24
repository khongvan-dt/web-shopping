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

    $product_company_id = $_GET['category_id'];
    $sql = "SELECT * FROM categories WHERE category_id=$product_company_id";
    $result = $conn->query($sql);
    $list = $result->fetch_assoc();
    if (isset($_POST['save'])) {
        $name_hang = $_POST['name_hang'];
        $insert = "INSERT INTO product_company (product_company_name, category_id2) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $insert);
        mysqli_stmt_bind_param($stmt, "si", $name_hang, $list['category_id']);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Thêm thành công');</script>";
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
    <title>Nhập hãng</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html"><?php echo $user; ?></a>
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
                  
                    <h2 class="mt-4">Nhập hãng: <?php echo $list['category_name'] ?></h2>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div">
                                <form action="" method="post">

                                    <div class="card-body">
                                        <table style="width: 100%;">

                                            <tr>
                                                <th>Nhập : <input type="text" name="name_hang"></th>

                                            </tr>
                                            <tr>
                                                <th>
                                                    Chức năng :<button class="btn btn-primary" type="submit" name="save">Save</button>
                                                </th>
                                            </tr>
                                        </table>


                                    </div>
                                </form>

                                <div style="display: flex; flex-wrap: wrap;">
                                    <?php
                                    $sql2 = "SELECT * FROM product_company WHERE category_id2 = $product_company_id ";
                                    $result2 = $conn->query($sql2);
                                    while ($list2 = $result2->fetch_assoc()) { ?>
                                        <div style="margin: 10px; padding: 10px; border: 1px solid #ebebeb;">

                                            <a href="./edit_company.php?product_company_id=<?php echo $list2['product_company_id']; ?>" class="btn btn-primary"> <?php echo $list2['product_company_name'] ?></a>
                                        </div>
                                    <?php } ?>
                                </div>


                        </div>
                    </div>

                </div>
        </div>
    </div>
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