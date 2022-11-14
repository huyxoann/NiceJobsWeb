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
                    
                    <h1 style="text-align: center;"> Thêm tài khoản admin</h1>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <form action="code-admin.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                           
                            <div class="col-md-6">
                                <label for="">User Name</label>
                                <input type="text" name="username" placeholder="Enter User Name"  class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">password</label>
                                <input type="password" name="password" placeholder="Enter password" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Re-password</label>
                                <input type="password" name="re_password" placeholder="Enter re-password" class="form-control">
                            </div>
                                           
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_user_admin_btn">Save</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>



        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>