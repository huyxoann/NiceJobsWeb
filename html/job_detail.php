<?php
require_once('../html/modules/connection.php');
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $query_get_job_data = "SELECT * FROM (((((((jobs INNER JOIN corporation ON jobs.corp_id = corporation.id_corp) INNER JOIN career ON career.career_id = jobs.career_id) INNER JOIN experience ON experience.exp_id = jobs.exp_id) INNER JOIN province ON province.province_id = jobs.job_id) INNER JOIN level ON level.level_id = jobs.level_id) INNER JOIN way_to_work ON way_to_work.way_to_work_id = jobs.way_to_work_id) INNER JOIN salary ON salary.salary_id = jobs.salary_id) WHERE job_id = $job_id";
    $result = $conn->query($query_get_job_data);
    $employee_id = isset($_COOKIE['id_user']) ? $_COOKIE['id_user'] : '';
    $query_get_cv_exist = "SELECT employee_id, job_id FROM application WHERE employee_id = '$employee_id' AND job_id = '$job_id'";
    if (mysqli_num_rows($result) > 0) {
        $GLOBALS['rows'] = mysqli_fetch_assoc($result);
    }
} else {
    header("Location: ../html/page_404.php");
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
    <title><?php echo $rows['job_name'] ?></title>
    <link rel="stylesheet" href="../CSS/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/stylechung.css">
    <link rel="stylesheet" href="../css/post_recruit.css">
    <script src="../css/bootstrap.bundle.min.js"></script>
    <script src="../css/jquery-3.6.0.min.js"></script>

</head>

<body>
    <?php require('../includes/header.php') ?>
    <div class="content container">
        <div class="row"></div>
        <div class="row jobs_item m-3 border border-start-5 pt-3 rounded">
            <div class="col-md-9 jobs_item_element">
                <div class="col-md-2">
                    <a href="<?php echo '../html/cong_ty_detail.php?corp_id=' . $rows['corp-id'] ?>">
                        <img src="<?php echo '../html/picture/corps/' . $rows['image'] ?>" alt="img" style="max-width: 100px; max-height: 100px; min-width: 100px; min-height: 100px;">
                    </a>
                </div>
                <div class="col-md-10">
                    <div class="title_text">
                        <h4><?php echo $rows['job_name'] ?></h4>
                    </div>
                    <div class="title_text">
                        <h4><?php echo $rows['corp_name'] ?></h4>
                    </div>
                    <div>
                        <p>
                            <ion-icon name="time"></ion-icon>
                            Hạn nộp: <?php date_formatting($rows['deadline']) ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex flex-column">
                <div class="">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyJob">
                        <ion-icon name="mail" class="me-3"></ion-icon>Ứng tuyển ngay
                    </button>
                </div>
                <?php
                $query_check_save = "SELECT * FROM save WHERE employee_id = '$employee_id' AND job_id = '$job_id'";
                if (mysqli_num_rows(mysqli_query($conn, $query_check_save)) != 0) { ?>
                    <div class="mt-3">
                        <form action="../html/saving_post.php" method="post">
                            <input type="text" name="job_id" value="<?= $rows['job_id'] ?>" style="display: none;">
                            <input type="text" name="state" value="1" style="display: none;">
                            <button class="btn btn-secondary" style="min-width: 147.08px;" type="submit" name="add">
                                <ion-icon name="heart" class="me-3"></ion-icon>Đã lưu
                            </button>
                        </form>
                    </div>
                <?php } else { ?>
                    <div class="mt-3">
                        <form action="../html/saving_post.php" method="post">
                            <input type="text" name="job_id" value="<?= $rows['job_id'] ?>" style="display: none;">
                            <input type="text" name="state" value="0" style="display: none;">
                            <button class="btn btn-outline-secondary" style="min-width: 147.08px;" type="submit" name="add">
                                <ion-icon name="heart" class="me-3"></ion-icon>Lưu tin
                            </button>
                        </form>
                    </div>
                <?php }
                ?>

                <!-- <div class="">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyJob" disabled>
                        <ion-icon name="mail" class="me-3"></ion-icon>Ứng tuyển ngay
                    </button>
                </div>
                <div class="mt-3">
                    <button class="btn btn-outline-secondary" style="min-width: 147.08px;" disabled>
                        <ion-icon name="heart" class="me-3"></ion-icon>Lưu tin
                    </button>
                </div> -->

            </div>
        </div>
        <div class="row border border-start-5 rounded">
            <div class="">
                <h3 class="mt-3">Chi tiết tuyển dụng</h3>
            </div>
            <div class="detail_box p-3 d-flex flex-column">
                <h4><u>Thông tin chung:</u></h4>
                <table>
                    <tr>
                        <td>
                            <div class="salary">
                                <b>
                                    <ion-icon name="cash-outline"></ion-icon>Mức lương
                                </b>
                                <p><?php echo $rows['salary_name'] ?></p>
                            </div>
                        </td>
                        <td>
                            <div class="num_of_recruit">
                                <b>
                                    <ion-icon name="people-outline"></ion-icon>Số lượng tuyển
                                </b>
                                <p><?php echo $rows['num_of_recruit'] ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <div class="way_to_work">
                                <b>
                                    <ion-icon name="briefcase-outline"></ion-icon>Hình thức làm việc
                                </b>
                                <p><?php echo $rows['way_to_work_name'] ?></p>
                            </div>
                        </td>

                        <td>
                            <div class="level">
                                <b>
                                    <ion-icon name="medal-outline"></ion-icon>Cấp bậc
                                </b>
                                <p><?php echo $rows['level_name'] ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="">
                            <div class="gender">
                                <b>
                                    <ion-icon name="transgender-outline"></ion-icon>Giới tính
                                </b>
                                <p><?php if ($rows['gender_job'] == 0) {
                                        echo "Nam";
                                    } elseif ($rows['gender_job'] == 1) {
                                        echo "Nữ";
                                    } else {
                                        echo "Không yêu cầu";
                                    } ?></p>
                            </div>
                        </td>
                        <td>
                            <div class="epx">
                                <b>
                                    <ion-icon name="hourglass-outline"></ion-icon>Kinh nghiệm
                                </b>
                                <p><?php echo $rows['exp_name'] ?></p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="address">
                <h4><u>Địa chỉ làm việc:</u></h4>
                <p><?php echo $rows['work_address'] ?></p>
            </div>
            <div class="job_detail" style="text-align: justify;">
                <h4><u>Mô tả: </u></h4>
                <p><?php echo $rows['job_description'] ?></p>
            </div>
        </div>
        <div class="row border border-start-5">
            <div class="cach_thuc_tuyen">
                <h3>Cách ứng tuyển</h3>
            </div>
            <div class="button pb-3">
                <p>Ứng viên nộp hồ sơ bằng cách nhấn vào nút "Ứng tuyển ngay"</p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#applyJob">
                    <ion-icon name="mail" class="me-3"></ion-icon>Ứng tuyển ngay
                </button>
                <button class="btn btn-outline-secondary" style="min-width: 147.08px;">
                    <ion-icon name="heart" class="me-3"></ion-icon>Lưu tin
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Apply Job -->
    <div class="modal fade" id="applyJob" tabindex="-1" aria-labelledby="applyJobLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <?php if (mysqli_num_rows(mysqli_query($conn, $query_get_cv_exist)) > 0) { ?>
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h4 class="text-danger">Bạn đã nộp cv cho công việc này rồi!</h4>
                        <p>Bạn có thể tìm các công việc khác tại <a href="../html/vieclam.php">ĐÂY</a></p>
                    </div>

                <?php } elseif (isset($_COOKIE['username']) && isset($_COOKIE['password']) && isset($_COOKIE['role']) && $_COOKIE['role'] == 0) { ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="applyJobLabel">Ứng tuyển
                            <a href="../html/job_detail.php?job_id=<?= $rows['job_id'] ?>">
                                <?= $rows['job_name'] ?>
                            </a>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../html/modules/send_application.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <h4>Chọn hồ sơ để gửi: </h4>
                            <?php
                            $id_user = $_COOKIE['id_user'];
                            $query_get_cv = "SELECT * FROM cv INNER JOIN career ON career.career_id = cv.career_id WHERE id_user = '$id_user'";
                            $result_query_get_cv = $conn->query($query_get_cv);
                            if (mysqli_num_rows($result_query_get_cv) > 0) {
                                while ($cv_data = mysqli_fetch_assoc($result_query_get_cv)) { ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cv_selected" id="flexRadioDefault1" value="<?= $cv_data['cv_id'] ?>" required>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <?= $cv_data['cv_name'] . ' (' . $cv_data['career_name'] . ')' ?>
                                        </label>
                                    </div>
                                <?php }
                            } else { ?>
                                <div class="alert-secondary">
                                    Không có CV nào được tạo. Vui lòng tạo để sử dụng.
                                </div>
                            <?php }
                            ?>
                            <h4>Viết mô tả giới thiệu bản thân: </h4>
                            <textarea name="introduce" id="introduce" cols="30" rows="10" class="form-control" required></textarea>
                            <input type="text" name="job_id" id="job_id" class="form-control" value="<?= $rows['job_id'] ?>" style="display: none;">
                            <input type="text" name="pre_href" id="pre_href" class="form-control" value="<?= $pre_href ?>" style="display: none;">

                            <div class="note">
                                <h4>Lưu ý</h4>
                                <p>1. Ứng viên nên lựa chọn ứng tuyển bằng CV Online & viết thêm mong muốn tại phần thư giới thiệu để được Nhà tuyển dụng xem CV sớm hơn.</p>
                                <p>2. Để có trải nghiệm tốt nhất, bạn nên sử dụng các trình duyệt phổ biến như Google Chrome hoặc Firefox.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <input type="submit" class="btn btn-primary" name="apply" value="Ứng tuyển">
                        </div>
                    </form>
                <?php } else { ?>
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <h4 class="text-danger">Vui lòng đăng nhập trước khi thực hiện ứng tuyển.</h4>
                        <small>Note: Chỉ tài khoản người ứng tuyển mới thực hiện hành động này!</small>
                        <p>Click vào <a href="../html/sign_out.php">ĐÂY</a> để nhập với tư cách người ứng tuyển.</p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php require('../includes/footer.php') ?>

</body>

</html>