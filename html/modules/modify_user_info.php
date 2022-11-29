<?php
require_once("connection.php");
require_once("alert_mess.php");
include('notification.php');
if (isset($_POST['saveInfo'])) {
    $id_user = htmlspecialchars($_COOKIE['id_user']);
    $fullname = htmlspecialchars($_POST['fullname']);
    $gender = htmlspecialchars($_POST['gender']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $image = $_FILES['image_user']['name'];
    $image_temp = $_FILES['image_user']['tmp_name'];
    if ($fullname == "" || $gender == "" || $phone_number == "") {
        header("Location: ../view_my_info.php");
        $mess = "Sửa thông tin không thành công, vui lòng kiểm tra lại!";
        show($mess);
    } elseif ($_COOKIE['role'] == 0) {
        $query_modify = "UPDATE employee SET fullname = '$fullname', gender = '$gender', phone_number = '$phone_number', image = '$image' WHERE id_user = '$id_user'";
        if ($conn->query($query_modify)) {
            move_uploaded_file($image_temp, '../picture/users/' . $image);
            header("Location: ../view_my_info.php");
        } else {
            echo "Ko thêm được";
        }
    } elseif ($_COOKIE['role'] == 1) {
        $query_modify = "UPDATE employer SET fullname = '$fullname', gender = '$gender', phone_number = '$phone_number', image = '$image' WHERE id_user = '$id_user'";
        if ($conn->query($query_modify)) {
            move_uploaded_file($image_temp, '../picture/users/' . $image);
            header("Location: ../view_my_info.php");
        }
    } else {
        $mess = "Sửa thông tin không thành công, vui lòng kiểm tra lại!";
        show($mess);
        header("Location: ../view_my_info.php");
    }
} else {
    header("Location: ../view_my_info.php");
}
