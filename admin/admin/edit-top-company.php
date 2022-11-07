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
                $list = getByID("top_company", $id);
                if (mysqli_num_rows($list) > 0) {
                    $data = mysqli_fetch_array($list);
            ?>
                    <div class="card">
                        <!-- card-header -->
                        <div class="card-header">
                            <h4>Edit top công ty</h4>
                        </div>
                        <!-- card-body -->
                        <div class="card-body">
                            <form action="code.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id"value="<?=$data['id']?>">
                                        <label for="">Name</label>
                                        <input type="text" name="name" value="<?=$data['name']?>" placeholder="Enter company Name" class="form-control">
                                    </div>
                                    
                                    
                                    <div class="col-md-12">
                                        <label for="">Upload Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <label for="">Current Image</label>
                                        <input type="hidden" name="old_image" value="<?=$data['image']?>">
                                        <img src="../uploads/<?=$data['image']?>" height="200px" width="200px">
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="update_top_company_btn">Update</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>

            <?php }
            else {
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