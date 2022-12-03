<?php
include 'includes/header.php';
include '../config/connectdb.php';
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['job_id'])) {
                $job_id  = $_GET['job_id'];
                $query = "SELECT * FROM `jobs` WHERE job_id ='$job_id'";
                $list = mysqli_query($conn, $query);

                if (mysqli_num_rows($list) > 0) {
                    $data = mysqli_fetch_array($list);
            ?>
                    <div class="card">
                        <!-- card-header -->
                        <div class="card-header">
                            <h2 style="text-align: center;"> Edit List Job</h2>
                        </div>
                        <!-- card-body -->
                        <div class="card-body">
                            <form action="code-list-jobs.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="job_id" value="<?= $data['job_id'] ?>">
                                        <label for="">Job Name</label>
                                        <input type="text" name="job_name" value="<?= $data['job_name'] ?>" placeholder="Enter Job Name" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Number Of Recruit</label>
                                        <input type="number" name="num_of_recruit" placeholder="Enter number of recruit" class="form-control" required value="<?= $data['num_of_recruit'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Gender</label>
                                        <select name="gender" class="form-control select">
                                            <?php
                                            if ($data['gender'] == "0") {
                                            ?>
                                            <option selected value="0">Nam</option>
                                                <option value="1">Nữ</option>
                                              
                                            <?php
                                            } elseif ($data['gender'] == "1") {
                                            ?>
                                            <option selected value="1">Nữ</option>
                                                <option value="0">Nam</option>                                   
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Work Address</label>
                                        <input type="text" name="work_address" value="<?= $data['work_address'] ?>" placeholder="Enter Work address" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Job Description</label>
                                        <textarea name="job_description" rows="3" placeholder="Enter Job Description" class="form-control"><?= $data['job_description'] ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""> Corporation ID</label>
                                        <select name="corp_id" class="form-control select" required>
                                            <option selected><?= $data['corp_id'] ?></option>
                                            <?php
                                            $query = "SELECT * FROM `corporation` where `id_corp`!= '$abc'";
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
                                        <label for="">Career Name</label>
                                        <select name="career_id" class="form-control select" required>
                                            <option selected><?= $data['career_id']  ?></option>
                                            <?php
                                            $query = "SELECT * FROM `career`";
                                            $query_run = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                            ?>
                                                    <option value="<?= $item['career_id'] ?>"><?php echo $item['career_id'] . ' - ' . $item['career_name'] ?></option>
                                            <?php }
                                            } else {
                                                echo "No record avaliable";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Expensive name</label>
                                        <select name="exp_id" class="form-control select" required>
                                            <option selected><?= $data['exp_id'] ?></option>
                                            <?php
                                            $query = "SELECT * FROM `experience`";
                                            $query_run = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                            ?>
                                                    <option value="<?= $item['exp_id'] ?>"><?php echo $item['exp_id'] . ' - ' . $item['exp_name'] ?></option>
                                            <?php }
                                            } else {
                                                echo "No record avaliable";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">employer Full Name</label>
                                        <select name="employer_id" class="form-control select" required>
                                            <option selected><?= $data['employer_id']  ?></option>
                                            <?php
                                            $query = "SELECT * FROM `employer`";
                                            $query_run = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                            ?>
                                                    <option value="<?= $item['id_user'] ?>"><?php echo $item['id_user'] . ' - ' . $item['fullname'] ?></option>
                                            <?php }
                                            } else {
                                                echo "No record avaliable";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Province Name</label>
                                        <select name="province_id" class="form-control select" required>
                                            <option selected><?= $data['province_id'] ?></option>
                                            <?php
                                            $query = "SELECT * FROM `province`";
                                            $query_run = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                            ?>
                                                    <option value="<?= $item['province_id'] ?>"><?php echo $item['province_id'] . ' - ' . $item['province_name'] ?></option>
                                            <?php }
                                            } else {
                                                echo "No record avaliable";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">level Name</label>
                                        <select name="level_id" class="form-control select" required>
                                            <option selected><?= $data['level_id']  ?></option>
                                            <?php
                                            $query = "SELECT * FROM `level`";
                                            $query_run = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                            ?>
                                                    <option value="<?= $item['level_id'] ?>"><?php echo $item['level_id'] . ' - ' . $item['level_name'] ?></option>
                                            <?php }
                                            } else {
                                                echo "No record avaliable";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Way to work Name</label>
                                        <select name="way_to_work_id" class="form-control select" required>
                                            <option selected><?= $data['way_to_work_id'] ?></option>
                                            <?php
                                            $query = "SELECT * FROM `way_to_work`";
                                            $query_run = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                            ?>
                                                    <option value="<?= $item['way_to_work_id'] ?>"><?php echo $item['way_to_work_id'] . ' - ' . $item['way_to_work_name'] ?></option>
                                            <?php }
                                            } else {
                                                echo "No record avaliable";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">salary Name</label>
                                        <select name="salary_id" class="form-control select" required>
                                            <option selected><?= $data['salary_id']  ?></option>
                                            <?php
                                            $query = "SELECT * FROM `salary`";
                                            $query_run = mysqli_query($conn, $query);
                                            if (mysqli_num_rows($query_run) > 0) {
                                                foreach ($query_run as $item) {
                                            ?>
                                                    <option value="<?= $item['salary_id'] ?>"><?php echo $item['salary_id'] . ' - ' . $item['salary_name'] ?></option>
                                            <?php }
                                            } else {
                                                echo "No record avaliable";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary mt-3 " name="edit_job_btn">Update</button>
                                    </div>

                                </div>
                            </form>


                        </div>

                <?php } else {
                    echo "Job not found";
                }
            } else {
                echo "job_id missing from url";
            }
                ?>




                    </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>