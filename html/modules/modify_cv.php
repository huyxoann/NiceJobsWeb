<?php
require_once('connection.php');
if (isset($_POST['change'])) {
    $cv_name = mysqli_escape_string($conn, $_POST['cv_name']);
    $pdf_file = $_FILES['file_pdf']['name'];
    $pdf_file_temp = $_FILES['file_pdf']['tmp_name'];
    $career_id = mysqli_escape_string($conn, $_POST['career']);
    $exp_id = mysqli_escape_string($conn, $_POST['exp']);
    $id_cv = mysqli_escape_string($conn, $_POST['id_cv']);
    $destination_path = getcwd() . DIRECTORY_SEPARATOR;
    $target_path = $destination_path . '../pdf/' . basename($_FILES['file_pdf']['name']);
    $query_update_cv_info = "UPDATE `cv` SET `cv_name` = '$cv_name', `file_name` = '$pdf_file', `career_id` = '$career_id', `exp_id` = '$exp_id' WHERE `cv_id` = '$id_cv'";

    $allowUpload   = true;

    $imageFileType = pathinfo($target_path, PATHINFO_EXTENSION);

    $maxfilesize   = 800000;

    $allowtypes    = array('pdf');


    if ($_FILES["file_pdf"]["size"] > $maxfilesize || !in_array($imageFileType, $allowtypes)) {
        echo "1";
    } else {
        if (move_uploaded_file($_FILES['file_pdf']['name'], $target_path)) {
            if (mysqli_query($conn, $query_update_cv_info)) {
                $notification = "Thêm CV thành công!";
                // header('Location: hoso_cv.php');
            } else {
                $notification = "Đã có lỗi xảy ra! Vui lòng thử lại sau!";
                // header('Location: hoso_cv.php');
            }
        }
    }
}
if (isset($_POST['delete_cv'])) {
    $cv_id = isset($_POST['cv_id']) ? $_POST['cv_id'] : "";
    echo $cv_id . "<br>";
    $query_delete_cv = "DELETE FROM cv WHERE cv_id = '$cv_id'";
    echo 2;
    if ($conn->query($query_delete_cv)) {
        echo 3;
    }
    echo 4;
    header('Location: ../hoso_cv.php');
}
echo 5;
