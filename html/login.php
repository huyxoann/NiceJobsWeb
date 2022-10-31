<?php
require('connection.php');
if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    header("location:trangchu.php");
} else {
    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($password);

        $sql = "SELECT * FROM `users` WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            setcookie("username", $username, time() + 1209600);
            setcookie("password", $password, time() + 1209600);
            header("location: trangchu.php");
        } else {
            header("login.php?error=Đăng nhập không thành công");
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
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../css/dangnhap.css" type="text/css">
    <link rel="stylesheet" href="../css/bootstrap-5.1.3-dist/css/bootstrap.css" type="text/css">
</head>

<body>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        function checkInput() {
            var a = document.getElementById('username').value;
            var b = document.getElementById('password').value;
            var c = document.getElementById('error');
            if (a == "" || b == "") {
                c.innerHTML = "Vui lòng nhập tên đăng nhập và mật khẩu";
            }
        }
    </script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <a href="file:///D:/DoAnCoSo/HTML/trangChu.html">
                    <img src="../Images/logoedited-none-background.png" alt="">
                </a>
                <form action="login.php" method="post">
                    <h2 id="dn" style="padding-top: 25px;">Đăng nhập</h2>
                    <?php if (isset($_GET['error'])) { ?>
                        <p id="error" style="color: red;"><?php echo $_GET['error'] ?></p>
                    <?php } ?>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label>Tên đăng nhập </label>
                                <input name="username" id=" username" type="text" required class="form-control" placeholder="Nhập tên đăng nhập của bạn">
                            </div>

                            <div class=" col">
                                <label>Mật khẩu</label>
                                <input name="password" id="password" type="password" required class="form-control" placeholder="Nhập mật khẩu của bạn">
                            </div>
                        </div>
                    </div>
                    <div id="button">
                        <div class="form-group nut">
                            <button onclick="checkInput()" class="btn btn-success btn-lg" type="submit" id="btnDN" name="login">Đăng nhập</button>
                        </div>
                        <p> Hoặc đăng nhập bằng tài khoản</p>
                        <div class="col-ms-3">
                            <div class="form-group nut">
                                <button class="btn btn-outline-danger btn-lg" type="button">Google</button>
                            </div>
                        </div>
                        <div class="col-ms-3">
                            <div class="form-group nut">
                                <button class="btn btn-outline-primary fb btn-lg" type="button">Facebook</button>
                            </div>
                        </div>

                        <p>Nếu bạn chưa có tài khoản?</p>
                        <a style="text-decoration: none;" href="file:///D:/DoAnCoSo/HTML/sign-up.html">
                            <p>Đăng ký ngay</p>
                        </a>
                        <a href="file:///D:/DoAnCoSo/HTML/forget-password.html" style="text-decoration: none;">
                            <p>Quên mật khẩu</p>
                        </a>
                    </div>



                    <div class="row">

                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <img src="../Images/cv.png" id="a1">
            </div>
        </div>
    </div>
</body>

</html>