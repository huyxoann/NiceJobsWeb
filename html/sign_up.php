<?php
include 'connection.php';
if(isset($_POST['register']))
{
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,$_POST['password']) ;
    $re_password = mysqli_real_escape_string($conn,$_POST['re_password']);
    $email =mysqli_real_escape_string($conn,$_POST['email']) ;
    // $passs = md5($pass);

    //check if username already registered
    $sql = "SELECT `username`FROM `users` WHERE `username` = '$username' ";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        //$_SESSION['message'] = "Username already Registered";
        echo 'Username đã tồn tại ';
        header("Location:sign_up.php");
    } else {
        //check $pass == $cpass
        if ($password == $re_password) {
           $sql = "INSERT INTO `users`(  `username`, `password`,  `phone`, `email`)
                                 VALUES ('$username','$password','$email')";
            $query = mysqli_query($conn, $sql);

            if ($query) {
                // $_SESSION['message'] = "Registered Successfully";
                echo 'dang ki thanh cong';
                header("Location:trangchu.php");
            } else {
                // $_SESSION['message'] = "Registered Failed";
                echo 'Dang ki that bai';
                header("Location:sign_up.php");
            }
        } else {
            // $_SESSION['message'] = "Passwords do not match";
            echo 'mat khau khong khop !';
            header('Location:sign_up.php');
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
    <title>Đăng ký</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="../CSS/bootstrap-5.1.3-dist/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../CSS/stylechung.css">
    <link rel="stylesheet" href="../CSS/dangki.css">
</head>

<body>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        function checkInput() {
            var a = document.getElementById('firstName').value;
            var b = document.getElementById('lastName').value;
            var c = document.getElementById('email').value;
            var d = document.getElementById('password').value;

            var e1 = document.getElementById('error1');
            var e2 = document.getElementById('error2');
            var e3 = document.getElementById('error3');
            var e4 = document.getElementById('error4');
            
            
            if (a == "") {
                e1.innerHTML = "*Vui lòng nhập Tên";
            }
            if (b == "") {
                e2.innerHTML = "*Vui lòng nhập Họ";
            }
            if (c == "") {
                e3.innerHTML = "*Vui lòng nhập Email";
            }
            if (d == "") {
                e4.innerHTML = "*Vui lòng nhập Mật khẩu";
            }
        }
    </script>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="file:///D:/DoAnCoSo/HTML/trangChu.html">
                    <img src="../Images/logoedited-none-background.png" id="a2">
                </a>
                <form  method="post">
                    <h2 style="text-align: center;margin: 0 auto;padding-top: 15px;" id="dn">Đăng Ký</h2>
                    
                 
                    <div class="form-group">
                        <div><span id="error4" class="error"></span></div>
                        <label>Username </label>
                        <input id="username"name="username" type="text" required class="form-control" placeholder="Username của bạn">
                        <span class="show-btn"><i class="fas fa-eye"></i></span>
                    </div>

                    <div class="form-group">
                        <div><span id="error4" class="error"></span></div>
                        <label>Password *</label>
                        <input id="password" name="password" type="password" required class="form-control" placeholder="Password của bạn">
                        <span class="show-btn"><i class="fas fa-eye"></i></span>
                    </div>

                    <div class="form-group">
                        <div><span id="error4" class="error"></span></div>
                        <label>Re-Password *</label>
                        <input id="password" name="re_password" type="password" required class="form-control" placeholder="Nhập lại Password">
                        <span class="show-btn"><i class="fas fa-eye"></i></span>
                    </div>

                    <div class="form-group">
                        <div><span id="error3" class="error"></span></div>
                        <label>Email *</label>
                        <input id="email" name="email" type="email" required class="form-control" placeholder="Email của bạn">

                    </div>

                    <div class="form-group">
                        <input type="checkbox" required>
                        <label><br> Tôi đồng ý điều khoản sử dụng </label>
                    </div>

                    <div class="form-group">
                        <button onclick="checkInput()" name="register" class="btn btn-success btn-lg  " type="submit" style="margin-left: 200px; margin-top: 25px; background-color: #2A5DDE;" id="btnDN">Đăng ký ngay</button>
                    </div>

                </form>
            </div>

            <div class="col-md-6">
                <img src="../Images/cv.png" id="a1">
            </div>
        </div>

    </div>
    </div>
</body>

</html>