<?php
require('../modules/connection.php');
?>
<!DOCTYPE html>
<html lang="en, vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ | Nice Job</title>
    <link rel="stylesheet" href="../CSS/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/stylechung.css">
    <link rel="stylesheet" href="../css/vieclam.css">
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
                <?php require_once('../modules/import_career.php'); ?>
            </select>
            <select class="form-control select">
                <option value="0">Cấp bậc</option>
                <?php require_once('../modules/import_level.php') ?>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control select">
                <option value="0">Lĩnh vực công ty</option>
                <?php require_once('../modules/import_field.php') ?>
            </select>
            <select class="form-control select">
                <option value="0">Hình thức làm việc</option>
                <?php require_once('../modules/import_way_to_work.php') ?>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control select">
                <option value="0">Địa điểm</option>
                <?php require_once('../modules/import_province.php') ?>
            </select>
            <select class="form-control select">
                <option value="">Mức lương</option>
                <?php require_once('../modules/import_salary.php') ?>
            </select>
        </div>
        <div class="search-button">
            <button type="button " class="btn btn-primary me-2">Tìm kiếm</button>
        </div>
    </div>

</div>

<div class="ad-carousel container">
    <h4>Tìm việc làm nhanh 24h, việc làm mới nhất trên toàn quốc</h4>
    <p>Tiếp cận 30,000+ tin tuyển dụng việc làm mới mỗi ngày từ hàng nghìn doanh nghiệp uy tín tại Việt Nam</p>
    <div class="quang-cao">
        <a href="">
            <img src="../Images/Banner-1100x220.png" alt="" id="ads-1">
        </a>
    </div>
</div>
<div class="tin-tuyen-dung container">
    <div class="title-ttd">
        <h3>Tin tuyển dụng, việc làm hot</h3>
    </div>
    <div class="list-cong-viec">
        <div class="row">
            <div class="jobs_item">
                <div class="logo-company">
                    <img src="../Images/logo1.png" alt="logo1">
                </div>
                <div class="info-company">
                    <h5 class="name-job">
                        Nhân Viên Kinh Doanh/Tư Vấn(Sales Executive)</h5>
                    <p class="name-company">
                        CÔNG TY TNHH MTV DAT BIKE VIETNAM</p>
                </div>
            </div>
            <div class="jobs_item">
                <div class="logo-company">
                    <img src="../Images/logo2.png" alt="logo2">
                </div>
                <div class="info-company">
                    <h5 class="name-job">

                        Chuyên Viên Tư Vấn Tài Chính Doanh Nghiệp</h5>
                    <p class="name-company">
                        Công ty cổ phần chứng khoán FPT</p>
                </div>
            </div>
            <div class="jobs_item">
                <div class="logo-company">
                    <img src="../Images/logo3.png" alt="logo1">
                </div>
                <div class="info-company">
                    <h5 class="name-job">
                        Nhân Viên Tư Vấn Chăm Sóc Khách Hàng</h5>
                    <p class="name-company">
                        Công ty Cổ phần Lychee</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="jobs_item">
                <div class="logo-company">
                    <img src="../Images/logo4.png" alt="logo1">
                </div>
                <div class="info-company">
                    <h5 class="name-job">
                        Kỹ Thuật Viên Spa - HCM/HN - Đi Làm Ngay</h5>
                    <p class="name-company">
                        Công ty TNHH Lavender Sài Gòn</p>
                </div>
            </div>
            <div class="jobs_item">
                <div class="logo-company">
                    <img src="../Images/logo5.png" alt="logo1">
                </div>
                <div class="info-company">
                    <h5 class="name-job">
                        Quản Lý Phụ Trách Phòng Kế Toán</h5>
                    <p class="name-company">
                        Công ty Cổ phần Thương mại Địa ốc An Phúc</p>
                </div>
            </div>
            <div class="jobs_item">
                <div class="logo-company">
                    <img src="../Images/logo6.png" alt="logo1">
                </div>
                <div class="info-company">
                    <h5 class="name-job">
                        Nhân Viên Vận Hành Đơn Hàng Online</h5>
                    <p class="name-company">
                        CÔNG TY CỔ PHẦN ĐẦU TƯ VÀ THƯƠNG MẠI TNG</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="jobs_item">
                <div class="logo-company">
                    <img src="../Images/logo7.png" alt="logo1">
                </div>
                <div class="info-company">
                    <h5 class="name-job">
                        Chuyên Viên Tư Vấn Tài Chính</h5>
                    <p class="name-company">
                        CÔNG TY TNHH BẢO HIỂM HANWHALIFE VIỆT NAM</p>
                </div>
            </div>
            <div class="jobs_item">
                <div class="logo-company">
                    <img src="../Images/logo8.png" alt="logo1">
                </div>
                <div class="info-company">
                    <h5 class="name-job">
                        Nhân Viên Tư Vấn Chăm Sóc Khách Hàng (9 - 15 Triệu)</h5>
                    <p class="name-company">
                        CÔNG TY CỔ PHẦN DƯỢC MỸ PHẨM QUỐC TẾ ÂU CƠ</p>
                </div>
            </div>
            <div class="jobs_item">
                <div class="logo-company">
                    <img src="../Images/logo9.png" alt="logo1">
                </div>
                <div class="info-company">
                    <h5 class="name-job">
                        Chuyên Viên Hỗ Trợ Tín Dụng</h5>
                    <p class="name-company">
                        Công ty Cho thuê tài chính TNHH MTV Quốc tế Chailease</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="jobs_item">
                <div class="logo-company">
                    <img src="../Images/logo10.png" alt="logo1">
                </div>
                <div class="info-company">
                    <h5 class="name-job">
                        Nhân Viên Kinh Doanh Không Cần Kinh Nghiệm - Lương Cơ Bản 5Tr/Tháng + Hoa Hồng Cao Nhất Thị Trường (150 Triệu -> 250 Triệu/1 Sản Phẩm)</h5>
                    <p class="name-company">
                        CÔNG TY TNHH BẤT ĐỘNG SẢN QUEEN SEA</p>
                </div>
            </div>
            <div class="jobs_item">
                <div class="logo-company">
                    <img src="../Images/logo11.png" alt="logo1">
                </div>
                <div class="info-company">
                    <h5 class="name-job">
                        Trưởng Nhóm Kinh Doanh Online - Sales Online Team Leader</h5>
                    <p class="name-company">
                        Công ty TNHH Đầu Tư Thương Mại & Xuất Nhập Khẩu Phan Nguyễn</p>
                </div>
            </div>
            <div class="jobs_item">
                <div class="logo-company">
                    <img src="../Images/logo12.png" alt="logo1">
                </div>
                <div class="info-company">
                    <h5 class="name-job">
                        Trưởng Nhóm Kinh Doanh (Lương 12 - 17 Triệu + Thưởng)</h5>
                    <p class="name-company">
                        CÔNG TY CỔ PHẦN TẬP ĐOÀN THÀNH HƯNG</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/footer.php') ?>