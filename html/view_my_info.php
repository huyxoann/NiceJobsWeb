<?php
require('../modules/connection.php');
$date = $_COOKIE['date'];
function split_date($date)
{
    $convertToTime = strtotime($date);
    return date('d-m-Y', $convertToTime);
}
if (isset($_POST['change'])) {
    $username = $_COOKIE['username'];
    $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $re_password = mysqli_real_escape_string($conn, $_POST['re_new_password']);
    if (!md5($old_password) === $_COOKIE['password']) {
        $notification = "Nhập mật khẩu không đúng vui lòng nhập lại!";
        header("view_my_info.php");
    } else {
        if ($new_password === $re_password) {
            if (!preg_match('/^(?=.{8,32})(((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]))).*$/', $new_password)) {
                $notification = "Mật khẩu nhập không đúng định dạng, vui lòng nhập lại";
                header("view_my_info.php");
            } else {
                $new_password = md5($new_password);
                $sql = "UPDATE users SET password = '$new_password' WHERE username = '$username'";
                if ($conn->query($sql)) {
                    $notification = "Đổi mật khẩu thành công!";
                    header('view_my_info.php');
                }
            }
        } else {
            $notification = "Mật khẩu nhập không giống nhau. Vui lòng nhập lại.";
            header("view_my_info.php");
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
    <title>Thông tin cá nhân | Nice Job</title>
    <link rel="stylesheet" href="../CSS/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/stylechung.css">
    <script src="../css/bootstrap.bundle.min.js"></script>
    <script src="../css/jquery-3.6.0.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <?php require('../includes/header.php') ?>
    <div class="container mt-3">
        <div class="info-content">
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="avatar_img text-center">
                        <?php
                        $username = $_COOKIE['id_user'];
                        $query1 = "SELECT * FROM employee WHERE id_user = '$username'";
                        $result1 = mysqli_query($conn, $query1);
                        while ($data = mysqli_fetch_assoc($result1)) {
                        ?>
                            <img style="max-width: 400px;" src="../images/users/<?php echo $data['image'] ?>" alt="user_img">
                        <?php } ?>
                    </div>
                    <div class="name">
                        <p class="text-center"><?php echo $_COOKIE['username'] ?></p>
                        <p class="text-center"><?php echo split_date($_COOKIE['date']) ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-center">Thông tin tài khoản</h2>
                    <?php
                    $query2 = "SELECT users.username, users.email, employee.fullname, employee.gender, employee.phone_number, employee.id_user FROM users INNER JOIN employee ON users.id_user=employee.id_user WHERE users.id_user = employee.id_user";
                    $result2 = mysqli_query($conn, $query2);
                    while ($data2 = mysqli_fetch_assoc($result2)) {
                    ?>

                        <table class="d-flex justify-content-center">
                            <tr>
                                <td>
                                    <p>Họ và tên: </p>
                                </td>
                                <td>
                                    <p class="form-control ms-5"><?php echo $data2['fullname'] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Email: </p>
                                </td>
                                <td>
                                    <p class="form-control ms-5"><?php echo $data2['email'] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Tên tài khoản: </p>
                                </td>
                                <td>
                                    <p class="form-control ms-5"><?php echo $data2['username'] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Mã tài khoản: </p>
                                </td>
                                <td>
                                    <p class="form-control ms-5"><?php echo $data2['id_user'] ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Giới tính: </p>
                                </td>
                                <td>
                                    <p class="form-control ms-5">
                                        <?php if ($data2['gender'] == 0) {
                                            echo "Nam";
                                        } else {
                                            echo "Nữ";
                                        } ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p>Số điện thoại: </p>
                                </td>
                                <td>
                                    <p class="form-control ms-5">
                                        <?php echo $data2['phone_number'] ?>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                        Cập nhật thông tin
                                    </button>
                                </td>
                            </tr>
                        </table>
                    <?php } ?>
                </div>
            </div>
            <hr class="dropdown-divider">
            <div class="row col-md-12">
                <form action="view_my_info.php" method="post">
                    <h3 class="">Đổi mật khẩu</h3>
                    <table class="table align-middle text-end">
                        <tr>
                            <td>
                                <label class="" for="new_password">Nhập mật khẩu cũ</label>
                            </td>
                            <td>
                                <input class="form-control" name="old_password" id=" old_password" type="password" required placeholder="Nhập mật khẩu cũ của bạn">
                            </td>
                            <td>
                                <label for="new_password">Mật khẩu mới</label>
                            </td>
                            <td>
                                <input class="form-control" name="new_password" id=" new_password" type="password" required placeholder="Hơn 8 kí tự, có 1 số + 1 chữ hoa">
                            </td>
                            <td>
                                <label for="re_new_password">Nhập lại mật khẩu</label>
                            </td>
                            <td>
                                <input class="form-control" name="re_new_password" id=" re_new_password" type="password" required placeholder="Nhập giống phần mật khẩu">
                            </td>
                            <td>
                                <button class="form-control btn btn-primary" type="submit" name="change">Xác nhận</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật thông tin người dùng</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Một vài thông tin quan trọng có thể sẽ không thể thay đổi được!</p>
                    <form action="../modules/modify_user_info.php" method="post" enctype="multipart/form-data">
                        <div class="col-md-9">
                            <h2>Thông tin tài khoản</h2>
                            <?php
                            $query2 = "SELECT users.username, users.email, employee.fullname, employee.gender, employee.phone_number, employee.id_user FROM users INNER JOIN employee ON users.id_user=employee.id_user WHERE users.id_user = employee.id_user";
                            $result2 = mysqli_query($conn, $query2);
                            while ($data2 = mysqli_fetch_assoc($result2)) {
                            ?>
                                <table>
                                    <tr>
                                        <td>
                                            <p>Họ và tên: </p>
                                        </td>
                                        <td>
                                            <!-- <p class="form-control ms-5"><?php echo $data2['fullname'] ?></p> -->
                                            <input class="form-control ms-5" type="text" name="fullname" id="fullname" value="<?php echo $data2['fullname'] ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Email: </p>
                                        </td>
                                        <td>
                                            <input class="form-control ms-5" type="text" name="email" id="email" value="<?php echo $data2['email'] ?>" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Tên tài khoản: </p>
                                        </td>
                                        <td>
                                            <input class="form-control ms-5" type="text" name="username" id="username" value="<?php echo $data2['username'] ?>" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Mã tài khoản: </p>
                                        </td>
                                        <td>
                                            <input class="form-control ms-5" type="text" name="id_user" id="id_user" value="<?php echo $data2['id_user'] ?>" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Giới tính: </p>
                                        </td>
                                        <td>

                                            <select name="gender" class="form-select ms-5" id="inputGroupSelect01" required>
                                                <option value="0" selected>Nam</option>
                                                <option value="1">Nữ</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Số điện thoại: </p>
                                        </td>
                                        <td>
                                            <input class="form-control ms-5" type="text" name="phone_number" id="phone_number" value="<?php echo $data2['phone_number'] ?>">
                                        </td>
                                    </tr>
                                </table>
                            <?php } ?>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="saveInfo" value="Lưu"></input>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php include_once('../modules/notification.php') ?>
</body>

</html>