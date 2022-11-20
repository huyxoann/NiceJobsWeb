<?php
require_once('../html/modules/connection.php');
if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);
    $row = mysqli_fetch_assoc($result);

    if ($row['role'] == 0) { ?>
        <button type="button" class="btn btn-outline-primary me-2"><a href="../html/vieclam.php" style="color: #2A5DDE;">Tìm việc ngay!</a></button>
    <?php } elseif ($row['role'] == 1) { ?>
        <button type="button" class="btn btn-primary me-2 dangTuyen"><a href="../html/login_signup_employer.php" style="color: #f9f9f9; ">Đăng tuyển và tìm nhân sự</a></button>
<?php } else {
    }
} else {
    echo '';
} ?>