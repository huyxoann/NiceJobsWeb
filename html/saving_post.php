<?php
require_once('../html/modules/connection.php');
if (isset($_COOKIE['username'])) {
    $user_id = $_COOKIE['id_user'];

    $query_get_job = "SELECT * FROM (((((((jobs INNER JOIN corporation ON jobs.corp_id = corporation.id_corp) INNER JOIN career ON career.career_id = jobs.career_id) INNER JOIN experience ON experience.exp_id = jobs.exp_id) INNER JOIN province ON province.province_id = jobs.job_id) INNER JOIN level ON level.level_id = jobs.level_id) INNER JOIN way_to_work ON way_to_work.way_to_work_id = jobs.way_to_work_id) INNER JOIN salary ON salary.salary_id = jobs.salary_id)INNER JOIN save ON jobs.job_id = save.job_id WHERE DATEDIFF(deadline, CURRENT_DATE()) > 0 AND save.employee_id = '$user_id' ORDER BY created_at DESC";
    $result_query_get_job = mysqli_query($conn, $query_get_job);
} else {
    header("Location: page404.php");
}
if (isset($_POST['add'])) {

    $job_id = isset($_POST['job_id']) ? $_POST['job_id'] : '';
    $user_id = $_COOKIE['id_user'];
    if ($_POST['state'] == 0) {
        $query_save_post = "INSERT INTO save (job_id, employee_id) VALUES ('$job_id','$user_id')";
        if ($conn->query($query_save_post)) {
        }
    } elseif ($_POST['state'] == 1) {
        $query_remove_save_post = "DELETE FROM save WHERE job_id = '$job_id' AND employee_id = '$user_id'";
        if ($conn->query($query_remove_save_post)) {
        }
    }
    header("Location: ../html/job_detail.php?job_id=$job_id");
}
if (isset($_POST['add2'])) {

    $job_id = isset($_POST['job_id']) ? $_POST['job_id'] : '';
    $user_id = $_COOKIE['id_user'];
    if ($_POST['state'] == 0) {
        $query_save_post = "INSERT INTO save (job_id, employee_id) VALUES ('$job_id','$user_id')";
        if ($conn->query($query_save_post)) {
        }
    } elseif ($_POST['state'] == 1) {
        $query_remove_save_post = "DELETE FROM save WHERE job_id = '$job_id' AND employee_id = '$user_id'";
        if ($conn->query($query_remove_save_post)) {
        }
    }
    header("Location: ../html/saving_post.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đã lưu - Nice Job</title>
    <link rel="stylesheet" href="../CSS/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/stylechung.css">
    <script src="../css/bootstrap.bundle.min.js"></script>
    <script src="../css/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include_once('../includes/header.php'); ?>
    <div class="container">
        <div>
            <h3 class="">Tin đã lưu</h3>
        </div>

        <div class="saved_list">
            <?php
            if (mysqli_num_rows($result_query_get_job) > 0) {
                while ($data_jobs = mysqli_fetch_assoc($result_query_get_job)) { ?>
                    <div class="jobs_item border rounded p-2 d-flex">
                        <div class="logo-company col-md-3">
                            <a href="../html/corp_details.php?id_corp=<?= $data_jobs['corp_id'] ?>">
                                <img src="../html/picture/corps/<?= $data_jobs['image'] ?>" alt="logo1">
                            </a>
                        </div>
                        <div class="info-company col-md-6">
                            <a href="../html/job_detail.php?job_id=<?= $data_jobs['job_id'] ?>">
                                <h4 class="name-job text-truncate">
                                    <?php echo $data_jobs['job_name'] ?>
                                </h4>
                            </a>
                            <a href="../html/corp_details.php?id_corp=<?= $data_jobs['corp_id'] ?>">
                                <small class="name-company text-truncate">
                                    <?php echo $data_jobs['corp_name'] ?>
                                </small>
                            </a>
                            <div class="tag_info">
                                <p class="d-inline-block p-1 border rounded" style="background-color: #abc2ff;"><?= $data_jobs['salary_name'] ?></p>
                                <p class="d-inline-block p-1" style="background-color: #abc2ff;"><?= $data_jobs['province_name'] ?></p>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex flex-column">
                            <div class="">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyJob">
                                    <ion-icon name="mail" class="me-3"></ion-icon>Ứng tuyển ngay
                                </button>
                            </div>
                            <?php
                            $job_id = $data_jobs['job_id'];
                            $query_check_save = "SELECT * FROM save WHERE employee_id = '$user_id' AND job_id = '$job_id'";
                            if (mysqli_num_rows(mysqli_query($conn, $query_check_save)) != 0) { ?>
                                <div class="mt-3">
                                    <form action="../html/saving_post.php" method="post">
                                        <input type="text" name="job_id" value="<?= $job_id ?>" style="display: none;">
                                        <input type="text" name="state" value="1" style="display: none;">
                                        <button class="btn btn-secondary" style="min-width: 147.08px;" type="submit" name="add2">
                                            <ion-icon name="heart" class="me-3"></ion-icon>Đã lưu
                                        </button>
                                    </form>
                                </div>
                            <?php } else { ?>
                                <div class="mt-3">
                                    <form action="../html/saving_post.php" method="post">
                                        <input type="text" name="job_id" value="<?= $job_id ?>" style="display: none;">
                                        <input type="text" name="state" value="0" style="display: none;">
                                        <button class="btn btn-outline-secondary" style="min-width: 147.08px;" type="submit" name="add2">
                                            <ion-icon name="heart" class="me-3"></ion-icon>Lưu tin
                                        </button>
                                    </form>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                <?php }
            } else { ?>

                <div class="alert alert-warning" role="alert">
                    Chưa có công việc nào được lưu!
                </div>
            <?php }
            ?>
            <div>

            </div>
        </div>
    </div>
    <?php include_once('../includes/footer.php'); ?>
</body>

</html>