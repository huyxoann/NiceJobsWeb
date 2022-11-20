<?php
session_start();
include '../config/connectdb.php';
include '../functions/myfunctions.php';
//////////// tài khoản users employee - nhân viên

if (isset($_POST['add_users_employee'])) {
    $id_user = '';
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $pass = $_POST['password'];
    $email   = $_POST['email'];
    $gender = $_POST['gender'];
    $phone_number = $_POST['phone_number'];
 
    $role = 0;
    $is_exist_user = true;

    

    $avatar = $_FILES['avatar']['name'];
    $avatar_tmp = $_FILES['avatar']['tmp_name'];

    //check if username already registered
    $sql = "SELECT `username` FROM `users` WHERE `username` = '$username' AND `role` = '$role' ";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        redirect("add-users-employee.php", "Username đã trùng với một tài khoản nào đó, vui lòng nhập lại !");
    } else {
        //Kiem tra password
        if (!preg_match('/^(?=.{8,32})(((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]))).*$/', $pass)) {
            redirect("add-users-employee.php", "Mật khẩu nhập không đúng định dạng, vui lòng nhập lại !");
        } else {
            //Kiem tra email da ton tai
            $sql_checking_email = "SELECT * FROM users WHERE `email` = '$email' AND `role` = '$role' ";
            $result_sql_email = mysqli_query($conn, $sql_checking_email);
            if (mysqli_num_rows($result_sql_email) > 0) {
                redirect("add-users-employee.php", "Email đã được sử dụng, vui lòng nhập email khác");
            } else {
                //Tao id user
                while ($is_exist_user) {
                    $id_user = 'NV' . rand(100000, 999999);
                    $sql_check_id_user = "SELECT * FROM users WHERE id_user = '$id_user' AND `role` = '$role' ";
                    $result_sql_id = mysqli_query($conn, $sql_check_id_user);
                    if (mysqli_num_rows($result_sql_id) > 0) {
                        $is_exist_user = true;
                    } else {
                        $is_exist_user = false;
                    }
                }
                //Insert users data
                $password = md5($pass);

                $query = 
                "INSERT INTO `users`
                        (`id_user` ,`username`, `password`,`email`,`role`)
                VALUES ('$id_user','$username','$password','$email','$role')";
                $query_run = mysqli_query($conn, $query);

                $query_1 =
                    "INSERT INTO `employee`
                        (`fullname`,  `phone_number`,`avatar`, `id_user`,`gender`) 
                VALUES ('$fullname','$phone_number','$avatar','$id_user','$gender')";
                $query_run_1 = mysqli_query($conn, $query_1);
                if ($query_run == TRUE && $query_run_1 == TRUE) {
                    move_uploaded_file($avatar_tmp, '../images/' . $avatar);
                    redirect("users-employee.php", "Users Employee Added Successfully");
                } else {
                    redirect("user-employee.php", "Something Went Wrong");
                }
            }
        }
    }


   
}

