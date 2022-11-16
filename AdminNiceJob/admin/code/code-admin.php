<?php
session_start();

include '../config/connectdb.php';
include '../functions/myfunctions.php';

//////////// tài khoản admin
if (isset($_POST['add_user_admin_btn'])) {

    $username = $_POST['username'];
    $pass = $_POST['password'];
    $re_password   = $_POST['re_password'];


    //check $pass == $re_pass
    if ($pass == $re_password) {
        if (!(preg_match(' /^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/', $pass))) {
            redirect("add-user-admin.php", "mk cần 6 đến 32 kí tự : 1 chữ thường, 1 chữ hoa , 1 số và 1 kí tự đặc biệt");
        } else {
            $password = md5($pass);
            //Insert user data
            $query = "INSERT INTO `admin`( `username`, `password`)
                                    VALUES ('$username','$password')";
            $query_run = mysqli_query($conn, $query);
            if ($query_run) {
                redirect("user-admin.php", "User Admin Added Successfully");
            } else {
                redirect("user-admin.php", "Something Went Wrong");
            }
        }
    } else {
        redirect("add-user-admin.php", "Passwords and Re-Password do not match !");
    }
} else if (isset($_POST['edit_user_admin_btn'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $re_password   = $_POST['re_password'];


    //check $pass == $re_pass
    if ($pass == $re_password) {
        if (!(preg_match(' /^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/', $pass))) {
            redirect("add-user-admin.php", "mk cần 6 đến 32 kí tự : 1 chữ thường, 1 chữ hoa , 1 số và 1 kí tự đặc biệt");
        } else {
            $password = md5($pass);
            //Insert user data
            $query = "UPDATE `admin` SET username='$username' , password='$password' WHERE id='$id'";
            $query_run = mysqli_query($conn, $query);
            if ($query_run) {
                redirect("user-admin.php", "User Admin Update Successfully");
            } else {
                redirect("user-admin.php", "Something Went Wrong");
            }
        }
    } else {
        redirect("edit-user-admin.php", "Passwords and Re-Password do not match !");
    }
} elseif (isset($_POST['delete_user_admin_btn'])) {
    $id = $_POST['id'];

    $query = "SELECT * FROM admin WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);

    $delete_query = "DELETE FROM `admin` WHERE id='$id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {

        redirect("user-admin.php", "User Admin Deleted Successfully");
    } else {
        redirect("user-admin.php", "Something Went Wrong !");
    }
}
