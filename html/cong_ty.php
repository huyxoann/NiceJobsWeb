<!DOCTYPE html>
<html lang="en, vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Công ty| Nice Job</title>
    <link rel="stylesheet" href="../CSS/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/stylechung.css">
    <script src="../css/bootstrap.bundle.min.js"></script>
    <script src="../css/jquery-3.6.0.min.js"></script>
</head>
<?php include('../includes/header.php') ?>

<div class="container">
    <div class="">
        <div class="col-md-12">
            <form action="../html/cong_ty.php" method="get">
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
                        <input name="search_bar" type="text" class="form-control" placeholder="Nhập tên công ty" aria-label="search" aria-describedby="basic-addon1">
                        <select class="form-control select" name="field">
                            <option value="0">Lĩnh vực công ty</option>
                            <?php require_once('../html/modules/import_field.php') ?>
                        </select>
                        <input type="submit" value="Tìm" name="search" class="btn btn-secondary">
                    </div>
                </div>
            </form>
            <div class="row">
                <?php include('../html/modules/search_corp.php') ?>
            </div>
        </div>
    </div>
</div>


<?php include('../includes/footer.php') ?>