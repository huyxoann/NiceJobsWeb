<body>
    <div class="shadow-sm rounded header-content mb-1">
        <div class="col-mb-3 mt-2 ps-4 col-sm" id="logo">
            <a href="file:///D:/DoAnCoSo/HTML/trangChu.html" class="">
                <img src="../Images/logoedited.png " alt="logo ">
            </a>
        </div>
        <div class="col-md-7 mt-3 col-sm" id="menu">
            <ul class="nav">
                <li class="nav-item ">
                    <a href="file:///D:/DoAnCoSo/HTML/thongtinweb.html" class="nav-link ">Về chúng tôi</a>
                </li>
                <li class="nav-item ">
                    <a href="file:///D:/DoAnCoSo/HTML/vieclam.html" class="nav-link ">Việc làm</a>
                </li>
                <li class="nav-item" id="menu-cty">
                    <a href="#" class="nav-link ">Công ty</a>
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="file:///D:/DoAnCoSo/HTML/danh-sach-cac-cong-ty.html" class="nav-link">Danh sách công ty</a>
                        </li>
                        <li class="nav-item">
                            <a href="file:///D:/DoAnCoSo/HTML/top-cong-ty.html" class="nav-link">Top công ty</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item ">
                    <a href="file:///D:/DoAnCoSo/HTML/mau-cv.html" class="nav-link ">Hồ Sơ CV</a>
                </li>

            </ul>
        </div>
        <?php if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) { ?>
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" type="button">
                    <?= $_COOKIE['username']; ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="./sign_out.php">Logout</a></li>
                </ul>
            </div>
        <?php } else {
        ?>
            <div class="col-md-2 mt-3 justify-content-end button-header">
                <button type="button" class="btn btn-outline-primary me-2"><a href="file:///D:/DoAnCoSo/HTML/sign-up.html" style="color: #2A5DDE;">Đăng ký</a></button>
                <button type="button" class="btn btn-primary me-2 "><a href="file:///D:/DoAnCoSo/HTML/login.html" style="color: #f9f9f9;">Đăng nhập</a></button>
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
            <li><a href="file:///D:/DoAnCoSo/HTML/thongtinweb.html">Về chúng tôi</a></li>
            <li><a href="file:///D:/DoAnCoSo/HTML/vieclam.html">Việc làm</a></li>
            <li><a href="file:///D:/DoAnCoSo/HTML/danh-sach-cac-cong-ty.html">Danh sách công ty</a></li>
            <li><a href="file:///D:/DoAnCoSo/HTML/top-cong-ty.html">Top công ty</a></li>
            <li><a href="file:///D:/DoAnCoSo/HTML/mau-cv.html">Hồ sơ CV</a></li>
        </ul>

        <button type="button" class="btn btn-primary me-2 buttonHiden"><a href="/html/sign_up.php" style="color: #f9f9f9;">Đăng ký</a></button>
        <br>
        <button type="button" class="btn btn-primary me-2 buttonHiden"><a href="/html/login.php" style="color: #f9f9f9;">Đăng nhập</a></button>
    </div>