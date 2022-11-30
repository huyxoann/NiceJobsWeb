<?php
require('../html/modules/connection.php');
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
    <script src="../css/bootstrap.bundle.min.js"></script>
    <script src="../css/jquery-3.6.0.min.js"></script>
</head>
<?php include('../includes/header.php') ?>

<div class="container">
    <div class="">
        <div class="col-md-12">
            <div class="card-header">
                <h1 style="text-align: center;height: 50px; margin-top: 5px;">
                    DANH SÁCH CÔNG TY
                </h1>
            </div>
            <div class="row">
                <div class="col-md-9"></div>
                <div class="col-md-3 input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <ion-icon name="search-outline"></ion-icon>
                    </span>
                    <input type="text" class="form-control" placeholder="Nhập tên công ty" aria-label="search" aria-describedby="basic-addon1">
                    <input type="submit" value="Tìm" name="search" class="btn btn-secondary">
                </div>
            </div>
            <div class="row">
                <?php
                $query = "SELECT * FROM `corporation`ORDER BY corp_name ASC ";
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $item) {
                ?>
                        <div class="col-md-4 col-sm-6 ">
                            <div class="box-company item-hover">
                                <div class="company-banner text-center">
                                    <a href="corp_details.php?id_corp=<?= $item['id_corp'] ?>">
                                        <div class="cover-wraper">
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
                } else {
                    echo "No records found";
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php include('../includes/footer.php') ?>