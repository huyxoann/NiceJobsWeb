<body>
    <div class="shadow-sm rounded header-content mb-1">
        <div class="col-mb-3 mt-2 ps-4 col-sm" id="logo">
            <a href="../html/trangChu.php" class="">
                <img src="../Images/logoedited.png " alt="logo ">
            </a>
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
                <button type="button" class="btn btn-outline-primary me-2"><a href="../html/sign_up.php" style="color: #2A5DDE;">Đăng ký</a></button>
                <button type="button" class="btn btn-primary me-2 "><a href="../html/login.php" style="color: #f9f9f9;">Đăng nhập</a></button>
            </div>
        <?php } ?>
    </div>