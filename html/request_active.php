<?php
require('../html/modules/connection.php');

if (isset($_POST['validate']) && $_POST['validate']) {
    $validate_code = '' . $_POST['first'] . $_POST['second'] . $_POST['third'] . $_POST['fourth'] . $_POST['fifth'] . $_POST['sixth'];
    $username_validate = $_COOKIE['username_temp'];
    $sql = "SELECT * FROM users WHERE username = '$username_validate'";
    $result = mysqli_query($conn, $sql);
    $rows = "";
    while ($rows = mysqli_fetch_assoc($result)) {
        if ($validate_code == $rows['verify_code']) {
            $sql_update = "UPDATE users SET verify = '1' WHERE username = '$username_validate'";

            if ($conn->query($sql_update)) {
                if ($rows['role'] == 0) {
                    header('Location: login_signup_employee.php');
                } elseif ($rows['role'] == 1) {
                    header('Location: login_signup_employer.php');
                }
            } else {
                $wrong_code = "Nhập sai mã xác thực";
                header('request_active.php?username=' . $username_validate);
            }
        } else {
            $wrong_code = "Nhập sai mã xác thực";
            header('request_active.php' . $username_validate);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>NiceJob | Request active account</title>
    <link rel="stylesheet" href="../css/stylechung.css">
    <link rel="stylesheet" href="../css/request_active.css">
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {

            function OTPInput() {
                const inputs = document.querySelectorAll('#otp > *[id]');
                for (let i = 0; i < inputs.length; i++) {
                    inputs[i].addEventListener('keydown', function(event) {
                        if (event.key === "Backspace") {
                            inputs[i].value = '';
                            if (i !== 0) inputs[i - 1].focus();
                        } else {
                            if (i === inputs.length - 1 && inputs[i].value !== '') {
                                return true;
                            } else if (event.keyCode > 47 && event.keyCode < 58) {
                                inputs[i].value = event.key;
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            } else if (event.keyCode > 64 && event.keyCode < 91) {
                                inputs[i].value = String.fromCharCode(event.keyCode);
                                if (i !== inputs.length - 1) inputs[i + 1].focus();
                                event.preventDefault();
                            }
                        }
                    });
                }
            }
            OTPInput();
        });
    </script>
</head>

<body>
    <?php require_once('../includes/header_active.php') ?>
    <div class="web_content container">
        <div class="container height-100 d-flex justify-content-center align-items-center">
            <div class="position-relative">
                <form action="request_active.php" method="post">
                    <div class="card p-2 text-center">
                        <h6>Kiểm tra email và nhập mật khẩu một lần để xác minh tài khoản của bạn</h6>
                        <div> <span>Code đã được gửi đến địa chỉ email </span> <small></small> </div>
                        <?php if (isset($wrong_code)) { ?>
                            <div class="alert alert-danger" role="alert" id="alert" style="text-align: center;">
                                <p id="notification" style="text-align: left;"><?php echo $wrong_code ?></p>
                            </div>
                        <?php } ?>
                        <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                            <input class="m-2 text-center form-control rounded" type="text" id="first" name="first" maxlength="1" />
                            <input class="m-2 text-center form-control rounded" type="text" id="second" name="second" maxlength="1" />
                            <input class="m-2 text-center form-control rounded" type="text" id="third" name="third" maxlength="1" />
                            <input class="m-2 text-center form-control rounded" type="text" id="fourth" name="fourth" maxlength="1" />
                            <input class="m-2 text-center form-control rounded" type="text" id="fifth" name="fifth" maxlength="1" />
                            <input class="m-2 text-center form-control rounded" type="text" id="sixth" name="sixth" maxlength="1" />
                        </div>
                        <div class="mt-4">
                            <!-- <button class="btn btn-danger px-4 validate" type="submit" name="validate">Xác thực</button> -->
                            <input type="submit" class="btn btn-danger px-4 validate" name="validate" value="Xác thực">
                        </div>
                    </div>
                </form>
                <div class="card-2">
                    <div class="content d-flex justify-content-center align-items-center"> <span>Không nhận được mã?</span> <a href="#" class="text-decoration-none ms-3">Resend(1/3)</a> </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>