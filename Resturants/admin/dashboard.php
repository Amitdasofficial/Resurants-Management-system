<?php
    require_once "../includes/database.php";
    session_start();

    if(!isset($_SESSION['admin_id'] ) and $_SESSION['type']!="admin"){
        header("location:login.php");
    }else{
        $sql="select * from product";
        $query=$connect->prepare($sql);
        $query->execute();
        $products=$query->fetchAll(PDO::FETCH_OBJ);
        
    }


?>


<?php include_once "../includes/adminHeader.php";?>

<?php if($query->rowCount()>0):?>
        <div>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Sl No</th><th>Product Name</th><th>Product Image</th><th>Description</th><th>Price</th><th>Quantity</th><th>Action</th>
                </tr>
                <?php 
                    $i=1;
                    foreach($products as $product):
                ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$product->title;?></td>
                        <td><img src="<?="../images/".$product->image;?>" class="img-fluid d-block " style="width: 100px;height: 100px;" alt=""></td>
                        <td><?=$product->description;?></td>
                        <td><?=$product->price;?></td>
                        <td><?=$product->qty;?></td>
                        <td>
                            <a  href="updateProduct.php?id=<?=$product->p_id;?>"><span><i class="fa fa-edit"></i></span></a>
                            <a  href="deleteProduct.php?id=<?=$product->p_id;?>" onclick="return Delete();"><span><i class="fa fa-trash" aria-hidden="true"></i></span></a>

                        </td>
                    </tr>
                <?php
                    $i++;
                    endforeach;
                ?>
            </table>
        </div>
        <?php endif;?>












<?php include_once "../includes/footer.php";?>
