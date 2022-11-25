<?php require('../html/modules/connection.php');
include("../html/modules/xu_ly_du_lieu.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
    <script>
        $(document).ready(function() {
            $("#myModal").modal('show');
        })
    </script>
    <!-- Modal -->
    <?php

    if (isset($_COOKIE['role']) && $_COOKIE['role'] == 0) {
        $id_user = $_COOKIE['id_user'];
        $query = "SELECT * FROM employee WHERE id_user = '$id_user'";
        $result = mysqli_query($conn, $query);
        if (mysqli_fetch_assoc($result) == 0) { ?>
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nhập thông tin người dùng</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6>Bước cuối để hoàn tất việc đăng kí của bạn, vui lòng nhập những thông tin bên dưới để bắt đầu công việc của bạn!</h6>
                            <p>Nhập thông tin chính xác để nhà tuyển dụng có thể dễ dàng liên lạc với bạn!</p>
                            <form action="../html/modules/xu_ly_du_lieu.php" method="post" enctype="multipart/form-data">
                                <div class="form-control">
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text">Họ và tên *</span>
                                                <input name="full_name" type="text" aria-label="First name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupSelect01">Giới tính *</label>
                                                <select name="gender" class="form-select" id="inputGroupSelect01" required>
                                                    <option value="0" selected>Nam</option>
                                                    <option value="1">Nữ</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <span class="input-group-text">Số điện thoại *</span>
                                            <input name="phone_number" type="text" aria-label="phone_number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <div class="input-group mb-3">
                                            <label class="input-group-text" for="inputGroupFile01">Ảnh đại diện</label>
                                            <input name="image" type="file" class="form-control" id="inputGroupFile01">
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="saveInfo" value="Lưu"></input>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php }
    } elseif (isset($_COOKIE['role']) && $_COOKIE['role'] == 1) {
        $id_user = $_COOKIE['id_user'];
        $query = "SELECT * FROM employer WHERE id_user = '$id_user'";
        $result = mysqli_query($conn, $query);
        if (mysqli_fetch_assoc($result) == 0) { ?>
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Nhập thông tin người dùng</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Nhập thông tin chính xác để chúng tôi biết bạn là ai.</p>
                            <p>Bạn có thể cập nhật lại ở mục "Thay đổi thông tin người dùng".</p>
                            <form action="../html/modules/xu_ly_du_lieu.php" method="post" enctype="multipart/form-data">
                                <h2 class="">Thông tin của bạn</h2>
                                <div class="form-control ">
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text">Họ và tên *</span>
                                                <input name="full_name" type="text" aria-label="First name" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupSelect01">Giới tính *</label>
                                                <select name="gender" class="form-select" id="inputGroupSelect01" required>
                                                    <option value="0" selected>Nam</option>
                                                    <option value="1">Nữ</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text">Số điện thoại *</span>
                                                <input name="phone_number" type="text" aria-label="phone_number" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupFile01">Ảnh đại diện</label>
                                                <input name="image" type="file" class="form-control" id="inputGroupFile01">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <h2 class="">Công ty của bạn</h2>
                                <div class="form-control ">
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <span class="input-group-text">Tên công ty *</span>
                                                <input name="corp_name" type="text" aria-label="First name" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="inputGroupFile01">Ảnh công ty</label>
                                                <input name="corp_img" type="file" class="form-control" id="inputGroupFile01">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text">Website *</span>
                                                <input name="website" ype="text" aria-label="phone_number" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text">Địa chỉ *</span>
                                                <input name="corp_address" type="text" aria-label="phone_number" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text">Lĩnh vực công ty *</span>
                                                <select name="corp_field" class="form-control select">
                                                    <option value="0">Lĩnh vực công ty</option>
                                                    <?php require_once('../html/modules/import_field.php') ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 mt-2">
                                            <span class="input-group-text">Mô tả công ty</span>
                                            <div class="input-group">
                                                <textarea name="moTaCongTy" aria-label="With textarea" class="form-control" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" name="saveInfo" value="Lưu"></input>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    <?php }
    } else {
    } ?>


</body>

</html>