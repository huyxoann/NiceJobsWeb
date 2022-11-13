<?php
include 'includes/header.php';
include '../config/connectdb.php';
?>

<div class="container">
    <div class="row">

        <div class="col-md-12">
            <?php
            if (isset($_GET['id_corp'])) {
                $id_corp = $_GET['id_corp'];
                $query = "SELECT * FROM `corporation` WHERE id_corp='$id_corp'";
                $list = mysqli_query($conn, $query);

                if (mysqli_num_rows($list) > 0) {
                    $data = mysqli_fetch_array($list);
            ?>
                    <div class="card">
                        <!-- card-header -->
                        <div class="card-header">
                            <h4>Edit User Corporation</h4>
                        </div>
                        <!-- card-body -->
                        <div class="card-body">
                            <form action="code-list-corporation.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id_corp" value="<?= $data['id_corp'] ?>">
                                        <label for="">Corporation Name</label>
                                        <input type="text" name="corp_name" value="<?= $data['corp_name'] ?>" placeholder="Enter Corporation Name" class="form-control">
                                    </div>
                                    <div class="col-md-6">

                                        <label for="">Select Category</label>
                                        <select name="corp_field" class="form-control select">
                                            <option value="0">Select category</option>
                                            <?php
                                            $query = "SELECT * FROM corp_field";
                                            $query_run = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                while ($rows = mysqli_fetch_assoc($query_run)) { ?>
                                                    <option value="<?= $rows['field_id']; ?>" <?= $data['corp_field_id'] == $rows['field_id'] ? 'selected' : '' ?>><?= $rows['field_name'] ?></option>

                                            <?php }
                                            } else {
                                                echo 'No category available !';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Corporation Email</label>
                                    <input type="email" name="corp_mail" value="<?= $data['corp_mail'] ?>" placeholder="Enter Corporation Email" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label for="">Description</label>
                                    <textarea name="text" rows="3" placeholder="Enter Description" class="form-control"><?= $data['description'] ?></textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="">Upload Image</label>
                                    <input type="file" name="image" class="form-control">
                                    <label for="">Current Image</label>
                                    <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                                    <img src="../images/<?= $data['image'] ?>" height="200px" wid_corpth="200px">
                                </div>


                                <div class="col-md-6">
                                    <label for="">Website</label>
                                    <input type="text" name="website" value="<?= $data['website'] ?>" placeholder="Enter website" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Address</label>
                                    <input type="text" name="address" value="<?= $data['address'] ?>" placeholder="Enter Address" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" name="edit_user_corporation_btn">Update</button>
                                </div>
                        </div>
                        </form>


                    </div>
        </div>

<?php } else {
                    echo "Category not found";
                }
            } else {
                echo "id_corp missing from url";
            }
?>




    </div>
</div>
</div>

<?php include 'includes/footer.php'; ?>