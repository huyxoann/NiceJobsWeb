<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../modules/PHPMailer/src/Exception.php';
require '../modules/PHPMailer/src/PHPMailer.php';
require '../modules/PHPMailer/src/SMTP.php';

require('../modules/connection.php');
if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    header("location: trangchu.php");
} else {
    if (isset($_POST['signUp'])) {
        $role = 1;
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
            $notification = "Username đã trùng với một tài khoản nào đó, vui lòng nhập lại";
            header("login_sign_up_employer.php");
        } else {
            //Kiem tra password
            if (!preg_match('/^(?=.{8,32})(((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]))).*$/', $password)) {
                $notification = "Mật khẩu nhập không đúng định dạng, vui lòng nhập lại";
                header("login_sign_up_employer.php");
            } else {
                //Kiem tra email da ton tai
                $sql_checking_email = "SELECT * FROM users WHERE email = '$email' AND verify = '1'";
                $result_sql_email = mysqli_query($conn, $sql_checking_email);
                if (mysqli_num_rows($result_sql_email) > 0) {
                    $notification = "Email đã được sử dụng, vui lòng nhập email khác";
                    header("login_sign_up_employer.php");
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
                                $mail->setFrom(
                                    'hirashihiro@gmail.com',
                                    "Huy"
                                );
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
                        } else {
                            $notification = 'Đăng kí không thành công, vui lòng thử lại!';
                            header("login_sign_up_employer.php");
                        }
                    } else {
                        $notification = 'Mật khẩu đã nhập không trùng nhau, vui lòng nhập lại!';
                        header('login_sign_up_employer.php');
                    }
                }
            }
        }
    } elseif (isset($_POST['signIn'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = md5($password);

        $sql = "SELECT * FROM `users` WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) > 0) {
            if ($rows['role'] == 1) {
                setcookie("username", $username, time() + 1209600);
                setcookie("password", $password, time() + 1209600);
                header("location: trangchu.php");
            } else {
                $notification = "Không tìm thấy thông tin người dùng, vui lòng kiểm tra lại!";
                $username_typed = $username;
                header("login_sign_up_employer.php");
            }
        } else {
            $notification = "Đăng nhập không thành công, vui lòng kiểm tra lại tài khoản và mật khẩu!";
            $username_typed = $username;
            header("login_sign_up_employer.php");
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
    <title>Đăng nhập nhà tuyển dụng | NiceJob</title>
    <link rel="stylesheet" href="../css/bootstrap-5.1.3-dist/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../css/login_employer.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <br>
    <div class="row">
        <a href="../html/trangchu.php">
            <img src="../Images/logoedited-none-background.png" id="a2">
        </a>
    </div>
    <h2>Đăng nhập/Đăng kí tư cách <strong>nhà tuyển dụng</strong></h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="login_signup_employer.php" method="post">
                <h1>Sign up</h1>
                <label for="username">Tên đăng nhập</label>
                <input type="text" placeholder="Nhập username" name="username">
                <label for="password">Mật khẩu</label>
                <input type="password" placeholder="Hơn 8 kí tự, có 1 số + 1 chữ hoa" name="password">
                <label for="re_password">Nhập lại mật khẩu</label>
                <input type="password" placeholder="Giống mật khẩu" name="re_password">
                <label for="email">Email</label>
                <input type="email" placeholder="Email của bạn" name="email">
                <button type="submit" name="signUp">Đăng ký</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="login_signup_employer.php" method="post">
                <h1>Login</h1>
                <label for="username">Tên đăng nhập</label>
                <?php if (isset($username_typed)) { ?>
                    <input name="username" id=" username" type="text" required placeholder="Nhập tên đăng nhập của bạn" <?php echo 'value = "' . $username_typed . '"' ?>>
                <?php } else { ?>
                    <input name="username" id=" username" type="text" required placeholder="Nhập tên đăng nhập của bạn">
                <?php } ?>
                <!-- <input type="text" placeholder="Username" name="username"> -->
                <label for="password">Mật khẩu</label>
                <input type="password" placeholder="Mật khẩu của bạn" name="password">
                <a href="../html/quen_mat_khau.php">Quên mật khẩu?</a>
                <button type="submit" name="signIn">Đăng nhập</button>
                <p>Hoặc đăng nhập với tư cách người tìm việc? <a href="../html/login_signup_employee.php">Đăng nhập</a></p>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Chào mừng với NiceJob!</h1>
                    <p>Nếu bạn đã có tài khoản, nhấn nút bên dưới để đăng nhập nhé!</p>
                    <button class="ghost" id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Chào mừng với NiceJob!</h1>
                    <p>Bạn là nhà tuyển dụng mới? Đăng ký tài khoản mới để tìm nhân viên cho công ty bạn nhé!</p>
                    <button class="ghost" id="signUp">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });
    </script>
    <?php if (isset($notification)) { ?>
        <div class="toast-container ">
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="../images/Basic_red_dot.png" class="rounded me-2" alt="..." style="width: 20px;">
                    <strong class="me-auto">NiceJob thông báo!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <div class="alert alert-danger" role="alert">
                        <?php echo $notification ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>



</body>

</html>