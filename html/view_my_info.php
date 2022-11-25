<?php
require('./modules/connection.php');
include('./modules/notification.php');
$date = $_COOKIE['date'];
function split_date($date)
{
    $convertToTime = strtotime($date);
    return date('d-m-Y', $convertToTime);
}
if (!(isset($_COOKIE["username"]) && isset($_COOKIE["password"]))) {
    header("location: login_signup_employee.php");
} else {
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
                        if (isset($_COOKIE['role']) && $_COOKIE['role'] == 0) {
                            $query1 = "SELECT * FROM employee WHERE id_user = '$username'";
                        } else {
                            $query1 = "SELECT * FROM employer WHERE id_user = '$username'";
                        }
                        $result1 = mysqli_query($conn, $query1);
                        while ($data = mysqli_fetch_assoc($result1)) {
                        ?>
                            <img style="max-width: 200px;" src="../html/picture/users/<?php echo $data['image'] ?>" alt="user_img">
                        <?php } ?>
                    </div>
                    <div class="name">
                        <p class="text-center"><?php echo $_COOKIE['username'] ?></p>
                        <p class="text-center"><?php echo split_date($_COOKIE['date']) ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="text-center">Thông tin tài khoản</h2>
                    <!-- Dữ liệu của employee -->
                    <?php
                    if ($_COOKIE['role'] == 0) {
                        $query2 = "SELECT users.username, users.email, employee.fullname, employee.gender, employee.phone_number, employee.id_user FROM users INNER JOIN employee ON users.id_user=employee.id_user WHERE users.id_user = '$username'";
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
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeInfoUser">
                                            Cập nhật thông tin
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        <?php } ?>
                        <!-- Dữ liệu của employer -->
                        <?php } elseif ($_COOKIE['role'] == 1) {
                        $query2 = "SELECT users.username, users.email, employer.fullname, employer.gender, employer.phone_number, employer.id_user FROM users INNER JOIN employer ON users.id_user=employer.id_user WHERE users.id_user = '$username'";
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
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeInfoUser">
                                            Cập nhật thông tin
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <?php if (isset($_COOKIE['role']) && $_COOKIE['role'] == 1) {
                $id_user = $_COOKIE['id_user'];
                $query_get_corp_data = "SELECT * FROM (employer INNER JOIN corporation ON employer.id_corp = corporation.id_corp)INNER JOIN corp_field ON corporation.corp_field_id = corp_field.field_id WHERE id_user = '$id_user'";
                $result_corp = mysqli_query($conn, $query_get_corp_data);
                if (mysqli_num_rows($result_corp)) {
                    $rows = mysqli_fetch_assoc($result_corp);
                    $id_corp = $rows['id_corp'];
            ?>
                    <div class="row mt-5 d-flex flex-column border rounded p-2">
                        <div class="title_corp d-flex flex-row justify-content-between">
                            <h3>Công ty của bạn: <?php echo $rows['corp_name'] ?></h3>
                            <a href="<?php echo '../html/corp_details.php?id_corp=' . $rows['id_corp'] ?>">Xem thêm tại đây</a>
                        </div>
                        <div class="info_corp text-center mt-2">
                            <div class="row">
                                <div class="image_corp" style="min-height: 100px; min-width: 100px;">
                                    <div class="image">
                                        <img style="max-width: 400px;" src="../html/picture/corps/<?php echo $rows['image'] ?>" alt="corps_img">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="mo_ta border rounded p-2">
                                        <h4 class="ps-3 text-start" style="border-left: 3px solid;">Giới thiệu</h4>
                                        <p style="text-align: justify;"><?php echo $rows['description'] ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="website border rounded p-2">
                                        <h4 class="ps-3 text-start" style="border-left: 3px solid;">Website</h4>
                                        <a href="<?php echo $rows['website'] ?>">
                                            <p class="text-start"><?php echo $rows['website'] ?></p>
                                        </a>
                                    </div>
                                    <div class="address border rounded p-2">
                                        <h4 class="ps-3 text-start" style="border-left: 3px solid;">Address</h4>
                                        <p class="text-start"><?php echo $rows['address'] ?></p>
                                    </div>
                                    <div class="corp_field border rounded p-2">
                                        <h4 class="ps-3 text-start" style="border-left: 3px solid;">Lĩnh vực</h4>
                                        <p class="text-start border rounded" style="background-color: #abc2ff; max-width: max-content;"><?php echo $rows['field_name'] ?></p>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changeInfoCorp">Sửa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info_corp text-center mt-2">

                        </div>
                    </div>
            <?php }
            } ?>

            <hr class=" dropdown-divider">
            <div class="row col-md-12 mt-5">
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
    <div class="modal fade" id="changeInfoUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật thông tin người dùng</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Một vài thông tin quan trọng có thể sẽ không thể thay đổi được!</p>
                    <form action="./modules/modify_user_info.php" method="post" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <h2>Thông tin tài khoản</h2>
                            <?php
                            if ($_COOKIE['role'] == 0) {
                                $query2 = "SELECT users.username, users.email, employee.fullname, employee.gender, employee.phone_number, employee.id_user FROM users INNER JOIN employee ON users.id_user=employee.id_user WHERE users.id_user = '$username'";
                                $result2 = mysqli_query($conn, $query2);
                                while ($data2 = mysqli_fetch_assoc($result2)) {
                            ?>
                                    <table class="align-middle">
                                        <tr>
                                            <td>
                                                <p>Họ và tên: </p>
                                            </td>
                                            <td>
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
                                                <p>Ảnh avatar:</p>
                                            </td>
                                            <td>
                                                <input name="image_user" type="file" class="form-control ms-5" id="inputGroupFile01">
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
                                <?php } elseif ($_COOKIE['role'] == 1) {
                                $query2 = "SELECT users.username, users.email, employer.fullname, employer.gender, employer.phone_number, employer.id_user FROM users INNER JOIN employer ON users.id_user=employer.id_user WHERE users.id_user = '$username'";
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
                                                <p>Ảnh avatar:</p>
                                            </td>
                                            <td>
                                                <input name="image_user" type="file" class="form-control ms-5" id="inputGroupFile01">
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

    <div class="modal fade" id="changeInfoCorp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="./modules/modify_corp_info.php" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="">Sửa thông tin công ty</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form">
                            <p>Tên công ty</p>
                            <input class="form-control " type="text" name="corp_name" id="corp_name" value="<?php echo $rows['corp_name'] ?>">
                            <p>Mô tả</p>
                            <textarea class="form-control" name="description" id="description" cols="40" rows="10"></textarea>
                            <p>Logo công ty</p>
                            <input type="file" name="image_corp" class="form-control">
                            <p>Website</p>
                            <input type="text" name="website" class="form-control" value="<?php echo $rows['website'] ?>">
                            <p>Địa chỉ</p>
                            <input type="text" name="address" class="form-control" value="<?php echo $rows['address'] ?>">
                            <p>Lĩnh vực công ty</p>
                            <select name="corp_field" class="form-select" id="" required>
                                <option value="<?php echo $rows['field_id'] ?>"><?php echo $rows['field_name'] ?></option>
                                <?php include_once('../html/modules/import_field.php') ?>
                            </select>
                            <input class="form-control" type="text" name="id_corp" id="id_corp" value="<?php echo $id_corp ?>" style="display: none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary" name="submit">Thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <?php require_once('../includes/footer.php') ?>
</body>

</html>