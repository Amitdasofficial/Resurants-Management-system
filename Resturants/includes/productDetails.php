<?php require_once "../includes/database.php"; ?>
<?php
    if(!isset($_GET['p_id'])){
        header("location:index.php");
    }else{
        $p_id=$_GET['p_id'];
        $sql="select *from product where p_id=:p_id";
        $query=$connect->prepare($sql);
        $query->execute([':p_id'=>$p_id]);
        if($query->rowCount()==1){
            $p_details=$query->fetch(PDO::FETCH_OBJ);
        }else{
            header("location:index.php");
        }

    }
?>





<?php include_once "../includes/header.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-md-5"> 
            <div class="card">
                <div class="card-body">
                    <img src="../images/<?=$p_details->image; ?>" class="card-img img-fluid d-block mx-auto" style="max-width: 400px;max-height: 400px;" alt="">
                    <br>
                    <a class="card-link btn btn-sm btn-danger btn-lg" href="../user/buyNow.php?id=<?=$p_id; ?>" style="float: right;margin-right:10%"><i class="fa fa-bolt" aria-hidden="true"></i>
                     Buy Now</a>
                    <a class="card-link btn btn-sm btn-primary" href="../user/addCart.php?id=<?=$p_id; ?>" style="float: left;margin-left: 10%;"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                </div>
            </div>
            <br>
        </div>
        <div class="col-md-7"> 
            <div class="card">
                    <div class="card-header">
                        <table class="table table-striped ">
                            <tr>
                                <th class="th">Product Name :</th><td><?=$p_details->title; ?></td>
                            </tr>
                            <tr>
                                <th class="th">Description :</th><td><?=$p_details->description; ?></td>
                            </tr>
                            <tr>
                                <th class="th">Price :</th><td><?=$p_details->price; ?></td>
                            </tr>
                            <tr>
                                <th class="th"> Availabe Quantity :</th><td><?=$p_details->qty; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <br>
    </div>
</div>




<?php include_once "../includes/footer.php"; ?>
