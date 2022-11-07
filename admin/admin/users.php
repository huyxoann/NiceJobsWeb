<?php
include 'includes/header.php';
 require_once '../functions/myfunctions.php';
include '../config/connectdb.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                
                <h1 style="text-align: center;"> Danh sách Tài khoản Users</h1>
                <!-- <button type="button"   class="btn btn-success float-end  w-15"><a href="add-users.php">Add</a></button>  -->

            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead style="text-align: center;">
                        <th>ID_user</th>
                        <th>Username</th>
                        <!-- <th>Avatar</th> -->
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Role</th>
                    </thead>
                    <tbody>
                        <?php
                        $list = getAll("users");
                    
                        if (mysqli_num_rows($list) > 0) {
                            foreach ($list as $item) {
                        ?>
                                <tr style="text-align: center;">
                                    <td><?= $item['id_user'] ?></td>                             
                                    <td ><?= $item['username'] ?></td>
                                    <!-- <td ><?= $item['avatar'] ?></td> -->
                                    <td ><?= $item['email'] ?></td>
                                    <td ><?= $item['email'] ?></td>
                                    <td ><?= $item['password'] ?></td>
                                    <td ><?= $item['role'] ?></td>

                                    <!-- <td>
                                        <a href="edit-users.php?id=<?= $item['id_user'] ?>" class="btn btn-primary">Edit</a>
                                        <form action="code.php" method="post">
                                            <input type="hidden" name="id" value="<?= $item['id_user'] ?>">
                                            <button type="submit" class="btn btn-danger" name="delete_users_btn"> Delete</button>
                                        </form>
                                    </td> -->
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