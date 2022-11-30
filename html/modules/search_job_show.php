<?php
require_once('connection.php');
if (isset($_GET['search'])) {
    $search_name = isset($_GET['search_bar']) ? $_GET['search_bar'] : ' ';
    $career = $_GET['career'];
    $level = $_GET['level'];
    $way_to_work = $_GET['way_to_work'];
    $province = $_GET['province'];
    $salary = $_GET['salary'];

    $query_search = "SELECT * FROM (((((((jobs INNER JOIN corporation ON jobs.corp_id = corporation.id_corp) INNER JOIN career ON career.career_id = jobs.career_id) INNER JOIN experience ON experience.exp_id = jobs.exp_id) INNER JOIN province ON province.province_id = jobs.job_id) INNER JOIN level ON level.level_id = jobs.level_id) INNER JOIN way_to_work ON way_to_work.way_to_work_id = jobs.way_to_work_id) INNER JOIN salary ON salary.salary_id = jobs.salary_id) WHERE job_name LIKE '%$search_name%'";
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
    $result_query_search = $conn->query($query_search);
    if (mysqli_num_rows($result_query_search) > 0) {
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
    }
} else { ?>
    <div class="list-cong-viec d-flex flex-wrap">
        <div class="row">
            <?php
            $query_import_job = "SELECT * FROM (((((((jobs INNER JOIN corporation ON jobs.corp_id = corporation.id_corp) INNER JOIN career ON career.career_id = jobs.career_id) INNER JOIN experience ON experience.exp_id = jobs.exp_id) INNER JOIN province ON province.province_id = jobs.job_id) INNER JOIN level ON level.level_id = jobs.level_id) INNER JOIN way_to_work ON way_to_work.way_to_work_id = jobs.way_to_work_id) INNER JOIN salary ON salary.salary_id = jobs.salary_id) WHERE DATEDIFF(deadline, CURRENT_DATE())>0 ORDER BY created_at DESC";
            $result_query_import_job = mysqli_query($conn, $query_import_job);
            if (mysqli_num_rows($result_query_import_job) > 0) {
                while ($rows = mysqli_fetch_assoc($result_query_import_job)) { ?>
                    <div class="jobs_item col-md">
                        <div class="logo-company">
                            <a href="../html/corp_details.php?id_corp=<?= $rows['corp_id'] ?>">
                                <img src="../html/picture/corps/<?= $rows['image'] ?>" alt="logo1">
                            </a>
                        </div>
                        <div class="info-company">
                            <a href="../html/job_detail.php?job_id=<?= $rows['job_id'] ?>">
                                <h4 class="name-job text-truncate">
                                    <?php echo $rows['job_name'] ?>
                                </h4>
                            </a>
                            <a href="../html/corp_details.php?id_corp=<?= $rows['corp_id'] ?>">
                                <small class="name-company text-truncate">
                                    <?php echo $rows['corp_name'] ?>
                                </small>
                            </a>
                            <div class="tag_info">
                                <p class="d-inline-block p-1 border rounded" style="background-color: #abc2ff;"><?= $rows['salary_name'] ?></p>
                                <p class="d-inline-block p-1" style="background-color: #abc2ff;"><?= $rows['province_name'] ?></p>
                            </div>
                        </div>
                    </div>
            <?php }
            } else {
                echo "No data";
            }
            ?>
        </div>
    </div>
<?php } ?>