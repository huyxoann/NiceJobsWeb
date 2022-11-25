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
<div id="main">

    <div class="container">
        <div class="cover-wrapper">
            <img src="../html/picture/corps/<?= $corp_item['image'] ?>" class="img-responsive cover-img">
        </div>
        <div class="company-detail-overview">
            <!-- <div id="company-logo">
                        <div class="company-image-logo">
                            <img src="../images/corps/<?= $corp_item['image'] ?>" class="img-responsive">
                        </div>
                    </div> -->
            <div class="company-info">
                <h1 class="company-detail-name text-highlight"><?= $corp_item['corp_name'] ?></h1>
                <div class="d-flex">
                    <p class="website">
                        <i class="fa-light fa-earth-americas"></i>
                        <a href="<?= $corp_item['website'] ?>" target="_blank"><?= $corp_item['website'] ?></a>
                    </p>
                </div>
            </div>
            <div class="box-follow">
                <a href="javascript:showLoginPopup(null, null);" class="btn btn-follow btn-primary-hover">Theo dõi công ty</a>
            </div>
        </div>
    </div>

    <div class="detail">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="company-info box-white">
                        <h4 class="title">Corporation Description </h4>
                        <div class="box-body">
                            <?= $corp_item['description'] ?>
                        </div>
                    </div>
                    <div class="job-listing box-white">
                        <h4 class="title">Tuyển dụng</h4>
                        <div class="box-body">
                            <div class="job-item  job-ta result-job-hover" data-job-id="468305" data-job-position="1" data-box="BoxRecruitmentInCompany">
                                <div class="avatar">
                                    <a target="_blank" href="../images/corps/<?= $corp_item['image'] ?>" class="company-logo">
                                        <img src="../images/corps/<?= $corp_item['image'] ?>" class="w-100" alt="" title="Database Administrator - Hà Nội Ta141">
                                    </a>
                                </div>
                                <div class="body">
                                    <div class="content">
                                        <div class="ml-auto">
                                            <h3 class="title">
                                                <a target="_blank" class="underline-box-job" href="../images/corps/<?= $corp_item['image'] ?>">
                                                    <span class="bold transform-job-title" data-toggle="tooltip" title="" data-placement="top" data-container="body" data-original-title="Database Administrator - Hà Nội Ta141">Database Administrator - Hà Nội Ta141</span>
                                                    <span class="icon-verified-employer level-five">
                                                        <i class="fa-solid fa-circle-check" data-toggle="tooltip" data-html="true" title="" data-placement="top" data-original-title="
  <b>Nhà tuyển dụng</b><span> đã được xác thực:</span><br>
  <span><i class='fa-solid fa-circle-check color-green'></i> Đã xác thực email tên miền công ty</span><br>
  <span><i class='fa-solid fa-circle-check color-green'></i> Đã xác thực số điện thoại</span><br>
  <span><i class='fa-solid fa-circle-check color-green'></i> Đã được duyệt Giấy phép kinh doanh</span><br>
  <span><i class='fa-solid fa-circle-check color-green'></i> Tài khoản NTD được tạo tối thiểu 6 tháng</span><br>
  <span><i class='fa-solid fa-circle-check color-green'></i> Chưa có lịch sử bị báo cáo tin đăng</span><br>"></i></span>
                                                </a>
                                            </h3>
                                            <p class="company underline-box-job">
                                                <a href="#" data-toggle="tooltip" title="" data-placement="top" data-container="body" target="_blank" data-original-title="Ngân Hàng TMCP Việt Nam Thịnh Vượng (VPBank)">Ngân Hàng TMCP Việt Nam Thịnh Vượng (VPBank)</a>
                                            </p>
                                        </div>
                                        <div class="mr-auto text-right">
                                            <p class="deadline">
                                                Còn <strong>68</strong> ngày để ứng tuyển
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="label-content ml-auto">
                                            <label class="salary">Thoả thuận</label>
                                            <label class="address" data-toggle="tooltip" data-html="true" title="" data-placement="top" data-container="body" data-original-title="<p style='text-align: left'>Hà Nội</p>">Hà Nội</label>
                                            <label class="time">3 ngày trước</label>
                                        </div>
                                        <div class="icon mr-auto">
                                            <a href="javascript:showLoginPopup(null, 'Đăng nhập hoặc Đăng ký để lưu tin tuyển dụng')" class="save" data-toggle="tooltip" title="" data-original-title="Bạn phải đăng nhập để lưu tin"><i class="fa-light fa-heart"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-us-content ">
                <div class="title-about-us ">
                    Về Chúng tôi - NICE JOB
                </div>
                <div class="description-about-us ">
                    Chào mừng đã đến với NiceJob - Nền tảng tuyển dụng số hàng đầu Việt Nam. Website cung cấp một nền tảng tuyển dụng số mới nhất hiện nay. Cung cấp cho người dùng khả năng tìm kiếm công việc nhanh chóng, đầy đủ mọi ngành nghề, thiết kế CV, giao diện đẹp,
                    dễ sử dụng. Tìm hiểm thêm về chúng tôi ở đường dẫn bên dưới.
                </div>
                <div class="button-about-us ">
                    <button type="button" class="btn btn-primary me-2 "><a href="../html/thongtinweb.php" style="color: #f9f9f9;">Tìm hiểu thêm...</a></button>
                </div>
            </div>
        </div>
        <?php include('../includes/footer.php') ?>