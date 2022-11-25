<?php
require_once('../html/modules/connection.php');
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];
    $query_get_job_data = "SELECT * FROM (((((((jobs INNER JOIN corporation ON jobs.corp_id = corporation.id_corp) INNER JOIN career ON career.career_id = jobs.career_id) INNER JOIN experience ON experience.exp_id = jobs.exp_id) INNER JOIN province ON province.province_id = jobs.job_id) INNER JOIN level ON level.level_id = jobs.level_id) INNER JOIN way_to_work ON way_to_work.way_to_work_id = jobs.way_to_work_id) INNER JOIN salary ON salary.salary_id = jobs.salary_id) WHERE job_id = $job_id";
    $result = $conn->query($query_get_job_data);
    if (mysqli_num_rows($result) > 0) {
        $GLOBALS['rows'] = mysqli_fetch_assoc($result);
    }
} else {
    header("Location: ../html/page_404.php");
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
        <div class="row jobs_item m-3 border border-start-5 pt-3">
            <div class="col-md-9 jobs_item_element">
                <div class="col-md-2">
                    <a href="<?php echo '../html/cong_ty_detail.php?corp_id=' . $rows['corp-id'] ?>">
                        <img src="<?php echo '../images/corps/' . $rows['image'] ?>" alt="img" style="max-width: 100px; max-height: 100px; min-width: 100px; min-height: 100px;">
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
                            Hạn nộp:
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 d-flex flex-column">
                <div class="">
                    <button class="btn btn-primary">
                        <ion-icon name="mail" class="me-3"></ion-icon>Ứng tuyển ngay
                    </button>
                </div>
                <div class="mt-3">
                    <button class="btn btn-outline-secondary" style="min-width: 147.08px;">
                        <ion-icon name="heart" class="me-3"></ion-icon>Lưu tin
                    </button>
                </div>
            </div>
        </div>
        <div class="row border border-start-5">
            <div class="">
                <h3>Chi tiết tuyển dụng</h3>
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
                                <p><?php if ($rows['gender'] == 0) {
                                        echo "Nam";
                                    } elseif ($rows['gender'] == 1) {
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
            <div class="job_detail">
                <h4><u>Mô tả: </u></h4>
                <p><?php echo $rows['job_description'] ?></p>
            </div>
        </div>


    </div>
    <?php require('../includes/footer.php') ?>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>