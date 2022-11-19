<?php
include 'includes/header.php';
require_once '../functions/myfunctions.php';
include '../config/connectdb.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <h1 style="text-align: center;height: 50px; margin-top: 25px;">
                    TÀI KHOẢN NHÂN VIÊN
                </h1>
            </div>
            <div class="card-body mt-4">
                <table class="table table-bordered table-striped">
                    <thead style="text-align: center;">
                        <th>ID_user</th>
                        <th>Username</th>
                        <th>Email</th>
                    </thead>
                    <tbody>
                        <?php

                        // $list = getAll("users");
                        $query = "SELECT * FROM `users` WHERE `role`=0";

                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $item) {
                        ?>
                                <tr style="text-align: center;">
                                    <td><?= $item['id_user'] ?></td>
                                    <td><?= $item['username'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "No records found";
                        }
                        ?>

                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
</div>

<?php include 'includes/footer.php'; ?>