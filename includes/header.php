<body>
    <div class="shadow-sm rounded header-content mb-1">
        <div class="col-mb-3 mt-2 ps-4 col-sm" id="logo">
            <a href="../html/trangChu.php" class="">
                <img src="../Images/logoedited.png " alt="logo ">
            </a>
        </div>
        <div class="col-md-7 mt-3 col-sm" id="menu">
            <ul class="nav">
                <li class="nav-item ">
                    <a href="../html/thongtinweb.php" class="nav-link ">Về chúng tôi</a>
                </li>
                <li class="nav-item ">
                    <a href="../html/vieclam.php" class="nav-link ">Việc làm</a>
                </li>
                <li class="nav-item" id="menu-cty">
                    <a href="../html/cong_ty.php" class="nav-link ">Công ty</a>
                </li>
                <li class="nav-item ">
                    <a href="../html/hoso_cv.php" class="nav-link ">Hồ Sơ CV</a>
                </li>

            </ul>
        </div>
        <div class="mt-3 justify-content-end button-header">
            <?php
            require('../html/modules/check_role_by_username.php')
            ?>
        </div>
        <?php if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) { ?>

            <div class="nav-item dropdown mt-3">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" type="button">
                    <?= $_COOKIE['username']; ?>
                </a>
                <?php if ($_COOKIE['role'] == 0) { ?>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="dropdown-item">Mã TK: <?php echo $_COOKIE['id_user'] ?></li>
                        <li><a class="dropdown-item" href="../html/view_my_info.php">Thông tin cá nhân</a></li>
                        <li><a class="dropdown-item" href="../html/hoso_cv.php">Quản lý CV</a></li>
                        <li><a class="dropdown-item" href="#">Xem công việc đã lưu</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="./sign_out.php">Logout</a></li>
                    </ul>
                <?php } elseif ($_COOKIE['role'] == 1) { ?>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="dropdown-item">Mã TK: <?php echo $_COOKIE['id_user'] ?></li>
                        <li><a class="dropdown-item" href="../html/view_my_info.php">Thông tin cá nhân</a></li>
                        <li><a class="dropdown-item" href="../html/post_recruit.php">Bài Đăng</a></li>
                        <!-- <li><a class="dropdown-item" href="#">Xem công việc đã lưu</a></li> -->
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="./sign_out.php">Logout</a></li>
                    </ul>
                <?php } ?>
            </div>
        <?php } else {
        ?>
            <div class="col-md-2 mt-3 justify-content-end button-header">
                <button type="button" class="btn btn-outline-primary me-2"><a href="../html/login_signup_employee.php" style="color: #2A5DDE;">Tìm việc ngay!</a></button>
                <button type="button" class="btn btn-primary me-2 dangTuyen"><a href="../html/login_signup_employer.php" style="color: #f9f9f9; ">Đăng tuyển và tìm nhân sự</a></button>
            </div>
        <?php } ?>
        <div id="menu-hidden">
            <a href="#menuChoose" data-bs-toggle="collapse" aria-controls="menuChoose" role="button">
                <img src="../Images/menu-outline-1.png" alt="menu-outline">
            </a>
        </div>
    </div>
    <div class="collapse" id="menuChoose">
        <ul>
            <li><a href="../html/thongtinweb.php">Về chúng tôi</a></li>
            <li><a href="../html/vieclam.php">Việc làm</a></li>
            <li><a href="../html/cong_ty.php">Công ty</a></li>
            <li><a href="../html/hoso_cv.php">Hồ sơ CV</a></li>
        </ul>

        <button type="button" class="btn btn-primary me-2 buttonHiden"><a href="../html/login_signup_employee.php" style="color: #f9f9f9;">Tìm việc ngay!</a></button>
        <br>
        <br>
        <button type="button" class="btn btn-primary me-2 buttonHiden"><a href="../html/login_signup_employer.php" style="color: #f9f9f9;">Đăng tuyển và tìm nhân sự</a></button>
    </div>
    <div class="cv_check container ">
        <?php
        if (isset($_COOKIE['role']) && $_COOKIE['role'] == 0) {
            require_once("../html/modules/connection.php");

            $id_user = isset($_COOKIE['id_user']) ? $_COOKIE['id_user'] : '';
            $query = "SELECT * FROM cv WHERE id_user = '$id_user' ";
            $result = mysqli_query($conn, $query);

            if (!mysqli_num_rows($result)) {
                echo '
                <div class="alert alert-warning" role="alert">
                Người dùng cần tải lên CV trước khi thực hiện tìm việc! Nhấn vào <a href="https://vieclam24h.vn/cv/danh-sach-cv.html">Đây </a>để tạo.
                Để upload cv, nhấn vào <a href="../html/hoso_cv.php">Đây</a>.
                </div>
                ';
            }
        }
        ?>
    </div>