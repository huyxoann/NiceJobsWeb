<?php
include 'includes/header.php';
require '../config/connectdb.php';
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
                                    <option value="0">Nam</option>
                                    <option value="1">Nữ</option>
                                    
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
                                        <label for=""> Corporation ID</label>
                                        <select name="id_corp" class="form-control select" required>
                                            <option selected disabled>Select Corporation ID</option>
                                            <?php
                                            $query = "SELECT * FROM `corporation` ";
                                            $query_run = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                            ?>
                                                <?php
                                                foreach ($query_run as $item) {
                                                ?>
                                                    <option value="<?= $item['id_corp'] ?>"><?php echo $item['id_corp'] . ' - ' . $item['corp_name'] ?></option>
                                            <?php }
                                            } else {
                                                echo "No record avaliable";
                                            }
                                            ?>
                                        </select>
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