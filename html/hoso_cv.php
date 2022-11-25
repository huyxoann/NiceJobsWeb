<?php
require('./modules/connection.php');


$date = isset($_COOKIE['date']) ? $_COOKIE['date'] : "";
function split_date($date)
{
    $convertToTime = strtotime($date);
    return date('d-m-Y', $convertToTime);
}
if (isset($_POST['saveCV']) && $_POST['saveCV']) {
    $id_user = $_COOKIE['id_user'];
    $cv_name = mysqli_real_escape_string($conn, $_POST['cv_name']);
    $file_pdf = $_FILES['pdf']['name'];
    $file_pdf_temp = $_FILES['pdf']['tmp_name'];
    $career = mysqli_real_escape_string($conn, $_POST['career']);
    $exp = mysqli_real_escape_string($conn, $_POST['exp']);
    if ($career == 0 || $exp == 0) {
        $notification = "Thêm không thành công!";
        header('hoso_cv.php');
    } else {
        $add_cv_query = "INSERT INTO cv (`file_name`, cv_name, id_user, career_id, exp_id) VALUES ('$file_pdf', '$cv_name', '$id_user', '$career', '$exp')";
        if ($conn->query($add_cv_query)) {
            move_uploaded_file($file_pdf_temp, '../pdf/' . $file_pdf);
            $notification = "Thêm CV thành công!";
            header('Location: hoso_cv.php');
        } else {
            $notification = "Đã có lỗi xảy ra! Vui lòng thử lại sau!";
            header('Location: hoso_cv.php');
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hồ sơ CV | Nice Job</title>
    <link rel="stylesheet" href="../CSS/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/stylechung.css">
    <script src="../css/bootstrap.bundle.min.js"></script>
    <script src="../css/jquery-3.6.0.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <?php require("../includes/header.php") ?>
    <div class="container mt-3">
        <div class="info-content">
            <div class="row mt-5">
                <div class="col-md-3">
                    <div class="avatar_img text-center">
                        <?php
                        $id_user = isset($_COOKIE['id_user']) ? $_COOKIE['id_user'] : '';
                        $query1 = "SELECT * FROM employee WHERE id_user = '$id_user'";
                        $result1 = mysqli_query($conn, $query1);
                        while ($data = mysqli_fetch_assoc($result1)) {
                        ?>
                            <img style="max-width: 400px;" src="../images/users/<?php echo $data['image'] ?>" alt="user_img">
                        <?php } ?>
                    </div>
                    <div class="name">
                        <p class="text-center"><?php if (isset($_COOKIE['username'])) {
                                                    echo ($_COOKIE['username']);
                                                }  ?></p>
                        <p class="text-center"><?php echo split_date($date) ?></p>
                    </div>
                </div>
                <div class="col-md-9">
                    <h2 class="text-center border">Quản lý CV</h2>
                    <div class="DanhSachCV">
                        <div class="row d-flex justify-content-between ">
                            <div class="col">
                                <h3>Danh sách CV của bạn</h3>
                            </div>
                            <div class="col"></div>
                            <div class="col">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Thêm +</button>
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-md-12">
                                <?php include('get_cv.php') ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <hr class="dropdown-divider">
            <div class="row col-md-12">

            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm CV Mới</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-control" action="hoso_cv.php" method="post" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <h2>Thông tin CV</h2>
                            <table class="">
                                <tr>
                                    <td>
                                        <p>Tên CV: </p>
                                    </td>
                                    <td>
                                        <input class="form-control ms-5" type="text" name="cv_name" id="cv_name" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>File PDF: </p>
                                    </td>
                                    <td>
                                        <input type="file" name="pdf" id="pdf" class="form-control ms-5" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Ngành nghề: </p>
                                    </td>
                                    <td>
                                        <select name="career" class="form-control select ms-5" required>
                                            <option value="0">Chọn ngành nghề</option>
                                            <?php
                                            require('../html/modules/import_career.php');
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Kinh nghiệm: </p>
                                    </td>
                                    <td>
                                        <select name="exp" class="form-control select ms-5" required>
                                            <option value="0">Chọn kinh nghiệm</option>
                                            <?php
                                            require('../html/modules/import_exp.php');
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                            </table>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" name="saveCV" value="Thêm"></input>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    include('./modules/notification.php');
    require("../includes/footer.php");
    ?>
</body>

</html>