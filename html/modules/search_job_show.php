<?php
require_once('connection.php');
if (isset($_GET['search'])) {
    $search_name = isset($_GET['search_bar']) ? $_GET['search_bar'] : ' ';
    $career = $_GET['career'];
    $level = $_GET['level'];
    $way_to_work = $_GET['way_to_work'];
    $province = $_GET['province'];
    $salary = $_GET['salary'];

    $query_search = "SELECT * FROM (((((((jobs INNER JOIN corporation ON jobs.corp_id = corporation.id_corp) INNER JOIN career ON career.career_id = jobs.career_id) INNER JOIN experience ON experience.exp_id = jobs.exp_id) INNER JOIN province ON province.province_id = jobs.job_id) INNER JOIN level ON level.level_id = jobs.level_id) INNER JOIN way_to_work ON way_to_work.way_to_work_id = jobs.way_to_work_id) INNER JOIN salary ON salary.salary_id = jobs.salary_id) WHERE job_name LIKE '%$search_name%' AND DATEDIFF(deadline, CURRENT_DATE())>0 ORDER BY created_at DESC";
    if ($career != 0) {
        $query_search = $query_search . " AND jobs.career_id = '$career'";
    }
    if ($level != 0) {
        $query_search = $query_search . " AND jobs.level_id = '$level'";
    }
    if ($way_to_work != 0) {
        $query_search = $query_search . " AND jobs.way_to_work_id = '$way_to_work'";
    }
    if ($province != 0) {
        $query_search = $query_search . " AND jobs.province_id = '$province'";
    }
    if ($salary != 0) {
        $query_search = $query_search . " AND jobs.salary_id = '$salary'";
    }
    $result_query_search = $conn->query($query_search); ?>
    <div class="title-ttd row">
        <h3>Kết quả tìm kiếm: </h3>
    </div>
    <?php if (mysqli_num_rows($result_query_search) > 0) {
        while ($data_jobs = mysqli_fetch_assoc($result_query_search)) { ?>
            <div class="row">
                <div class="jobs_item col-md">
                    <div class="logo-company">
                        <a href="../html/corp_details.php?id_corp=<?= $data_jobs['corp_id'] ?>">
                            <img src="../html/picture/corps/<?= $data_jobs['image'] ?>" alt="logo1">
                        </a>
                    </div>
                    <div class="info-company">
                        <a href="../html/job_detail.php?job_id=<?= $data_jobs['job_id'] ?>">
                            <h4 class="name-job text-truncate">
                                <?php echo $data_jobs['job_name'] ?>
                            </h4>
                        </a>
                        <a href="../html/corp_details.php?id_corp=<?= $data_jobs['corp_id'] ?>">
                            <small class="name-company text-truncate">
                                <?php echo $data_jobs['corp_name'] ?>
                            </small>
                        </a>
                        <div class="tag_info">
                            <p class="d-inline-block p-1 border rounded" style="background-color: #abc2ff;"><?= $data_jobs['salary_name'] ?></p>
                            <p class="d-inline-block p-1" style="background-color: #abc2ff;"><?= $data_jobs['province_name'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    } else { ?>
        <div class="alert alert-warning" role="alert">
            Không tìm thấy kết quả nào!
        </div>
    <?php }
} else { ?>
    <div class="title-ttd row">
        <h3>Tin tuyển dụng mới nhất</h3>
    </div>
    <div class="list-cong-viec row">
        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        if ($page == '' || $page == 1) {
            $begin = 0;
        } else {
            $begin = ($page * 12) - 12;
        }

        $query_import_job = "SELECT * FROM (((((((jobs INNER JOIN corporation ON jobs.corp_id = corporation.id_corp) INNER JOIN career ON career.career_id = jobs.career_id) INNER JOIN experience ON experience.exp_id = jobs.exp_id) INNER JOIN province ON province.province_id = jobs.province_id) INNER JOIN level ON level.level_id = jobs.level_id) INNER JOIN way_to_work ON way_to_work.way_to_work_id = jobs.way_to_work_id) INNER JOIN salary ON salary.salary_id = jobs.salary_id) WHERE DATEDIFF(deadline, CURRENT_DATE())>=0 ORDER BY created_at DESC LIMIT $begin, 12";
        $result_query_import_job = mysqli_query($conn, $query_import_job);
        if (mysqli_num_rows($result_query_import_job) > 0) {
            while ($rows = mysqli_fetch_assoc($result_query_import_job)) { ?>

                <div class="jobs_item col-md-4 item-hover d-flex">
                    <div class="logo-company">
                        <a href="../html/corp_details.php?id_corp=<?= $rows['corp_id'] ?>">
                            <img src="../html/picture/corps/<?= $rows['image'] ?>" alt="logo1">
                        </a>
                    </div>
                    <div class="info-company d-flex flex-column">
                        <h4 class="d-inline-block text-truncate col-xl-6">
                            <a href="../html/job_detail.php?job_id=<?= $rows['job_id'] ?>">
                                <?php echo $rows['job_name'] ?>
                            </a>
                        </h4>
                        <small class="name-company d-inline-block text-truncate">
                            <a href="../html/corp_details.php?id_corp=<?= $rows['corp_id'] ?>">
                                <?php echo $rows['corp_name'] ?>
                            </a>
                        </small>
                        <div class="tag_info">
                            <p class="d-inline-block p-1 border rounded" style="background-color: #abc2ff;"><?= $rows['salary_name'] ?></p>
                            <p class="d-inline-block p-1" style="background-color: #abc2ff;"><?= $rows['province_name'] ?></p>
                        </div>
                    </div>
                </div>

            <?php }

            $sql_trang = "SELECT * FROM `jobs`";
            $sql_trang_run = mysqli_query($conn, $sql_trang);
            $row_count = mysqli_num_rows($sql_trang_run);
            $trang = ceil($row_count / 12);

            ?>
            <div class="d-flex justify-content-center">
                <nav aria-label="..." class="">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="vieclam.php?page=<?= $i - 1 < 1 ? 1 : $i - 1; ?>">Previous</a>
                        </li>
                        <?php
                        for ($i = 1; $i <= $trang; $i++) {
                        ?>
                            <li class="page-item"><a class="page-link" href="vieclam.php?page=<?= $i ?>"><?= $i ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item">
                            <a class="page-link" href="vieclam.php?page=<?= $i + 1 > $trang ? $trang : $i - 1 ?>">Next</a>
                        </li>

                    </ul>
                </nav>
            </div><?php
                } else {
                    echo "No data";
                }
                    ?>
    </div>
<?php } ?>