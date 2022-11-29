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
                    <h1 style="text-align: center;"> Thêm tài khoản Nhà Tuyển Dụng</h1>
                </div>
                <!-- card-body -->
                <div class="card-body">
                    <form action="code-users-employer.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Full name</label>
                                <input type="text" name="fullname" placeholder="Enter Full Name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">User name</label>
                                <input type="text" name="username" placeholder="Enter User Name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">password</label>
                                <input type="password" name="password" placeholder="Enter password" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input type="email" name="email" placeholder="Enter email" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Gender</label>
                                <select name="gender" class="form-control select">
                                    <option selected disabled>Select Gender</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="LGBT">LGBT</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone_number" placeholder="Enter phone number" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="">Situation</label>
                                <input type="text" name="situation" placeholder="Enter situation" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="">ID Corporation</label>
                                <input type="text" name="id_corp" placeholder="Enter id corporation" class="form-control" required>
                            </div>
                            <div class="col-md-6">

                                <div class="col-md-6">
                                    <label for="">Avatar</label>
                                    <input type="file" name="avatar" placeholder="Enter avatar" class="form-control">
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary mt-3" name="add_users_employer">Save</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>