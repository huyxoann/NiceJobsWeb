<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../modules/PHPMailer/src/Exception.php';
require '../modules/PHPMailer/src/PHPMailer.php';
require '../modules/PHPMailer/src/SMTP.php';

require('../modules/connection.php');
if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    header("location:trangchu.php");
} else {
    if (isset($_POST['register'])) {
        $role = 0;
        $user_id = '';
        $is_exist_user = true;
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $re_password = mysqli_real_escape_string($conn, $_POST['re_password']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $verify_code = rand(100000, 999999);
        //check if username already registered
        $sql = "SELECT `username` FROM `users` WHERE `username` = '$username' ";
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            $username_exist_mes = "Username đã trùng với một tài khoản nào đó, vui lòng nhập lại";
            header("sign_up.php");
        } else {
            //Kiem tra password
            if (!preg_match('/^(?=.{8,32})(((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]))).*$/', $password)) {
                $password_wrong_format_mes = "Mật khẩu nhập không đúng định dạng, vui lòng nhập lại";
                header("sigh_up.php");
            } else {
                //Kiem tra email da ton tai
                $sql_checking_email = "SELECT * FROM users WHERE email = '$email' AND verify = '1'";
                $result_sql_email = mysqli_query($conn, $sql_checking_email);
                if (mysqli_num_rows($result_sql_email) > 0) {
                    $email_used_mes = "Email đã được sử dụng, vui lòng nhập email khác";
                    header("sigh_up.php");
                } else {
                    //Tao id user
                    while ($is_exist_user) {
                        $user_id = user_id_generator($role);
                        $sql_check_id_user = "SELECT * FROM users WHERE id_user = '$user_id'";
                        $result_sql_id = mysqli_query($conn, $sql_check_id_user);
                        if (mysqli_num_rows($result_sql_id) > 0) {
                            $is_exist_user = true;
                        } else {
                            $is_exist_user = false;
                        }
                    }
                    //check $pass == $cpass
                    if ($password == $re_password) {
                        $password = md5($password);
                        $sql = "INSERT INTO users (id_user, username, password, email, role, verify_code) VALUES('$user_id', '$username', '$password','$email', '$role', '$verify_code')";
                        if ($conn->query($sql) === TRUE) {
                            // header("Location: request_active.php");
                        } else {
                            $sign_up_unsuccess_mes = 'Đăng kí không thành công, vui lòng thử lại!';
                            header("sign_up.php");
                        }
                    } else {
                        $password_wrong_mes = 'Mật khẩu đã nhập không trùng nhau, vui lòng nhập lại!';
                        header('sign_up.php');
                    }
                    $mail = new PHPMailer(true);
                    try {
                        $mail->SMTPDebug = 0;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'hirashihiro@gmail.com';                     //SMTP username
                        $mail->Password   = 'gduaovijcmpjpaem';                               //SMTP password
                        $mail->SMTPSecure = 'tsl';            //Enable implicit TLS encryption
                        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                        $mail->charSet = "UTF-8";
                        //Recipients
                        $mail->setFrom('hirashihiro@gmail.com', "Huy");
                        $mail->addAddress($email, $username);     //Add a recipient
                        // $mail->addAddress('ellen@example.com');               //Name is optional
                        $mail->addReplyTo('hirashihiro@gmail.com', "Huy");
                        // $mail->addCC('cc@example.com');
                        // $mail->addBCC('bcc@example.com');

                        //Attachments
                        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                        //Content
                        $content = 'Kính gửi, ' . $username . '<br>Tài khoản email của bạn đã được đăng kí tại NiceJob, đây là mật mã xác nhận của bạn. Vui lòng nhập để hoàn tất việc đăng kí.
                        <br>Code của bạn là:
                        <div class="alert alert-danger" role="alert">
                        ' . $verify_code . '    
                        </div>';
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = "Mã OTP xác nhận tài khoản | NiceJob";
                        $mail->Body    = $content;
                        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        $mail->send();
                        ob_start();
                        setcookie('username_temp', $username, time() + 999999);
                        header("location: request_active.php?username=" . $username);
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
            }
        }
    }
}
function user_id_generator($role)
{
    if ($role == 0) {
        return 'NV' . rand(100000, 999999);
    } else {
        return 'TD' . rand(100000, 999999);
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
    <link rel="stylesheet" href="../CSS/bootstrap-5.1.3-dist/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../CSS/dangki.css">
</head>

<body>
    <script language="javascript" src="../js/check_streang_password.js"></script>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <a href="file:///D:/DoAnCoSo/HTML/trangChu.html">
                    <img src="../Images/logoedited-none-background.png" id="a2">
                </a>
                <form action="sign_up.php" method="post" name="form">
                    <h2 style="text-align: center; margin: 0 auto;padding-top: 15px;" id="dn">Đăng Ký</h2>
                    <div class="form-group">
                        <div><span id="error4" class="error"></span></div>
                        <label>Username *</label>
                        <input required id="username" name="username" type="text" class="form-control" placeholder="Username của bạn">
                        <span class="show-btn"><i class="fas fa-eye"></i></span>
                        <span id="username_mess"></span>
                    </div>
                    <?php if (isset($username_exist_mes)) { ?>
                        <div class="alert alert-danger" role="alert" id="alert" style="text-align: center;">
                            <p id="notification" style="text-align: left;"><?php echo $username_exist_mes ?></p>
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <div><span id="error4" class="error"></span></div>
                        <label>Password *</label>
                        <input required id="password" name="password" type="password" class="form-control tt" placeholder="Password của bạn">
                        <span class="show-btn"><i class="fas fa-eye"></i></span>
                        <span id="strength"></span>
                    </div>
                    <?php if (isset($password_wrong_format_mes)) { ?>
                        <div class="alert alert-danger" role="alert" id="alert" style="text-align: center;">
                            <p id="notification" style="text-align: left;"><?php echo $password_wrong_format_mes ?></p>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <div><span id="error4" class="error"></span></div>
                        <label>Re-Password *</label>
                        <input required id="re_password" name="re_password" type="password" class="form-control" placeholder="Nhập lại Password">
                        <span class="show-btn"><i class="fas fa-eye"></i></span>
                        <span id="re_pass_mess"></span>
                    </div>
                    <?php if (isset($password_wrong_mes)) { ?>
                        <div class="alert alert-danger" role="alert" id="alert" style="text-align: center;">
                            <p id="notification" style="text-align: left;"><?php echo $password_wrong_mes ?></p>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <div><span id="error3" class="error"></span></div>
                        <label>Email *</label>
                        <input required id="email" name="email" type="email" class="form-control" placeholder="Email của bạn">
                        <span id="email_mess"></span>
                    </div>
                    <?php if (isset($email_used_mes)) { ?>
                        <div class="alert alert-danger" role="alert" id="alert" style="text-align: center;">
                            <p id="notification" style="text-align: left;"><?php echo $email_used_mes ?></p>
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <input type="checkbox" required>
                        <label><br> Tôi đồng ý điều khoản sử dụng </label>
                    </div>

                    <div class="form-group" style="">
                        <button name="register" class="btn btn-success btn-lg" type="submit" style="background-color: #2A5DDE;" id="btnDN">Đăng ký ngay</button>
                    </div>

                </form>
            </div>

            <div class="col-md-6" id="khung_anh">
                <img src="../Images/cv.png" id="a1">
            </div>
        </div>

    </div>
</body>

</html>