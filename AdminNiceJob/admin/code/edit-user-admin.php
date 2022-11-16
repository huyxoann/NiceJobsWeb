<?php
include 'includes/header.php';
require_once '../functions/authcode.php';
include '../config/connectdb.php';
?>

<div class="container">
    <div class="row">

        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = "SELECT * FROM `admin` WHERE id='$id'";
                $list = mysqli_query($conn, $query);
                // $list = getByID("admin", $id);
                if (mysqli_num_rows($list) > 0) {
                    $data = mysqli_fetch_array($list);
            ?>
                    <div class="card">
                        <!-- card-header -->
                        <div class="card-header">
                            <h4>Edit User admin</h4>
                        </div>
                        <!-- card-body -->
                        <div class="card-body">
                            <form action="code-admin.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                                        <label for="">Username</label>
                                        <input type="text" name="username" value="<?= $data['username'] ?>" placeholder="Enter User Name" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="">Password</label>
                                        <input type="password" name="password" placeholder="Enter Password" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Re-Password</label>
                                        <input type="password" name="re_password" placeholder="Enter Password" class="form-control">
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-primary" name="edit_user_admin_btn">Update</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>

            <?php } else {
                    echo "Category not found";
                }
            } else {
                echo "ID missing from url";
            }
            ?>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>