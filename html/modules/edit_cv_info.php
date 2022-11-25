<?php
require_once('connection.php');
if (isset($_POST['saveCV']) && $_POST['saveCV']) {
    $id_user = isset($_COOKIE['id_user']) ? $_COOKIE['id_user'] : "";
    $cv_name = mysqli_real_escape_string($conn, $_POST['cv_name']);
    $career = mysqli_real_escape_string($conn, $_POST['career']);
    $exp = mysqli_real_escape_string($conn, $_POST['exp']);
    if ($career == 0 || $exp == 0) {
        $notification = "Sửa không thành công!";
        header('Location: ../hoso_cv.php');
    } else {
        $add_cv_query = "UPDATE cv SET  cv_name = '$cv_name', career_id = '$career', exp_id = '$exp' WHERE id_user = '$id_user' ";
        if ($conn->query($add_cv_query)) {
            $notification = "Sửa CV thành công!";
            header('Location: ../hoso_cv.php');
        } else {
            $notification = "Đã có lỗi xảy ra! Vui lòng thử lại sau!";
            header('Location: ../hoso_cv.php');
        }
    }
}
