<?php
require_once('connection.php');
if (isset($_GET['search'])) {
    $search_name = isset($_GET['search_bar']) ? $_GET['search_bar'] : '';
    $corp_field = $_GET['field'];
    $query_search = "SELECT * FROM corporation WHERE corp_name LIKE '%$search_name%'";
    if ($corp_field != 0) {
        $query_search = $query_search . " AND corp_field_id = '$corp_field'";
    }
    $result_query_search = $conn->query($query_search); ?>
    <div class="title-ttd row">
        <h3>Kết quả tìm kiếm: </h3>
    </div>
    <?php if (mysqli_num_rows($result_query_search) > 0) {
        while ($data_corp = mysqli_fetch_assoc($result_query_search)) { ?>
            <div class="col-md-4 col-sm-6 ">
                <div class="box-company item-hover">
                    <div class="company-banner text-center">
                        <a href="corp_details.php?id_corp=<?= $data_corp['id_corp'] ?>">
                            <div class="cover-wraper">
                                <img src="../html/picture/corps/<?= $data_corp['image'] ?>" class="img-fluid">
                            </div>
                        </a>
                    </div>
                    <div class="company-info">
                        <h3 class="text-truncate">
                            <a href="corp_details.php?id_corp=<?= $data_corp['id_corp'] ?>" class="company-name"><?= $data_corp['corp_name'] ?></a>
                        </h3>
                        <div class="company-description">
                            <p class="" style="text-align: justify;display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;"><?= $data_corp['description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }
} else {

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

    $query = "SELECT * FROM `corporation`ORDER BY corp_name ASC LIMIT $begin, 12";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        foreach ($query_run as $item) {
        ?>
            <div class="col-md-4 col-sm-6">
                <div class="box-company item-hover border rounded p-2 mt-2" style="min-height: 300px;">
                    <div class="company-banner text-center" style="min-height: 100px;">
                        <a href="corp_details.php?id_corp=<?= $item['id_corp'] ?>">
                            <div class="cover-wrapper">
                                <img src="../html/picture/corps/<?= $item['image'] ?>" class="img-fluid">
                            </div>
                        </a>
                    </div>
                    <div class="company-info">
                        <h3 class="text-truncate">
                            <a href="corp_details.php?id_corp=<?= $item['id_corp'] ?>" class="company-name"><?= $item['corp_name'] ?></a>
                        </h3>
                        <div class="company-description">
                            <p class="" style="text-align: justify;display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;"><?= $item['description'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        $sql_trang = "SELECT * FROM `corporation`";
        $sql_trang_run = mysqli_query($conn, $sql_trang);
        $row_count = mysqli_num_rows($sql_trang_run);
        $trang = ceil($row_count / 12);

        ?>
        <div class="d-flex justify-content-center">
            <nav aria-label="..." class="">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="cong_ty.php?page=<?= $i - 1 < 1 ? 1 : $i - 1; ?>">Previous</a>
                    </li>
                    <?php
                    for ($i = 1; $i <= $trang; $i++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="cong_ty.php?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="cong_ty.php?page=<?= $i + 1 > $trang ? $trang : $i - 1 ?>">Next</a>
                    </li>

                </ul>
            </nav>
        </div>
    <?php } else { ?>
        <div class="alert alert-warning" role="alert">
            Không có công ty nào!
        </div>
        <?php

        $sql_trang = "SELECT * FROM `corporation`";
        $sql_trang_run = mysqli_query($conn, $sql_trang);
        $row_count = mysqli_num_rows($sql_trang_run);
        $trang = ceil($row_count / 12);

        $i = 0;
        ?>
        <div class="d-flex justify-content-center">
            <nav aria-label="..." class="">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="cong_ty.php?page=<?= $i - 1 < 1 ? 1 : $i - 1; ?>">Previous</a>
                    </li>
                    <?php
                    for ($i = 1; $i < $trang; $i++) {
                    ?>
                        <li class="page-item"><a class="page-link" href="cong_ty.php?page=<?= $i ?>"><?= $i ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item">
                        <a class="page-link" href="cong_ty.php?page=<?= $i + 1 > $trang ? $i : $i + 1 ?>">Next</a>
                    </li>

                </ul>
            </nav>
        </div>
<?php }
} ?>