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
                    DANH SÁCH CÔNG TY
                </h1>
                <button type="button" class="btn btn-success float-end  w-15"><a href="add-corporation.php">Add</a></button>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped" style="text-align: center;">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Field</th>
                        <th>Image</th>
                        <!-- <th>Description</th> -->
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $limit=5;
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

                        $query = "SELECT corporation.id_corp, corporation.corp_name, corp_field.field_name, corporation.image FROM corporation INNER JOIN corp_field ON corporation.corp_field_id = corp_field.field_id LIMIT $begin,$limit ";
                        $query_run = mysqli_query($conn, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $item) {
                        ?>
                                <tr>
                                    <td><?= $item['id_corp'] ?></td>
                                    <td><?= $item['corp_name'] ?></td>
                                    <td><?= $item['field_name'] ?></td>
                                    <td>
                                        <img style="width: 100px;height:100px;" src="../html/picture/corps/<?= $item['image']; ?>">
                                    </td>

                                    <td>
                                        <a href="edit-list-corporation.php?id_corp=<?= $item['id_corp'] ?>" class="btn btn-primary">Edit</a>

                                        <form action="code-list-corporation.php" method="post">
                                            <input type="hidden" name="id_corp" value="<?= $item['id_corp'] ?>">
                                            <button type="submit" class="btn btn-danger" name="delete_corporation_btn"> Delete</button>
                                        </form>

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
        $sql_page = "SELECT * FROM `corporation`";
        $sql_page_run = mysqli_query($conn, $sql_page);
        $row_count = mysqli_num_rows($sql_page_run);
        $totoalPages = ceil($row_count / $limit);
        ?>
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                <a class="page-link" href="list-corporation.php?page=<?= $page<=1 ? '' : $page - 1 ?>">&laquo;</a>
            </li>
            <?php
            for ($i = 1; $i <= $totoalPages; $i++) {
            ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="list-corporation.php?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php
            }
            ?>
            <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                <a class="page-link" href="list-corporation.php?page=<?= $page >= $totoalPages ? '#': $page + 1 ?>">&raquo;</a>
            </li>
        </ul>
    </nav>
</div>
</div>

<?php include 'includes/footer.php'; ?>