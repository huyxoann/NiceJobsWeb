<?php
require('../html/modules/connection.php');
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    header("Location: trangchu.php");
} else {
    if (isset($_POST['submit'])) {
        $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
        $re_password = mysqli_real_escape_string($conn, $_POST['re_new_password']);
        $username = $_COOKIE['username_temp'];
        if ($new_password === $re_password) {
            if (!preg_match('/^(?=.{8,32})(((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]))).*$/', $new_password)) {
                $notification = "Mật khẩu nhập không đúng định dạng, vui lòng nhập lại";
                header("change_password.php");
            } else {
                $new_password = md5($new_password);
                $sql = "UPDATE users SET password = '$new_password' WHERE username = '$username'";
                if ($conn->query($sql)) {
                    $password_changed = true;
                    setcookie('username_temp', '', time() - 3600);
                    header('change_password.php');
                }
            }
        } else {
            $notification = "Mật khẩu nhập không giống nhau. Vui lòng nhập lại.";
            header("change_password.php");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap-5.1.3-dist/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../css/forget_password.css">
    <link rel="icon" href="../images/logo nicejob.png">

    <title></title>
</head>

<body>
    <div class="row">
        <a href="../html/trangchu.php">
            <img src="../Images/logoedited-none-background.png" id="a2">
        </a>
    </div>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="change_password.php" method="post">
                <?php if (isset($password_changed)) { ?>
                    <h2>Đã thay đổi mật khẩu thành công!</h2>
                    <p style="font-size: 20px;">Bấm vào <a href="login_signup_employee.php" style="text-decoration: underline; font-size: 20px; color: #2A5DDE">đây</a> để đăng nhập</p>
                <?php } else { ?>
                    <h2>Thay đổi mật khẩu</h2>
                    <label for="new_password">Mật khẩu mới</label>
                    <input name="new_password" id=" new_password" type="password" required placeholder="Hơn 8 kí tự, có 1 số + 1 chữ hoa">
                    <label for="re_new_password">Nhập lại mật khẩu</label>
                    <input name="re_new_password" id=" re_new_password" type="password" required placeholder="Nhập giống phần mật khẩu">
                    <button type="submit" name="submit">Xác nhận</button>
                <?php } ?>
            </form>
        </div>
    </div>
    <?php include('../html/modules/notification.php') ?>
</body>

</html>