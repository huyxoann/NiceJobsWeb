<?php
require('../html/modules/connection.php');

?>
<!DOCTYPE html>
<html lang="en, vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ | Nice Job</title>
    <link rel="stylesheet" href="../CSS/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/vieclam.css">
    <link rel="stylesheet" href="../css/stylechung.css">
    <script src="../css/bootstrap.bundle.min.js"></script>
    <script src="../css/jquery-3.6.0.min.js"></script>
</head>
<?php include('../includes/header.php') ?>
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
    <div class="find-job">
        <div class="title">
        </div>
        <div class="input">
            <input type="text" name="" id="" class="form-control" placeholder="Nhập công việc, vị trí bạn muốn ứng tuyển...">
        </div>
        <div class="form-group">
            <select class="form-control select">
                <option value="0">Ngành nghề</option>
                <?php require_once('../html/modules/import_career.php'); ?>
            </select>
            <select class="form-control select">
                <option value="0">Cấp bậc</option>
                <?php require_once('../html/modules/import_level.php') ?>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control select">
                <option value="0">Lĩnh vực công ty</option>
                <?php require_once('../html/modules/import_field.php') ?>
            </select>
            <select class="form-control select">
                <option value="0">Hình thức làm việc</option>
                <?php require_once('../html/modules/import_way_to_work.php') ?>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control select">
                <option value="0">Địa điểm</option>
                <?php require_once('../html/modules/import_province.php') ?>
            </select>
            <select class="form-control select">
                <option value="">Mức lương</option>
                <?php require_once('../html/modules/import_salary.php') ?>
            </select>
        </div>
        <div class="search-button">
            <button type="button " class="btn btn-primary me-2">Tìm kiếm</button>
        </div>
    </div>

</div>


<div class="tin-tuyen-dung container">
    <div class="title-ttd">
        <h3>Tin tuyển dụng mới nhất</h3>
    </div>
    <div class="list-cong-viec d-flex flex-wrap">
        <div class="row">
            <?php
            $query_import_job = "SELECT * FROM (((((((jobs INNER JOIN corporation ON jobs.corp_id = corporation.id_corp) INNER JOIN career ON career.career_id = jobs.career_id) INNER JOIN experience ON experience.exp_id = jobs.exp_id) INNER JOIN province ON province.province_id = jobs.job_id) INNER JOIN level ON level.level_id = jobs.level_id) INNER JOIN way_to_work ON way_to_work.way_to_work_id = jobs.way_to_work_id) INNER JOIN salary ON salary.salary_id = jobs.salary_id) WHERE DATEDIFF(deadline, CURRENT_DATE())>0 ORDER BY created_at DESC";
            $result_query_import_job = mysqli_query($conn, $query_import_job);
            if (mysqli_num_rows($result_query_import_job) > 0) {
                while ($rows = mysqli_fetch_assoc($result_query_import_job)) { ?>
                    <div class="jobs_item col-md">
                        <div class="logo-company">
                            <a href="../html/corp_details.php?id_corp=<?= $rows['corp_id'] ?>">
                                <img src="../html/picture/corps/<?= $rows['image'] ?>" alt="logo1">
                            </a>
                        </div>
                        <div class="info-company">
                            <a href="../html/job_detail.php?job_id=<?= $rows['job_id'] ?>">
                                <h4 class="name-job text-truncate">
                                    <?php echo $rows['job_name'] ?>
                                </h4>
                            </a>
                            <a href="../html/corp_details.php?id_corp=<?= $rows['corp_id'] ?>">
                                <small class="name-company text-truncate">
                                    <?php echo $rows['corp_name'] ?>
                                </small>
                            </a>
                            <div class="tag_info">
                                <p class="d-inline-block p-1 border rounded" style="background-color: #abc2ff;"><?= $rows['salary_name'] ?></p>
                                <p class="d-inline-block p-1" style="background-color: #abc2ff;"><?= $rows['province_name'] ?></p>
                            </div>
                        </div>
                    </div>
            <?php }
            } else {
                echo "No data";
            }
            ?>
        </div>

    </div>
</div>
<?php include('../includes/footer.php') ?>