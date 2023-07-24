<?php

session_start();
if (empty($_SESSION['loggedin'])) {
    header('location:index.php');
    exit();
} else {
    require '../db/db.php';
    require '../db/thong_tin.php';
    $errors = [];
    $detail = $_GET['detail'];
    mysqli_select_db($conn, "shopping");
    $sql = " SELECT *FROM product_company WHERE category_id2 =$detail";
    $result = $conn->query($sql);
    $lst = $result->fetch_assoc();
    if (isset($_POST['submit'])) {
        $option = $_POST['option'];
        $category_id3 = $lst['category_id2'];
        // $product_company_id2 = $lst['product_company_id'];
        $name_sp = $_POST['name_sp'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $description = $_POST['description'];
        $img = $_FILES['img']['name'];
        $img2 = $_FILES['img2']['name'];
        if (empty($option)) {
            $errors['loi1'] = 'nhập đủ chọn';
        }
        if (empty($name_sp)) {
            $errors['loi2'] = 'nhập đủ tên';
        }
        if (empty($price)) {
            $errors['loi3'] = 'nhập đủ giá';
        }
        if (empty($discount)) {
            $errors['loi4'] = 'nhập đủ giá nhập';
        }
        if (empty($description)) {
            $errors['loi5'] = 'nhập đủ mô tả';
        }
        if (empty($img)) {
            $errors['loi6'] = 'nhập đủ ảnh';
        }
        if (empty($img2)) {
            $errors['loi7'] = 'nhập đủ ảnh chi tiết';
        }
        if (empty($errors)) {
            $target_dir = "upload_mau/"; // thư mục để lưu trữ tạm thời ảnh
            $target_dir2 = "upload_chi_tiet/"; // thư mục để lưu trữ tạm thời ảnh


            //tạo đường dẫn file upload lên hệ thống 
            $target_file = $target_dir . basename($_FILES["img"]["name"]);
            $target_file2 = $target_dir2 . basename($_FILES["img2"]["name"][0]);



            //kiem tra loại file 
            $type_file = pathinfo($_FILES["img"]["name"], PATHINFO_EXTENSION);
            $type_file2 = pathinfo($_FILES["img2"]["name"][0], PATHINFO_EXTENSION);

            $type_file_allow = array('jpg', 'gif', 'jpeg', 'png', 'img', 'webp');
            if (!in_array(strtolower($type_file), $type_file_allow)) {
                $errors[] = 'ảnh mẫu định dạng không hợp lệ</br>';
            }
            if (!in_array(strtolower($type_file2), $type_file_allow)) {
                $errors[] = 'ảnh chi tiết định dạng không hợp lệ</br>';
            }

            //kiểm tra nếu không lỗi thì sẽ chuyển file từ bộ nhớ tạm lên server
            if (empty($errors)) {
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    $thanhcong['img_mau'] = 'Upload ảnh mẫu thành công</br>';
                } else {
                    $errors['img_mau'] = 'Upload ảnh mẫu thất bại</br>';
                }
            }


            if ($errors) {
                print_r($errors);
                exit;
            }
            // echo '<pre>';
            // print_r($_FILES);
            // die();
            if (empty($errors)) {

                $sql = "SELECT * FROM Products";
                $result4 = $conn->query($sql);
                $row4 = $result4->fetch_assoc();

                $insert_product = "INSERT INTO products (category_id3,product_company_id2,name_sp, price, discount, img, description )
                VALUES ('$category_id3', $option,' $name_sp', '$price', '$discount','$img' ,'$description')";
                $result = $conn->query($insert_product);

                if ($result) {
                    $product_id = mysqli_insert_id($conn);
                    if (empty($errors)) {
                        foreach ($_FILES["img2"]["name"] as $key => $name) {
                            if (move_uploaded_file($_FILES["img2"]["tmp_name"][$key], $target_file2)) {
                                $insert_Galery = "INSERT INTO Galery (product_id2, img2) VALUES ('$product_id', '$target_file2')";
                                if ($conn->query($insert_Galery)) {
                                    $thanhcong['insert_product'] = "thêm sản phẩm thành công ";
                                } else {
                                    $errors['img'] = "Lỗi thêm ảnh chi tiết sản phẩm: " . $conn->error;
                                }
                            } else {
                                $errors['img'] = "Lỗi upload ảnh chi tiết sản phẩm";
                            }
                        }
                    }
                } else {
                    $errors['sp'] = "Error inserting product: " . $conn->error;
                }
            }
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
    <title>Table</title>
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
                    <h1 class="mt-4">Thêm Sản Phẩm</h1>
                    <div class="card mb-4">
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <select class="form-select " name="option" aria-label="Default select example">
                                    <option selected>Chọn Hãng</option>
                                    <?php $sql2 = " SELECT *FROM product_company WHERE category_id2 =$detail";
                                    $result2 = $conn->query($sql2);
                                    while ($row = mysqli_fetch_assoc($result2)) {
                                        echo " <option value='{$row['product_company_id']}'>{$row['product_company_name']}</option> ";
                                    } ?>
                                    <?php if (isset($errors['loi1'])) {
                                        echo $errors['loi1'];
                                    } ?>
                                </select>
                                <table>
                                    <tr>
                                        <td>Nhập tên sản phẩm:</td>
                                        <td><input type="text" name="name_sp" id="name_sp" class="form-control"></td>
                                        <td><?php if (isset($errors['loi2'])) {
                                                echo $errors['loi2'];
                                            } ?></td>

                                    </tr>
                                    <tr>
                                        <td>Nhập giá bán:</td>
                                        <td><input type="text" name="price" id="price" class="form-control"></td>
                                        <td><?php if (isset($errors['loi3'])) {
                                                echo $errors['loi3'];
                                            } ?></td>

                                    </tr>
                                    <tr>
                                        <td>Nhập giá nhập vào:</td>
                                        <td><input type="text" name="discount" id="discount" class="form-control"></td>
                                        <td><?php if (isset($errors['loi4'])) {
                                                echo $errors['loi4'];
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td>Ảnh mẫu:</td>
                                        <td><input type="file" name="img" id="img" class="form-control"></td>
                                        <td><?php if (isset($errors['loi6'])) {
                                                echo $errors['loi6'];
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td>----------------</td>
                                    </tr>
                                    <tr>
                                        <td>Ảnh chi tiết:</td>
                                        <td>
                                            <input type="file" name="img2[]" class="form-control" multiple="multiple">
                                        </td>

                                        <td>
                                            <?php if (isset($errors['loi7'])) {
                                                echo $errors['loi6'];
                                            } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>----------------</td>
                                    </tr>
                                    <tr>
                                        <td>Mô tả Sản phẩm:</td>
                                        <td>
                                            <textarea name="description" id="description" class="form-control" rows="5" cols="60"></textarea>
                                        </td>
                                        <td><?php if (isset($errors['loi5'])) {
                                                echo $errors['loi5'];
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" name="submit" value="Submit" class="btn btn-primary"></td>
                                    </tr>
                                </table>
                                <?php if (isset($thanhcong['insert_product'])) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $thanhcong['insert_product']; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($errors)) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php foreach ($errors as $error) {
                                            echo $error . "<br>";
                                        } ?>
                                    </div>
                                <?php endif; ?>


                            </div>
                        </form>

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