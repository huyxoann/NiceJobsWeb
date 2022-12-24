<?php
require('../html/modules/connection.php');

?>
<!DOCTYPE html>
<html lang="en, vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Việc Làm | Nice Job</title>
    <link rel="stylesheet" href="../CSS/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/vieclam.css">
    <link rel="icon" href="../images/logo nicejob.png">
    <link rel="stylesheet" href="../css/stylechung.css">
    <script src="../css/bootstrap.bundle.min.js"></script>
    <script src="../css/jquery-3.6.0.min.js"></script>
</head>
<?php
include('../includes/header.php');
require('../html/modules/add_users_info.php');
?>

<div class="content container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
            <li class="breadcrumb-item active" aria-current="page">Việc làm</li>
        </ol>
    </nav>
    <div class="title">
        <h4>Tìm kiếm công việc của bạn</h4>
    </div>
    <form action="../html/vieclam.php" method="get">
        <div class="find-job">
            <div class="input">
                <input type="text" name="search_bar" id="search_bar" class="form-control" placeholder="Nhập công việc, vị trí bạn muốn ứng tuyển..." required value="<?php if (isset($_GET['search_bar'])) {
                                                                                                                                                                            echo $_GET['search_bar'];
                                                                                                                                                                        } else {
                                                                                                                                                                            echo '';
                                                                                                                                                                        } ?>">
            </div>
            <div class="form-group">
                <select class="form-control select" name="career">
                    <option value="0">Ngành nghề</option>
                    <?php require_once('../html/modules/import_career.php'); ?>
                </select>
                <select class="form-control select" name="level">
                    <option value="0">Cấp bậc</option>
                    <?php require_once('../html/modules/import_level.php') ?>
                </select>
            </div>
            <div class="form-group">
                <!-- <select class="form-control select" name="field">
                    <option value="0">Lĩnh vực công ty</option>
                    <?php require_once('../html/modules/import_field.php') ?>
                </select> -->
                <select class="form-control select" name="way_to_work">
                    <option value="0">Hình thức làm việc</option>
                    <?php require_once('../html/modules/import_way_to_work.php') ?>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control select" name="province">
                    <option value="0">Địa điểm</option>
                    <?php require_once('../html/modules/import_province.php') ?>
                </select>
                <select class="form-control select" name="salary">
                    <option value="0">Mức lương</option>
                    <?php require_once('../html/modules/import_salary.php') ?>
                </select>
            </div>
            <div class="search-button">
                <input type="submit" name="search" class="btn btn-primary" value="Tìm kiếm">
            </div>
        </div>
    </form>

</div>


<div class="tin-tuyen-dung container">

    <div class="list-cong-viec row">
        <?php include('../html/modules/search_job_show.php'); ?>
    </div>
</div>
<?php include('../includes/footer.php') ?>