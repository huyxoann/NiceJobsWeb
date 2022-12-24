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
                    <!-- <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editCV" data-cv-name="<?= $rows_cv_edit['cv_name'] ?>" data-cv-filename="<?= $rows_cv_edit['file_name'] ?>" data-cv-career="<?= $rows_cv_edit['career_id'] ?>" data-cv-exp="<?= $rows_cv_edit['exp_id'] ?>" data-cv-id="<?= $rows_cv_edit['id_cv'] ?>" data-cv-pdf="<?= $rows_cv_edit['filename'] ?>">Sửa</button> -->
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCV" data-cv-name="<?= $rows_cv_edit['cv_name'] ?>" data-cv-id="<?= $rows_cv_edit['cv_id'] ?>">Xóa</button>
                </div>
            </div>
        </div>
    <?php
    }
} else { ?>
    <div class="alert alert-dark" role="alert">
        Không có CV nào được tạo!
    </div>
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
        var button = $(event.relatedTarget)
        var cv_name = button.data('cv-name')
        var cv_filename = button.data('cv-filename')

        var modal = $(this)
        modal.find('.modal-title').text('' + cv_name)
        modal.find('.modal-body embed').attr("src", "../html/pdf/" + cv_filename)
    })
</script>
<!-- Modal EDIT CV -->
<!-- <div class="modal fade" id="editCV" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../html/modules/modify_cv.php" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit CV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Tên CV:</p>
                    <input type="text" id="cv_name" name="cv_name" class="form-control" value="">
                    <p>Chọn file:</p>
                    <input type="file" name="file_pdf" id="file_pdf" class="form-control" accept=".pdf">
                    <p>Chọn ngành nghề:</p>
                    <select name="career" id="career" class="form-control">
                        <option value="" selected></option>
                        <?php include('../html/modules/import_career.php') ?>
                    </select>
                    <p>Chọn kinh nghiệm:</p>
                    <select name="exp" id="exp" class="form-control">
                        <option value="" selected></option>
                        <?php include('../html/modules/import_exp.php') ?>
                    </select>
                    <input type="text" id="id_cv" name="id_cv" value="" style="display: none;">
                    <input type="text" id="filename" name="filename" value="" style="display: none;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <input type="submit" class="btn btn-primary" name="change" value="Thay đổi"></input>
                </div>
            </form>
        </div>
    </div>
</div> -->
<!-- <script>
    $('#editCV').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var cv_name = button.data('cv-name')
        var cv_filename = button.data('cv-filename')
        var cv_career = button.data('cv-career')
        var cv_exp = button.data('cv-exp')
        var cv_id = button.data('cv-id')
        var cv_filename = button.data('cv-pdf')

        var modal = $(this)
        modal.find('.modal-body #cv_name').val(cv_name)
        modal.find('.modal-body #career').val(cv_career)
        modal.find('.modal-body #exp').val(cv_exp)
        modal.find('.modal-body #id_cv').val(cv_exp)
        modal.find('.modal-body #filename').val(cv_filename)
    })
</script> -->
<!-- DELETE CV -->
<div class="modal fade" id="deleteCV" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="../html/modules/modify_cv.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="deleteLabel">Thông báo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger" id="remind">Bạn có chắc chắn muốn xóa </p>
                    <input type="text" id="cv_id" name="cv_id" value="" style="display: none;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <input type="submit" class="btn btn-danger" name="delete_cv" value="Xóa">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $('#deleteCV').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var remind = button.data('cv-name')
        var cv_id = button.data('cv-id')

        var modal = $(this)
        modal.find('.modal-body #remind').text('Bạn có chắc chắn muốn xóa "' + remind + '" không?')
        modal.find('.modal-body #cv_id').val(cv_id)
    })
</script>