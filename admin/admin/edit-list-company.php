<?php
include 'includes/header.php';
require_once '../config/connectdb.php';
?>

<div class="container">
    <div class="row">
        <!-- content -->
        <div class="col-md-12">
            <?php
            if (isset($_GET['id_corp'])) {
                $id_corp  = $_GET['id_corp'];
                $query = "SELECT * FROM corporation WHERE id_corp='$id_corp'";
                $query_run = mysqli_query($conn,$query);
                // $corporation = getByID("corporation", $id_corp);
                if (mysqli_num_rows($query_run) > 0) {
                    $data = mysqli_fetch_array($query_run);
            ?>

                    <div class="card">
                        <!-- card-header -->
                        <div class="card-header">
                            <h4>Edit Corporation</h4>
                        </div>
                        <!-- card-body -->
                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">Corporation Name</label>
                                        <input type="text" required name="corp_name" value="<?= $data['corp_name'] ?>" placeholder="Enter Corporation Name" class="form-control mb-2">
                                        <input type="hidden" name="name" value="<?= $data['id_corp'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Corporation field</label>
                                        <input type="text" required name="corp_field" value="<?= $data['corp_field'] ?>" placeholder="Enter Corporation Field" class="form-control mb-2">

                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Corporation Email</label>
                                        <input type="email" name="corp_mail" value="<?= $data['corp_mail'] ?>" placeholder="Enter Corporation Email" class="form-control mb-2">

                                    </div>

                                    <div class="col-md-12">
                                        <label for="">Upload Image</label>
                                        <input type="hidden" name="old_name" value="<?= $data['image'] ?>">
                                        <input type="file" name="image" class="form-control mb-2">
                                        <label class="mb-0">Current Image</label>
                                        <img src="../uploads/<?= $data['image'] ?>" alt="Comporation Image" height="150px" width="150px">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="">Description</label>
                                        <textarea name="description" rows="3" placeholder="Enter Description" class="form-control"><?= $data['description'] ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Website</label>
                                        <input type="text" name="website" value="<?= $data['website'] ?>"  placeholder="Enter Corporation Website" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Corporation Address</label>
                                        <input type="text" name="address" value="<?= $data['address'] ?>"  placeholder="Enter Corporation Address" class="form-control">
                                    </div>

                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="update_corporation_btn">update</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
            <?php } else {
                    echo "Products Not Found for given id";
                }
            } else {
                echo "ID missing from url";
            }
            ?>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'; ?>