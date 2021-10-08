<?php 
    session_start();
    require_once "../includes/database.php";
    if(!isset($_SESSION['admin_id'] ) or $_SESSION['type']!="admin"){
        header("location:login.php");
    }else{
        $admin_id=$_SESSION['admin_id'];

        $q="select *from product where admin_id=?";
        $query2=$connect->prepare($q);
        $query2->bindValue(1,$admin_id);
        $query2->execute();
        $products=$query2->fetchAll(PDO::FETCH_OBJ);


        
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $title=$_POST['title'];
            $image=$_FILES['image']['name'];
            $des=$_POST['des'];
            $qty=$_POST['qty'];
            $price=$_POST['price'];
            $target="../images/".$image;
            $type=pathinfo($image,PATHINFO_EXTENSION);
            if($type!="jpg" and $type!="png" and $type!="jpeg"){
                echo "Please Upload a Jpeg ,jpg or Png File";
            }elseif($_FILES['image']['size']>500000){
                echo "File is too large";
            }
            else{
                
                       
            
                $sql="insert into product (title,image,description,price,qty,admin_id) values(?,?,?,?,?,?)";
                $query=$connect->prepare($sql);
                $query->bindValue(1,$title);
                $query->bindValue(2,$image);
                $query->bindValue(3,$des);
                $query->bindValue(4,$price);
                $query->bindValue(5,$qty);
                $query->bindValue(6,$admin_id);



                if(!($query->execute())){
                    echo "We are Stuck ! Please try again later !";
                }else{
                    move_uploaded_file($_FILES['image']['tmp_name'],$target);
                    header("location:addProduct.php");
                }


            }

            
        
        }
            
            
    }

?>



<?php include_once "../includes/adminHeader.php"; ?>
<div class="container">
            <div class="card" id="card" style="margin-top: 20px;">
                <div class="card-header">
                    <h3 class="card-title text-center">Add Product</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group input-group ip">
                            <div class="input-group-addon">
                                <span class="input-group-text"> Product Name</span>
                            </div>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group input-group ip">
                            <div class="input-group-addon">
                                <span class="input-group-text"> Product Image</span>
                            </div>
                            <input type="file" class="form-control" name="image" required>
                        </div>
                        <div class="form-group input-group ip">
                            <div class="input-group-addon">
                                <span class="input-group-text"> Description</span>
                            </div>
                            <textarea type="text-area" class="form-control" name="des">
                            </textarea>
                        </div>
                        <div class="form-group input-group ip">
                            <div class="input-group-addon">
                                <span class="input-group-text">Price</span>
                            </div>
                            <input type="text" class="form-control" name="price" required>
                        </div>
                        <div class="form-group input-group ip">
                            <div class="input-group-addon">
                                <span class="input-group-text">Quantity</span>
                            </div>
                            <input type="text" class="form-control" name="qty" required>
                        </div>
                        <button type="submit" class="btn btn-block btn-danger">Insert</button>
                    </form>                    
                </div>
            </div>
        </div>


        <br>
        <!------ Show Submited Product     ----->
        <?php if($query2->rowCount()>0):?>
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
                            <a onclick="return Delete(); "; href="deleteProduct.php?id=<?=$product->p_id; ?>"><span><i class="fa fa-trash" aria-hidden="true"></i></span></a>

                        </td>
                    </tr>
                <?php
                    $i++;
                    endforeach;
                ?>
            </table>
        </div>
        <?php endif;?>









        <?php include_once "../includes/footer.php" ?>