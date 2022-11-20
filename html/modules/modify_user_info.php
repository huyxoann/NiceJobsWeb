<?php
require_once("connection.php");
require_once("alert_mess.php");
include('notification.php');
if (isset($_POST['saveInfo']) && $_POST['saveInfo']) {
    $id_user = $_COOKIE['id_user'];
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    if ($fullname == "" || $gender == "" || $phone_number == "") {
        echo "3";
        header("Location: ../view_my_info.php");
        $mess = "Sửa thông tin không thành công, vui lòng kiểm tra lại!";
        show($mess);
    } elseif ($_COOKIE['role'] == 0) {
        $query_modify = "UPDATE employee SET fullname = '$fullname', gender = '$gender', phone_number = '$phone_number' WHERE id_user = '$id_user'";
        if ($conn->query($query_modify)) {
            header("Location: ../view_my_info.php");
        } else {
            echo "Ko thêm được";
        }
    } elseif ($_COOKIE['role'] == 1) {
        $query_modify = "UPDATE employer SET fullname = '$fullname', gender = '$gender', phone_number = '$phone_number' WHERE id_user = '$id_user'";
        if ($conn->query($query_modify)) {
            echo "5";
            header("Location: ../view_my_info.php");
        }
    } else {
        echo "6";
        $mess = "Sửa thông tin không thành công, vui lòng kiểm tra lại!";
        show($mess);
        header("Location: ../view_my_info.php");
    }
} else {
    echo "7";
    header("Location: ../view_my_info.php");
}
