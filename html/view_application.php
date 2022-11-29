<?php
require('../html/modules/connection.php');
if (isset($_COOKIE['role']) && $_COOKIE['role'] == 0) {
    header('../html/page_404.php');
} else {
    if (isset($_GET['job_id'])) {
        $job_id = $_GET['job_id'];
        $query_application = "SELECT * FROM ((((((application INNER JOIN employee ON application.employee_id = employee.id_user) INNER JOIN cv ON cv.cv_id = application.cv_id) INNER JOIN jobs ON jobs.job_id = application.job_id)INNER JOIN users ON application.employee_id = users.id_user) INNER JOIN career ON cv.career_id = career.career_id)INNER JOIN experience ON experience.exp_id = cv.exp_id) WHERE jobs.job_id = '$job_id'";
        $result_query_application = $conn->query($query_application);

        $query_job = "SELECT * FROM ((((jobs INNER JOIN corporation ON jobs.corp_id = corporation.id_corp) INNER JOIN province ON province.province_id = jobs.job_id) INNER JOIN level ON level.level_id = jobs.level_id) INNER JOIN salary ON salary.salary_id = jobs.salary_id) WHERE job_id = $job_id";
        $result_query_job = $conn->query($query_job);

        $job_data = mysqli_fetch_assoc($result_query_job);
    }
}
function date_formatting($date)
{
    $time = strtotime($date);
    $date_formatted = date('d-m-Y', $time);
    echo  $date_formatted;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn xin tuyển | Nice Job</title>
    <link rel="stylesheet" href="../CSS/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/stylechung.css">
    <link rel="stylesheet" href="../css/post_recruit.css">
    <script src="../css/bootstrap.bundle.min.js"></script>
    <script src="../css/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include('../includes/header.php'); ?>
    <div class="container">
        <h3 class="mt-3">Danh sách các đơn xin việc cho "<?= $job_data['job_name'] ?>": </h3>
        <?php if (mysqli_num_rows($result_query_application) == 0) {
            echo '
            <div class="alert alert-warning" role="alert">
                Công việc này chưa được ai nộp hồ sơ!
            </div>
            ';
        } else { ?>
            <div class="row jobs_item m-3 border border-start-5 pt-3 rounded">
                <div class="col-md-12 jobs_item_element d-flex justify-content-between">
                    <div class="col-md-2">
                        <a href="<?php echo '../html/cong_ty_detail.php?corp_id=' . $job_data['corp-id'] ?>">
                            <img src="<?php echo '../html/picture/corps/' . $job_data['image'] ?>" alt="img" style="max-width: 100px; max-height: 100px; min-width: 100px; min-height: 100px;">
                        </a>
                    </div>
                    <div class="col-md-10">
                        <div class="title_text">
                            <h4><?php echo $job_data['job_name'] ?></h4>
                        </div>
                        <div class="title_text">
                            <h4><?php echo $job_data['corp_name'] ?></h4>
                        </div>
                        <div>
                            <p>
                                <ion-icon name="time"></ion-icon>
                                Hạn nộp: <?php date_formatting($job_data['deadline']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <p>Note: Liên hệ các ứng viên theo số điện thoại hoặc email bên dưới!</p>
            </div>
        <?php } ?>
        <?php
        if (mysqli_num_rows($result_query_application) > 0) {
            for ($i = 1; $application_data = mysqli_fetch_assoc($result_query_application); $i++) {
        ?>
                <div class="application_item border rounded p-3 d-flex">
                    <div class="form-control" style="width: 250px; height: 250px;" style="vertical-align: middle;">
                        <img src="../html/picture/users/<?= $application_data['image'] ?>" alt="employee_image" style="max-width: 200px; max-height: 200px;">
                    </div>
                    <div class="detail_info d-flex flex-column form-control">
                        <h3 class="ps-3"> Họ và tên: <?= $application_data['fullname'] ?></h3>
                        <div class="detail_info d-flex ms-3">
                            <div class="d-flex ms-2">
                                <div class="">
                                    <p class="border rounded p-1 text fs-5">Email: <?= $application_data['email'] ?></p>
                                    <p class="border rounded p-1 text fs-5">Ngành nghề: <?= $application_data['career_name'] ?></p>
                                    <p class="border rounded p-1 text fs-5">Số điện thoại: <?= $application_data['phone_number'] ?></p>


                                </div>
                            </div>
                            <div class="ms-2">
                                <p class="border rounded p-1 text fs-5">Giới tính: <?php if ($application_data['gender'] == 0) {
                                                                                        echo "Nam";
                                                                                    } elseif ($application_data['gender'] == 1) {
                                                                                        echo "Nữ";
                                                                                    }
                                                                                    ?></p>
                                <p class="border rounded p-1 text fs-5">Kinh nghiệm: <?= $application_data['exp_name'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="introduce ms-3 form-control d-flex flex-column">
                        <h3>Phần tự giới thiệu: </h3>
                        <p class="form-control"><?= $application_data['introduce'] ?></p>
                        <a href="" type="button" class="align-self-end" data-bs-toggle="modal" data-bs-target="#cvShow" data-cv-name="<?= $application_data['cv_name'] ?>" data-cv-filename="<?= $application_data['file_name'] ?>">Nhấn vào đây để xem cv</a>
                    </div>
                </div>

            <?php }
        } else { ?>
        <?php } ?>
    </div>
    <!-- Modal view cv -->
    <div class="modal fade" id="cvShow" tabindex="-1" aria-labelledby="cvShowLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cvShowLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <embed src="" width="1000px" height="1200px" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#cvShow').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var cv_name = button.data('cv-name') // Extract info from data-* attributes
            var cv_filename = button.data('cv-filename')
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('' + cv_name)
            modal.find('.modal-body embed').attr("src", "../html/pdf/" + cv_filename)
        })
    </script>
    <?php include('../includes/footer.php') ?>


</body>

</html>