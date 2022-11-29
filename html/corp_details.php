<?php
require '../html/modules/connection.php';
if (isset($_GET['id_corp'])) {
    $id_corp = $_GET['id_corp'];
    $query = "SELECT * FROM `corporation` where id_corp='$id_corp'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        $GLOBALS['corp_item'] = mysqli_fetch_assoc($query_run);
    }
} else {
    header("Location: page_404.php");
}
?>

<!DOCTYPE html>
<html lang="en, vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $corp_item['corp_name'] ?></title>
    <link rel="stylesheet" href="../CSS/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../CSS/trangChu.css">
    <link rel="stylesheet" href="../css/stylechung.css">
    <script src="../css/bootstrap.bundle.min.js"></script>
    <script src="../css/jquery-3.6.0.min.js"></script>
</head>
<?php include('../includes/header.php') ?>
<div id="main" class="container-fluid">
    <div class="row mt-5 d-flex flex-column border rounded p-2">
        <div class="text-center  mt-2 mb-2 ">
            <h2 class=""> <?= $corp_item['corp_name'] ?></h2>

        </div>
        <div class="info_corp text-center mt-2">
            <div class="row">
                <div class="image_corp" style="min-height: 100px; min-width: 100px;">
                    <div class="image">
                        <img style="max-width: 400px;" src="../html/picture/corps/<?= $corp_item['image'] ?>" alt="corps_img">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="mo_ta border rounded p-2">
                        <h4 class="ps-3 text-start" style="border-left: 3px solid;">Giới thiệu:</h4>
                        <p style="text-align: justify;"><?= $corp_item['description'] ?></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="website border rounded p-2">
                        <h4 class="ps-3 text-start" style="border-left: 3px solid;">Website</h4>
                        <a href="<?php echo $rows['website'] ?>">
                            <p class="text-start"><?= $corp_item['website'] ?></p>
                        </a>
                    </div>
                    <div class="address border rounded p-2">
                        <h4 class="ps-3 text-start" style="border-left: 3px solid;">Address</h4>
                        <p class="text-start"><?= $corp_item['address'] ?></p>
                    </div>

                </div>
            </div>
        </div>
        <div class="info_jobs  mt-2 ">
            <div class="col-md-9">
                <div class="job-listing box-white mt-4 mb-4 " style="border: 1px solid black;">
                    <div class="job-listing mo_ta border rounded p-2 ">
                        <h4 class="ps-3 text-start" style="border-left: 3px solid;">Tuyển dụng</h4>
                    </div>
                    <?php
                    $query1 = "SELECT *, DATEDIFF(deadline, CURRENT_DATE()) AS dead  FROM  (((((((jobs INNER JOIN corporation ON jobs.corp_id = corporation.id_corp) INNER JOIN career ON career.career_id = jobs.career_id) INNER JOIN experience ON experience.exp_id = jobs.exp_id) INNER JOIN province ON province.province_id = jobs.job_id) INNER JOIN level ON level.level_id = jobs.level_id) INNER JOIN way_to_work ON way_to_work.way_to_work_id = jobs.way_to_work_id) INNER JOIN salary ON salary.salary_id = jobs.salary_id)  WHERE corp_id='$id_corp'";
                    $query_run1 = mysqli_query($conn, $query1);
                    if (mysqli_num_rows($query_run1) > 0) {
                        // $GLOBALS['job_item'] = mysqli_fetch_assoc($query_run1);
                        foreach ($query_run1 as $job_item) {
                    ?>
                            <div class="d-flex job-item  bg-highlight  result-job-hover alert-success mt-4 mb-4 " data-job-id="" data-job-position="2" data-box="BoxRecruitmentInCompany" style="border: 1px solid green;">
                                <div class="flex-shrink-0 avatar align-middle">
                                    <a target="" href="#" class="company-logo">
                                        <img src="../html/picture/corps/<?= $corp_item['image'] ?>" title="<?= $job_item['job_name'] ?>" class="img-responsive cover-img ">
                                    </a>
                                </div>
                                <div class="body flex-grow-1 ms-3">
                                    <div class="content">
                                        <div class="ml-auto">
                                            <h2 class="title">
                                                <a target="_blank" class="underline-box-job" href="../html/job_detail.php?job_id=<?= $job_item['job_id'] ?>">
                                                    <span class="bold transform-job-title text-dark d-inline-block" data-toggle="tooltip" title="" data-placement="top" data-container="body" data-original-title="<?= $job_item['job_name'] ?>"><?= $job_item['job_name'] ?></span>
                                                </a>
                                            </h2>
                                            <p class="company underline-box-job ">
                                                <a class="text-secondary " href="corp_details.php?id_corp=<?= $id_corp ?>" data-toggle="tooltip" title="" data-placement="top" data-container="body" target="_blank" data-original-title="<?= $corp_item['corp_name'] ?>"><?= $corp_item['corp_name'] ?></a>
                                            </p>
                                        </div>

                                    </div>
                                    <div class="d-flex">
                                        <div class="label-content ml-auto">
                                            <label class="address alert-dark p-1" data-toggle="tooltip" data-html="true" title="<?= $job_item['province_name'] ?>" data-placement="top" data-container="body" data-original-title="<p style='text-align: left'><?= $job_item['province_name'] ?></p>"><?= $job_item['province_name'] ?></label>
                                            <label class="salary_name alert-dark p-1" data-toggle="tooltip" data-html="true" title="<?= $job_item['salary_name'] ?>" data-placement="top" data-container="body" data-original-title="<p style='text-align: left'><?= $job_item['salary_name'] ?></p>"><?= $job_item['salary_name'] ?></label>
                                        </div>
                                        <!-- <div class="icon mr-auto">
                                        <a href="javascript:showLoginPopup(null, 'Đăng nhập hoặc Đăng ký để lưu tin tuyển dụng')" class="save" data-toggle="tooltip" title="" data-original-title="Bạn phải đăng nhập để lưu tin"><i class="fa-light fa-heart"></i></a>
                                    </div>  -->
                                    </div>
                                </div>
                                <div class="mr-auto text-right">
                                    <p class="deadline ">
                                        Còn <strong><?= $job_item['dead'] ?></strong> ngày để ứng tuyển
                                    </p>
                                </div>
                            </div>
                    <?php
                        }
                    } ?>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include('../includes/footer.php') ?>