<?php
require_once("../modules/connection.php");
include_once("../modules/alert_mess.php");
if (isset($_POST['saveInfo']) && $_POST['saveInfo']) {
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
    if ($fullname == "" || $gender == "" || $phone_number == "") {
        $mess = "Sửa thông tin không thành công, vui lòng kiểm tra lại!";
        show($mess);
    } elseif ($_COOKIE['role'] == 0) {
        $query_modify = "UPDATE employee SET fullname = '$fullname', gender = $gender, phone_number = '$phone_number'";
        if ($conn->query($query_modify)) {
            header("Location: ../html/view_my_info.php");
        }
    } else {
        $mess = "Sửa thông tin không thành công, vui lòng kiểm tra lại!";
        show($mess);
    }
}
