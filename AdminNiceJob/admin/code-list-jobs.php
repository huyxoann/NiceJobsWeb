<?php
session_start();
include '../config/connectdb.php';
include '../functions/myfunctions.php';
//////// add list job
if (isset($_POST['add_job_btn'])) {
    $job_name    = $_POST['job_name'];
    $num_of_recruit = $_POST['num_of_recruit'];
    $gender = $_POST['gender'];
    $work_address = $_POST['work_address'];
    $job_description = $_POST['job_description'];
    $corp_id = $_POST['corp_id'];
    $career_id = $_POST['career_id'];
    $exp_id = $_POST['exp_id'];
    $employer_id  = $_POST['employer_id'];
    $province_id = $_POST['province_id'];
    $level_id = $_POST['level_id'];
    $way_to_work_id = $_POST['way_to_work_id'];
    $salary_id = $_POST['salary_id'];
    
    $sql = "INSERT INTO 
    `jobs`(`job_name`, `num_of_recruit`, `gender`, `work_address`, `job_description`, `corp_id`, `career_id`, `exp_id`, `employer_id`, `province_id`, `level_id`, `way_to_work_id`, `salary_id`) 
    VALUES ('$job_name','$num_of_recruit','$gender','$work_address','$job_description','$corp_id','$career_id','$exp_id','$employer_id','$province_id','$level_id','$way_to_work_id','$salary_id')";
   
   $query_run = mysqli_query($conn, $sql);
    if ($query_run) {
        redirect("list-jobs.php", "Job Added Successfully");
    } else {
        redirect("add-jobs.php", "Something Went Wrong");
    }
} 
// edit  job
else if (isset($_POST['edit_job_btn'])) {
    $job_id  = $_POST['job_id'];
    $job_name    = $_POST['job_name'];
    $num_of_recruit = $_POST['num_of_recruit'];
    $gender = $_POST['gender'];
    $work_address = $_POST['work_address'];
    $job_description = $_POST['job_description'];
    $corp_id = $_POST['corp_id'];
    $career_id = $_POST['career_id'];
    $exp_id = $_POST['exp_id'];
    $employer_id = $_POST['employer_id'];
    $province_id = $_POST['province_id'];
    $level_id = $_POST['level_id'];
    $way_to_work_id = $_POST['way_to_work_id'];
    $salary_id = $_POST['salary_id'];
   
    $query = "UPDATE `jobs` SET 
    `job_name`='$job_name',`num_of_recruit`='$num_of_recruit',`gender`='$gender',
    `work_address`='$work_address',`job_description`='$job_description',`corp_id`='$corp_id',`career_id`='$career_id',
    `exp_id`='$exp_id',`employer_id`='$employer_id',`province_id`='$province_id',`level_id`='$level_id',
    `way_to_work_id`='$way_to_work_id',`salary_id`='$salary_id' WHERE `job_id`='$job_id'";

    $query_run = mysqli_query($conn, $query);
    if ($query_run) {
        redirect("list-jobs.php", "Job Update Successfully");
    } else {
        redirect("list-jobs.php", "Something Went Wrong");
    }
}
//delete job
elseif (isset($_POST['delete_job_btn'])) {
    $job_id = mysqli_real_escape_string($conn, $_POST['job_id']);
    $delete_query = "DELETE FROM jobs WHERE job_id='$job_id'";
    $delete_query_run = mysqli_query($conn, $delete_query);
    if ($delete_query_run) {
        redirect("list-jobs.php", "Job Deleted Successfully");
    } else {
        redirect("list-jobs.php", "Something Went Wrong !");
    }
}
