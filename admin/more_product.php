<?php
session_start();
if (empty($_SESSION['loggedin'])) {
    header('location:index.php');
    exit();
} else {
    require '../db/db.php';
    require '../db/thong_tin.php';
    $errors = [];
        if (isset($_POST['submit'])) {
        $Category = $_POST['Category'];
        if (empty($Category)) {
            $errors['nhap'] = "nhập đủ";
        }
        $sql2 = "SELECT COUNT(*) AS sum FROM categories WHERE category_name='$Category'";
        $result2 = $conn->query($sql2);
        $row = mysqli_fetch_assoc($result2);

        if ($row['sum'] > 0) {
            $errors['sum'] = "Loại sản phẩm đã tồn tại, vui lòng nhập loại khác!";
        }
        if (empty($errors)) {
            $insert_Category = "INSERT INTO categories(category_name) VALUES (?)";
            $stmt = mysqli_prepare($conn, $insert_Category);
            mysqli_stmt_bind_param($stmt, "s", $Category);
            mysqli_stmt_execute($stmt);
            $errors['ok'] = "thêm sp thành công " . $Category;
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
        <a class="navbar-brand ps-3" href="index.html"><?php echo $user;?></a>
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
                    <h1 class="mt-4">Thêm các loại sản phẩm</h1>


                    <div class="card mb-4">

                        <div class="card-body">
                            <form action="" method="post">
                                <table>
                                    <thead>
                                        <tr>
                                            <th> Nhập</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" id='Category' name='Category'>
                                            </td>
                                            <td>
                                                <input type="submit" name="submit" value="Submit" class="form-control">

                                            </td>
                                            <td>
                                                <?php
                                                if (isset($errors['nhap'])) {
                                                    echo $errors['nhap'];
                                                }
                                                if (isset($errors['sum'])) {
                                                    echo $errors['sum'];
                                                }
                                                if (isset($errors['ok'])) {
                                                    echo $errors['ok'];
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                            </form>

                            <div style="display: flex; flex-wrap: wrap;">
                                <?php
                                $sql = "SELECT * FROM categories";
                                $result = $conn->query($sql);
                                while ($list = $result->fetch_assoc()) { ?>
                                    <div style="margin: 10px; padding: 10px; border: 1px solid #ebebeb;">
                                        <?php echo $list['category_name'] ?>
                                        <a href="./edit.php?category_id=<?php echo $list['category_id']; ?>" class="btn btn-primary">Edit</a>
                                    </div>
                                <?php } ?>
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