<?php
require_once("../modules/connection.php");
include_once("../modules/alert_mess.php");
if (isset($_POST['saveInfo']) && $_POST['saveInfo']) {
    $id_user = $_COOKIE['id_user'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    $image = $_FILES['img']['name'];
    $image_temp = $_FILES['img']['tmp_name'];
    if ($fullname == "" || $gender == "" || $phone_number == "") {
        $mess = "Sửa thông tin không thành công, vui lòng kiểm tra lại!";
        show($mess);
    } elseif ($_COOKIE['role'] == 0) {
        $query_modify = "UPDATE employee SET fullname = '$fullname', gender = $gender, phone_number = '$phone_number', image = '$image' WHERE id_user = $id_user";
        if ($conn->query($query_modify)) {
            move_uploaded_file($image_temp, '../images/users/' . $image);
            header("Location: ../view_my_info.php");
        }
    } elseif ($_COOKIE['role'] == 1) {
        $query_modify = "UPDATE employer SET fullname = '$fullname', gender = $gender, phone_number = '$phone_number', image = '$image' WHERE id_user = $id_user";
        if ($conn->query($query_modify)) {
            move_uploaded_file($image_temp, '../images/users/' . $image);
            header("Location: ../view_my_info.php");
        }
    } else {
        $mess = "Sửa thông tin không thành công, vui lòng kiểm tra lại!";
        show($mess);
        header("Location: ../view_my_info.php");
    }
}
