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
                    TÀI KHOẢN NHÀ TUYỂN DỤNG
                </h1>
                <button type="button" class="btn btn-success float-end  w-15"><a href="add-users-employer.php">Add</a></button>
            </div>
            <div class="card-body mt-4">
                <table class="table table-bordered table-striped">
                    <thead style="text-align: center;">
                        <th>ID_user</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Avatar</th>
                    </thead>
                    <tbody>
                        <?php
                        $limit = 5;
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }
                        if ($page == '' || $page == 1) {
                            $begin = 0;
                        } else {
                            $begin = ($page * $limit) - $limit;
                        }
                        $query = "SELECT users.id_user, `username`, `email`,`avatar` FROM `users`INNER JOIN `employer` ON users.id_user = employer.id_user WHERE `role`=1 LIMIT $begin,$limit"; 
                        $query_run = mysqli_query($conn, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $item) {
                        ?>
                                <tr style="text-align: center;">
                                    <td><?= $item['id_user'] ?></td>
                                    <td><?= $item['username'] ?></td>
                                    <td><?= $item['email'] ?></td>
                                    <td>
                                        <img style="width: 100px;height:100px;" src="../images/<?= $item['avatar']; ?>">
                                    </td>
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
    <!-- <p>Phân trang : </p> -->
    <nav  aria-label="Page navigation example mt-5">
        <?php
        $sql_page = "SELECT * FROM `jobs`";
        $sql_page_run = mysqli_query($conn, $sql_page);
        $row_count = mysqli_num_rows($sql_page_run);
        $totoalPages = ceil($row_count / $limit);
        ?>
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                <a class="page-link" href="users-employer.php?page=<?= $page<=1 ? '' : $page - 1 ?>">&laquo;</a>
            </li>
            <?php
            for ($i = 1; $i <= $totoalPages; $i++) {
            ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="users-employer.php?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php
            }
            ?>
            <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                <a class="page-link" href="users-employer.php?page=<?= $page >= $totoalPages ? '#': $page + 1 ?>">&raquo;</a>
            </li>
        </ul>
    </nav>
</div>
</div>

<?php include 'includes/footer.php'; ?>