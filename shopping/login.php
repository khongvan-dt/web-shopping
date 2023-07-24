<?php
session_start();
require '../db/db.php';
mysqli_select_db($conn, "shopping");
$errors = [];
try {

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = sha1($_POST['password']);

        if (empty($username)) {
            $errors['username'] = "Username cannot be left blank.<br>";
        }
        if (empty($password)) {
            $errors['password'] = "Password cannot be left blank.<br>";
        }
        if (empty($errors)) {
            $sql = "SELECT * FROM Users WHERE users_name = '$username'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $res = mysqli_fetch_assoc($result);
                if ($password === $res['password']) {
                    $_SESSION['login'] = true;
                    $_SESSION['login'] = [
                        'User_id' => $res['id'], // User ID from the database
                        'username' => $res['users_name'], // User's username
                        'email' => $res['email']
                    ];
                    
                   

                    header('Location: index.php');
                } else {
                    $errors['password2'] = "wrong account password";
                }
            } else {
                $errors['username2'] = "wrong account name";
            }
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register2.css">
    <title>Login</title>
</head>

<body>

    <div class="container">
        <form method="POST">
            <div class="container">

                <div class=header>
                    <h2>FORM LOGIN</h2>

                </div>
                <table>
                    <tr>
                        <th><label for="Username"><b>Username</b></label></th>
                        <th>
                            <input type="text" placeholder="Enter Username" name="username">
                            <?php if (!empty($errors['username'])) { ?>
                                <div class="error"><?php echo $errors['username']; ?></div>
                            <?php } ?>
                            <?php if (!empty($errors['username2'])) { ?>
                                <div class="error"><?php echo $errors['username2']; ?></div>
                            <?php } ?>
                        </th>
                    </tr>



                    <tr>
                        <th>
                            <label for="psw"><b>Password</b></label>
                        </th>
                        <th>
                            <input type="password" placeholder="Enter Password" name="password" required>

                            <?php if (!empty($errors['password'])) { ?>
                                <div class="error"><?php echo $errors['password']; ?></div>
                            <?php } ?>
                            <?php if (!empty($errors['password2'])) { ?>
                                <div class="error"><?php echo $errors['password2']; ?></div>
                            <?php } ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <p><button type="submit" name="submit">LOGIN</button></p>
                        </th>
                    </tr>

                </table>
            </div>
        </form>
       
    </div>
</body>

</html>