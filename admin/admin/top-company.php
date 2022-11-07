<?php
include 'includes/header.php';
 require_once '../functions/myfunctions.php';
include '../config/connectdb.php';

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card-header">
                
                <h1 style="text-align: center;"> Top công ty</h1>
                <button type="button"   class="btn btn-success float-end  w-15"><a href="add-top-company.php">Add</a></button> 

            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        
                    </thead>
                    <tbody>
                        <?php
                        $list = getAll("top_company");
                    
                        if (mysqli_num_rows($list) > 0) {
                            foreach ($list as $item) {
                        ?>
                                <tr>
                                    <td><?= $item['id'] ?></td>
                                    <td ><?= $item['name'] ?></td>
                                  
                                    <td>
                                    <img width="100px" height="100px" src="../uploads/<?= $item['image'] ?>" alt="<?= $item['name'] ?>">        
                                </td>
                                  
                                    <td>
                                        <a href="edit-top-company.php?id=<?= $item['id'] ?>" class="btn btn-primary">Edit</a>
                                        <form action="code.php" method="post">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                            <button type="submit" class="btn btn-danger" name="delete_top_company_btn"> Delete</button>
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