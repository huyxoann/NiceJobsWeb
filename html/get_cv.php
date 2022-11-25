<?php

require_once('./modules/connection.php');
$id_user = isset($_COOKIE['id_user']) ? $_COOKIE['id_user'] : "";
$get_cv_data_query = "SELECT * FROM (cv INNER JOIN career ON cv.career_id = career.career_id) INNER JOIN experience ON experience.exp_id = cv.exp_id WHERE id_user = '$id_user'";
$result = mysqli_query($conn, $get_cv_data_query);
if (mysqli_num_rows($result) > 0) {
    while ($rows_cv_edit = mysqli_fetch_assoc($result)) {
        $date = $rows_cv_edit['created_at'];
        $file_name = $rows_cv_edit['file_name'];
        $i = 0;
        print_r($rows_cv_edit);
        echo "<br>";
?>


    <?php $i = $i + 1;
    }
} else { ?>
    <div class="alert alert-dark" role="alert">
        Không có CV nào được tạo!
    </div>';
<?php }
?>