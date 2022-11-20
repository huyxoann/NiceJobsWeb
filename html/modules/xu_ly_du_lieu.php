<?php
require("../html/modules/connection.php");
include('../html/modules/alert_mess.php');
if (isset($_POST['saveInfo']) && $_POST['saveInfo']) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    $id_user = $_COOKIE['id_user'];
    if (isset($_COOKIE['role']) && $_COOKIE['role'] == 0) {
        $employee_query = "INSERT INTO employee (fullname, gender, phone_number, image, id_user) VALUES('$full_name', '$gender', '$phone_number', '$image', '$id_user')";
        if ($conn->query($employee_query)) {
            move_uploaded_file($image_temp, '../images/users/' . $image);
            header("Location: ../html/trangchu.php");
        } else {
            $notification = "Thêm thông tin không thành công, vui lòng kiểm tra lại!";
        }
    } elseif (isset($_COOKIE['role']) && $_COOKIE['role'] == 1) {
        $corp_name = mysqli_real_escape_string($conn, $_POST['corp_name']);
        $corp_img = $_FILES['corp_img']['name'];
        $image_tmp = $_FILES['corp_img']['tmp_name'];
        $website = mysqli_real_escape_string($conn, $_POST['website']);
        $corp_address = mysqli_real_escape_string($conn, $_POST['corp_address']);
        $corp_field  = mysqli_real_escape_string($conn, $_POST['corp_field']);
        $moTa = mysqli_real_escape_string($conn, $_POST['moTaCongTy']);
        $id_corp = corp_generator();
        $query_check_corp_id = "SELECT * FROM corporation WHERE id_corp = '$id_corp'";

        while (mysqli_num_rows(mysqli_query($conn, $query_check_corp_id))) {
            $id_corp = corp_generator();
        }
        $corp_query = "INSERT INTO corporation (id_corp, corp_name, description, image, website, address, corp_field_id) VALUES('$id_corp', '$corp_name', '$moTa', '$corp_img', '$website', '$corp_address', '$corp_field') ";
        if ($conn->query($corp_query)) {
            move_uploaded_file($image_tmp, '../images/corps/' . $corp_img);
            header("Location: ../html/trangchu.php");
        }
        $employer_query = "INSERT INTO employer (fullname, gender, phone_number, image, id_user, id_corp) VALUES('$full_name', '$gender', '$phone_number', '$avatar_img', '$id_user', '$id_corp')";
        if ($conn->query($employer_query)) {
            header("Location: ../html/trangchu.php");
        }
    } else {
    }
}

function corp_generator()
{
    return "CT" . rand(10000000, 99999999);
}
