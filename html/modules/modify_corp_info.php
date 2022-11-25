<?php
require_once('connection.php');
if (isset($_POST['submit'])) {
    $corp_name = mysqli_escape_string($conn, $_POST['corp_name']);
    $description = mysqli_escape_string($conn, $_POST['description']);
    $image = $_FILES['image_corp']['name'];
    $image_temp = $_FILES['image_corp']['tmp_name'];
    $website = mysqli_escape_string($conn, $_POST['website']);
    $address = mysqli_escape_string($conn, $_POST['address']);
    $field_corp = mysqli_escape_string($conn, $_POST['corp_field']);
    $id_corp = mysqli_escape_string($conn, $_POST['id_corp']);

    $query_corp = "UPDATE corporation SET corp_name = '$corp_name', description = '$description', image = '$image', website = '$website', address = '$address', corp_field_id = '$field_corp' WHERE id_corp = '$id_corp'";
    if ($conn->query($query_corp)) {
        move_uploaded_file($image_temp, '../picture/corps/' . $image);
        header("Location: ../view_my_info.php");
    } else {
        header("Location: ../view_my_info.php");
    }
}
