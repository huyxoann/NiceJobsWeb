<?php

require_once('./modules/connection.php');
$id_user = isset($_COOKIE['id_user']) ? $_COOKIE['id_user'] : "";
$get_cv_data_query = "SELECT * FROM (cv INNER JOIN career ON cv.career_id = career.career_id) INNER JOIN experience ON experience.exp_id = cv.exp_id WHERE id_user = '$id_user'";
$result = mysqli_query($conn, $get_cv_data_query);
if (mysqli_num_rows($result) > 0) {
    while ($rows_cv_edit = mysqli_fetch_assoc($result)) {
        $GLOBALS['rows_cv_edit_GL'] = $rows_cv_edit;
        $date = $rows_cv_edit['created_at'];
        $file_name = $rows_cv_edit['file_name']; ?>

        <div class="cv_group">
            <div class="cv_item d-flex flex-row justify-content-between border round p-2">
                <a type="button" class="" data-bs-toggle="modal" data-bs-target="#cvShow" data-cv-name="<?= $rows_cv_edit['cv_name'] ?>" data-cv-filename="<?= $rows_cv_edit['file_name'] ?>">
                    <div class="tag_name d-flex flex-row">
                        <div class="cv_name me-3">
                            <p><?= $rows_cv_edit['cv_name'] ?></p>
                        </div>
                        <div class="career me-3">
                            <p><?= $rows_cv_edit['career_name'] ?></p>
                        </div>
                        <div class="upload_at">
                            <p><?php echo split_date($date) ?></p>
                        </div>
                    </div>
                </a>
                <div class="action_button">
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editCV">Sửa</button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCV">Xóa</button>
                </div>
            </div>
        </div>
    <?php
    }
} else { ?>
    <div class="alert alert-dark" role="alert">
        Không có CV nào được tạo!
    </div>';
<?php }
?>
<!-- Modal SHOW CV-->
<div class="modal fade" id="cvShow" tabindex="-1" aria-labelledby="cvShowLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cvShowLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <embed src="" width="1000px" height="1200px" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#cvShow').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var cv_name = button.data('cv-name') // Extract info from data-* attributes
        var cv_filename = button.data('cv-filename')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('' + cv_name)
        modal.find('.modal-body embed').attr("src", "../html/pdf/" + cv_filename)
    })
</script>
<!-- Modal EDIT CV -->
<div class="modal fade" id="editCV" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../html/modules/modify_cv.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tên CV:</p>
                    <input type="text" name="cv_name" class="form-control" value="<?php echo $rows_cv_edit_GL['cv_name'] ?>">
                    <p>Chọn file:</p>
                    <input type="file" name="file_pdf" id="file_pdf" class="form-control">
                    <p>Chọn ngành nghề:</p>
                    <select name="career" id="career" class="form-control">
                        <option value="<?= $rows_cv_edit_GL['career_id'] ?>" selected><?php echo $rows_cv_edit_GL['career_name'] ?></option>
                        <?php include('../html/modules/import_career.php') ?>
                    </select>
                    <p>Chọn kinh nghiệm:</p>
                    <select name="exp" id="exp" class="form-control">
                        <option value="<?= $rows_cv_edit_GL['exp_id'] ?>" selected><?php echo $rows_cv_edit_GL['exp_name'] ?></option>
                        <?php include('../html/modules/import_exp.php') ?>
                    </select>
                    <input type="text" name="id_cv" value="<?php echo $rows_cv_edit_GL['id_cv'] ?>" style="display: none;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <input type="submit" class="btn btn-primary" name="change" value="Thay đổi"></input>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- DELETE CV -->
<div class="modal fade" id="deleteCV" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-danger">Xóa</button>
            </div>
        </div>
    </div>
</div>