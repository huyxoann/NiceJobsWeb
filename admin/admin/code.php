<?php
session_start();


include '../config/connectdb.php';
include '../functions/myfunctions.php';

//////// list company
if (isset($_POST['add_company_btn'])) {
    $id_corp	=$_POST['id_corp'];
    $corp_name = $_POST['corp_name'];

    $corp_field = $_POST['corp_field'];
    $corp_mail = $_POST['corp_mail'];
    $website= $_POST['website'];
    $address = $_POST['address'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    $query = "INSERT INTO `corporation`
            (`id_corp`, `corp_name`, `corp_field`, `corp_mail`, `image`, `description`, `website`, `address`) 
    VALUES ('$id_corp','$corp_name','$corp_field','$corp_mail','$filename','$description','$website','$address')";
    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        redirect("list-company.php", "Corporation Added Successfully");
    } else {
        redirect("add-company.php", "Something Went Wrong");
    }
} else if (isset($_POST['update_corporation_btn'])) {
    $id_corp	=$_GET['id_corp'];

    $corp_name = $_POST['corp_name'];
    $corp_field = $_POST['corp_field'];
    $corp_mail = $_POST['corp_mail'];
    $website= $_POST['website'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $image = $_FILES['image'];
    $path = "../uploads";

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
      
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $path = "../uploads";
    

     $update_corporation_query = " UPDATE `corporation` SET 
     `corp_name`='$corp_name',`corp_field`='$corp_field',`corp_mail`='$corp_mail'
     ,`image`='$update_filename',`description`='$description',`website`='$website',`address`='$address' 
     WHERE `id_corp`='$id_corp'";

    $update_corporation_query_run = mysqli_query($conn,$update_corporation_query);

    if ($update_corporation_query_run ) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("list-company.php", "Corporation Update Successfully");
    } else {
        redirect("list-company.php", "Something Went Wrong");
    }

} elseif (isset($_POST['delete_company_btn'])) {

    $id_corp = mysqli_real_escape_string($conn, $_POST['id_corp']);

    $query = "SELECT * FROM corporation WHERE id_corp='$id_corp'";
    $query_run = mysqli_query($conn, $query);
    $ata = mysqli_fetch_array($query_run);
    $image = $data['image'];


    $delete_query = "DELETE FROM corporation WHERE id_corp='$id_corp '";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        redirect("list-company.php", "Category Deleted Successfully");
    } else {
        redirect("list-company.php", "Something Went Wrong !");
    }
}
//////////// top company
if (isset($_POST['add_top_company_btn'])) {
    $name = $_POST['name'];

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    $cate_query = "INSERT INTO `top_company`(`name`, `image`) 
                                    VALUES ('$name','$filename')";
    $cate_query_run = mysqli_query($conn, $cate_query);
    if ($cate_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        redirect("add-top-company.php", "Top company Added Successfully");
    } else {
        redirect("add-top-company.php", "Something Went Wrong");
    }
} else if (isset($_POST['update_top_company_btn'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $path = "../uploads";

    $update_query = "UPDATE top_company SET 
    name='$name',image='$update_filename' WHERE id='$id'";




    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("edit-top-company.php?id=$id", "Top company Update Successfully");
    } else {
        redirect("edit-top-company.php?id=$id", "Something Went Wrong");
    }
} elseif (isset($_POST['delete_top_company_btn'])) {

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "SELECT * FROM top_company WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($query_run);

    $image = $data['image'];


    $delete_query = "DELETE FROM top_company WHERE id='$id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        redirect("top-company.php", "Top company Deleted Successfully");
    } else {
        redirect("top-company.php", "Something Went Wrong !");
    }
}
///////// mau cv
if (isset($_POST['add_mau_cv_btn'])) {
    $name = $_POST['name'];

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    $cate_query = "INSERT INTO `mau_cv`(`name`, `image`) 
                                    VALUES ('$name','$filename')";
    $cate_query_run = mysqli_query($conn, $cate_query);
    if ($cate_query_run) {
        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
        redirect("add-mau-cv.php", "Mẫu CV Added Successfully");
    } else {
        redirect("add-mau-cv.php", "Something Went Wrong");
    }
} else if (isset($_POST['update_mau_cv_btn'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != "") {
        // $update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $path = "../uploads";

    $update_query = "UPDATE mau_cv SET 
    name='$name',image='$update_filename' WHERE id='$id'";




    $update_query_run = mysqli_query($conn, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("edit-mau-cv.php?id=$id", "Mẫu CV Update Successfully");
    } else {
        redirect("edit-mau-cv.php?id=$id", "Something Went Wrong");
    }
} elseif (isset($_POST['delete_mau_cv_btn'])) {

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "SELECT * FROM mau_cv WHERE id='$id'";
    $query_run = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($query_run);

    $image = $data['image'];


    $delete_query = "DELETE FROM mau_cv WHERE id='$id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        redirect("mau-cv.php", "Mẫu cv Deleted Successfully");
    } else {
        redirect("mau-cv.php", "Something Went Wrong !");
    }
}
/////////////////////////////////////// tài khoản

//////////// tài khoản admin
if (isset($_POST['add_user_admin_btn'])) {
   
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $re_password   = $_POST['re_password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    //check if email already registered
    $check_email_query = "SELECT `email`FROM `admin` WHERE `email` = '$email' ";
    $check_email_query_run = mysqli_query($conn, $check_email_query);
    if (mysqli_num_rows($check_email_query_run) > 0) {
        redirect("add-user-admin.php", "Email đã tồn tại ! Vui lòng nhập email khác !");
    } else {
        //check $pass == $re_pass
        if ($pass == $re_password) {
            if (! (preg_match(' /^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/',$pass)) ) {
                redirect("add-user-admin.php", "mk cần 6 đến 32 kí tự : 1 chữ thường, 1 chữ hoa , 1 số và 1 kí tự đặc biệt");
            } else {
                $password = md5($pass);
                //Insert user data
                $query = "INSERT INTO `admin`( `username`, `password`,`email`, `phone`,  `address` )
                                    VALUES ('$username','$password','$email','$phone','$address')";
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
    }
} else if (isset($_POST['edit_user_admin_btn'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $re_password   = $_POST['re_password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
        //check $pass == $re_pass
        if ($pass == $re_password) {
            if (! (preg_match(' /^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/',$pass)) ) {
                redirect("add-user-admin.php", "mk cần 6 đến 32 kí tự : 1 chữ thường, 1 chữ hoa , 1 số và 1 kí tự đặc biệt");
            } else {
                $password = md5($pass);
                //Insert user data
                $query = "UPDATE `admin` SET username='$username' , password='$password',email='$email',phone='$phone',address='$address' WHERE id='$id'";
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
    $delete_query = "DELETE FROM `admin` WHERE id='$id'";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if ($delete_query_run) {
        redirect("user-admin.php", "User Admin Deleted Successfully");
    } else {
        redirect("user-admin.php", "Something Went Wrong !");
    }
}
///////////////// tài khoản users -tk thường
if (isset($_POST['add_user_admin_btn'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $re_password   = $_POST['re_password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    //check if email already registered
    $check_email_query = "SELECT `email`FROM `admin` WHERE `email` = '$email' ";
    $check_email_query_run = mysqli_query($conn, $check_email_query);
    if (mysqli_num_rows($check_email_query_run) > 0) {
        redirect("add-user-admin.php", "Email đã tồn tại ! Vui lòng nhập email khác !");
    } else {
        //check $pass == $re_pass
        if ($pass == $re_password) {
            if (! (preg_match(' /^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/',$pass)) ) {
                redirect("add-user-admin.php", "mk cần 6 đến 32 kí tự : 1 chữ thường, 1 chữ hoa , 1 số và 1 kí tự đặc biệt");
            } else {
                $password = md5($pass);
                //Insert user data
                $query = "INSERT INTO `admin`( `username`, `password`,`email`, `phone`,  `address` )
                                    VALUES ('$username','$password','$email','$phone','$address')";
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
    }
} 
///////sửa xóa người dùng
// else if (isset($_POST['edit_user_admin_btn'])) {
//     $id = $_POST['id'];
//     $username = $_POST['username'];
//     $pass = $_POST['password'];
//     $re_password   = $_POST['re_password'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $address = $_POST['address'];
//         //check $pass == $re_pass
//         if ($pass == $re_password) {
//             if (! (preg_match(' /^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/',$pass)) ) {
//                 redirect("add-user-admin.php", "mk cần 6 đến 32 kí tự : 1 chữ thường, 1 chữ hoa , 1 số và 1 kí tự đặc biệt");
//             } else {
//                 $password = md5($pass);
//                 //Insert user data
//                 $query = "UPDATE `admin` SET username='$username' , password='$password',email='$email',phone='$phone',address='$address' WHERE id='$id'";
//                 $query_run = mysqli_query($conn, $query);
//                 if ($query_run) {
//                     redirect("user-admin.php", "User Admin Update Successfully");
//                 } else {
//                     redirect("user-admin.php", "Something Went Wrong");
//                 }
//             }
//         } else {
//             redirect("edit-user-admin.php", "Passwords and Re-Password do not match !");
//         }
// } elseif (isset($_POST['delete_users_btn'])) {
//     $id = $_POST['id'];
//     $delete_query = "DELETE FROM `admin` WHERE id='$id'";
//     $delete_query_run = mysqli_query($conn, $delete_query);

//     if ($delete_query_run) {
//         redirect("user-admin.php", "User Admin Deleted Successfully");
//     } else {
//         redirect("user-admin.php", "Something Went Wrong !");
//     }
// }