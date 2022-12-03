<?php
include 'includes/header.php';
require '../functions/myfunctions.php';
require '../config/connectdb.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <h1 style="text-align: center;height: 50px; margin-top: 5px;">
                    DANH SÁCH CÔNG VIỆC
                </h1>
                <button type="button" class="btn btn-success float-end  w-15"><a href="add-jobs.php">Add</a></button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" style="text-align: center;">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Number of recruit</th>
                        <th>Work address</th>
                        <th>Job Description</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php

                        if (isset($_GET['trang'])) {
                            $page = $_GET['trang'];
                        } else {
                            $page = 1;
                        }
                        if ($page == '' || $page == 1) {
                            $begin = 0;
                        } else {
                            $begin = ($page * 5) - 5;
                        }
                        // $query = "SELECT corporation.id_corp, corporation.corp_name, corp_field.field_name, corporation.image FROM corporation INNER JOIN corp_field ON corporation.corp_field_id = corp_field.field_id LIMIT $begin,3 ";
                        $query = "SELECT * FROM jobs LIMIT $begin,5 ";
                        $query_run = mysqli_query($conn, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $item) {
                        ?>
                                <tr>
                                    <td><?= $item['job_id'] ?></td>
                                    <td><?= $item['job_name'] ?></td>
                                    <td><?= $item['num_of_recruit'] ?></td>
                                    <td><?= $item['work_address'] ?></td>
                                    <td><?= $item['job_description'] ?></td>
                                    <td>
                                        <a href="edit-list-jobs.php?job_id=<?= $item['job_id'] ?>" class="btn btn-primary">Edit</a>

                                        <form action="code-list-jobs.php" method="post">
                                            <input type="hidden" name="job_id" value="<?= $item['job_id'] ?>">
                                            <button type="submit" class="btn btn-danger" name="delete_job_btn"> Delete</button>
                                        </form>

                                    </td>
                                </tr>

                        <?php
                            }
                        } else {
                            echo "No records found";
                        }
                        ?>
                        <tr>
                            <td style="margin-left: 200px;padding-left: 100px;">
                                <style type="text/css">
                                    ul.list-trang {
                                        padding: 0;
                                        margin: 0;

                                        list-style: none;
                                    }

                                    ul.list-trang li {
                                        float: left;
                                        padding: 5px 13px;
                                        margin: 3px;
                                        background-color: burlywood;
                                        display: block;
                                    }

                                    ul.list-trang li a {
                                        color: #000;
                                        text-align: center;
                                        text-decoration: none;

                                    }
                                </style>
                                <!-- <p>Trang : </p> -->
                                <?php
                                $sql_trang = "SELECT * FROM `jobs`";
                                $sql_trang_run = mysqli_query($conn, $sql_trang);
                                $row_count = mysqli_num_rows($sql_trang_run);
                                $trang = ceil($row_count / 5);


                                ?>
                                <ul class="list-trang">
                                    <?php
                                    for ($i = 1; $i <= $trang; $i++) {
                                    ?>
                                        <li <?php if ($i == $page) {
                                                echo 'style="background:brown;"';
                                            } else {
                                                echo '';
                                            }
                                            ?>><a href="list-jobs.php?trang=<?= $i ?>"><?= $i ?></a></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
</div>

<?php include 'includes/footer.php'; ?>