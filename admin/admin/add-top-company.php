<?php
include 'includes/header.php';
?>

<div class="container">
    <div class="row">
        <!-- content -->
        <div class="col-md-12">
            <div class="card">
            <!-- card-header -->
                <div class="card-header">
                    <h1 style="text-align: center;">Thêm Top công ty</h1>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <form action="code.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Upload Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_top_company_btn">Save</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>



        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>