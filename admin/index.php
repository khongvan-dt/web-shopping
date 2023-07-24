<?php
session_start();
require '../db/db.php';

$errors = [];
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (empty($username)) {
        $errors['username'] = 'Tên đăng nhập không được bỏ trống.';
    }
    if (empty($_POST['password'])) {
        $errors['password'] = 'Mật khẩu không được bỏ trống.';
    }
    // mysqli_select_db($conn, "shopping");

    if (empty($errors)) {

        $sql = "SELECT *FROM users_admin ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $res = mysqli_fetch_assoc($result);
            if ($password === $res['password']) {
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $res['id'];
                $_SESSION['users_name']=$res['users_name'];
                header('Location: more_product.php');

            } else {
                $errors['login'] = 'Sai tên đăng nhập hoặc mật khẩu.';
            }
        } else {
            $errors['login2'] = 'Invalid username.';
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
    <title>Login Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputEmail" type="text" name="username" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.html">Forgot Password?</a>
                                            <button type="submit" name="submit" value="login" class="btn btn-primary">login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div>
            <?php if (isset($errors['login'])) {
                echo $errors['login'];
            } ?>
            <?php if (isset($errors['login2'])) {
                echo $errors['login2'];
            } ?>
            <?php if (isset($errors['password'])) {
                echo $errors['password'];
            } ?>
            <?php if (isset($errors['username'])) {
                echo $errors['username'];
            } ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>