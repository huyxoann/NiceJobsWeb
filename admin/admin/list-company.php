<?php
include 'includes/header.php';
 require_once '../functions/myfunctions.php';
include '../config/connectdb.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                <h1 style="text-align: center;"> Danh sách công ty</h1>
                
              <button type="button"   class="btn btn-success float-end  w-15"><a href="add-company.php">Add</a></button> 
            </div>
            <div class="card-body" id="list-company-table">
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
                         $query = "SELECT `id_corp`, `corp_name`, `corp_field`, `image`
                         FROM `corporation`";
                          $query_run = mysqli_query($conn,$query);
                        // $list = getAll("corporation");
                    
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $item) {
                        ?>
                                <tr>
                                    <td><?= $item['id_corp'] ?></td>
                                    <td ><?= $item['corp_name'] ?></td>
                                    <td ><?= $item['corp_field'] ?></td>

                                    <td>
                                    <img width="150px" height="150px" src="../uploads/<?= $item['image'] ?>" alt="<?= $item['corp_name'] ?>">        
                                    </td>

                                    <!-- <td width="10px" height="10px"><?= $item['description']?></td> -->
                                    <td>
                                        <a href="edit-list-company.php?id_corp=<?= $item['id_corp'] ?>" class="btn btn-primary">Edit</a>
                                        
                                        <form action="code.php" method="post">
                                            <input type="hidden" name="id_corp" value="<?= $item['id_corp'] ?>">
                                            <button type="submit" class="btn btn-danger" name="delete_company_btn"> Delete</button>
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
</div>
</div>

<?php include 'includes/footer.php'; ?>