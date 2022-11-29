<?php
require("connection.php");
if (!($_SERVER["REQUEST_METHOD"] == "POST")) {
    header("Location: ../page_404.php");
} else {
    if (isset($_POST['post'])) {
        $job_name = mysqli_real_escape_string($conn, $_POST['job_name']);
        $job_detail = mysqli_real_escape_string($conn, $_POST['job_detail']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $exp = mysqli_real_escape_string($conn, $_POST['exp']);
        $level = mysqli_real_escape_string($conn, $_POST['level']);
        $salary = mysqli_real_escape_string($conn, $_POST['salary']);
        $career = mysqli_real_escape_string($conn, $_POST['career']);
        $num_of_recruit = mysqli_real_escape_string($conn, $_POST['num_of_recruit']);
        $province = mysqli_real_escape_string($conn, $_POST['province']);
        $way_to_work = mysqli_real_escape_string($conn, $_POST['way_to_work']);
        $deadline = mysqli_real_escape_string($conn, $_POST['deadline']);

        $id_user = isset($_COOKIE['id_user']) ? $_COOKIE['id_user'] : "";
        $id_corp = get_corp_by_id($id_user, $conn);
        $query_add_job = "INSERT INTO jobs (job_name, num_of_recruit, gender, corp_id, work_address, job_description, career_id, exp_id, employer_id, province_id, level_id, way_to_work_id, salary_id, deadline) VALUES ('$job_name', '$num_of_recruit', '$gender','$id_corp','$address', '$job_detail', '$career', '$exp', '$id_user', '$province', '$level', '$way_to_work', '$salary', '$deadline')";
        if ($conn->query($query_add_job)) {
            header('Location: ../post_recruit.php');
        } else {
            echo "ERROR";
        }
    }
    // if(isset($_POST['']))
}


function get_corp_by_id($id_user, $conn)
{
    $query_get_corp = "SELECT * FROM employer WHERE id_user = '$id_user'";
    $result = $conn->query($query_get_corp);
    $rows = mysqli_fetch_assoc($result);
    return $rows['id_corp'];
}
