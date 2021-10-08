<?php 
    require_once "database.php";
    $sql="select * from product";
    $query=$connect->prepare($sql);
    $query->execute();
    $totalPost=$query->rowCount();
    $result_per_page=1;
    $number_of_page=ceil($totalPost/$result_per_page);
    
        $current_page=0;
        $previous_page=0;
        $next_page=0;
        if(!isset($_GET['page'])){
            $current_page=1;
        }else{
            $current_page=$_GET['page'];
        }

        if($current_page==1){
            $previous_page="disabled";
        }else{
            $cp=$current_page-1;
            $previous_page="index.php?page=$cp";
        }
        if($current_page==$number_of_page){
            $next_page="disabled";
        }else{
            $np=$current_page+1;
            $next_page="index.php?page=$np";
        }


       
    $starting_limit_number=($current_page-1)*$result_per_page;
    $sql1="select * from product order by p_id desc  LIMIT ?,? ";
    $query1=$connect->prepare($sql1);
    $query1->bindValue(1,$starting_limit_number,PDO::PARAM_INT);
    $query1->bindValue(2,$result_per_page,PDO::PARAM_INT);
    $query1->execute();
    $data=$query1->fetchAll(PDO::FETCH_OBJ);
?>




<?php include_once "header.php"; ?>

    <div class="container">
        <div class="row">
            <?php if($query->rowCount()>0):?>
                <?php foreach($data as $product): ?>
                    <div class="col-sm-6 col-md-3" style="margin-bottom:5px ;margin-top:5px ;">
                        <div class="card">
                            <div class="card-body">
                                <a href="productDetails.php?p_id=<?=$product->p_id;?>">
                                    <img class="card-img img-fluid d-block" src="<?= "../images/".$product->image;?>" alt="<?=$product->title; ?>"><!----<?=$product->image; ?>---->
                                    <h4 class="card-title " style="text-decoration: none;"><i class="fa "></i><?=$product->title; ?></h4>
                                    <p class="card-text" style="text-decoration: none;"><?="Price :".$product->price;?></p>
                                    
                                </a>
                            </div>
                        </div>

                    </div>

                <?php endforeach;?>
            <?php endif; ?>
        </div>

    </div>

    <br>
    <div class="container text-center">
        <div class="pagination">
            <li class="page-item <?=$previous_page;?>"><a href="<?=$previous_page?>" class="page-link ">Previous</a></li>
            <?php for($page=1;$page<=$number_of_page;$page++): ?>
                <?php
                    $active=0;
                    if($page==$current_page){
                        $active="active";
                    }
                ?>
                <li class="page-item <?=$active;?>"><?='<a class="page-link" href="index.php?page='.$page.'">'.$page.'</a>'; ?></li>
            <?php endfor;?>
            <li class="page-item <?=$next_page;?> "><a href="<?=$next_page;?>" class="page-link">Next</a></li>
        </div>
    </div>
    
    









<?php include_once "footer.php" ?>