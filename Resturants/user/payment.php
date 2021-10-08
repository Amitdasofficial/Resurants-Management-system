<?php session_start();?>
<?php
    if(!isset($_SESSION['o_id']) or !isset($_SESSION['user_id']) or !isset($_SESSION['email']) or $_SESSION['user_type'] != "user" ){
        header('location:../includes/index.php');

    }else{
       if($_SERVER['REQUEST_METHOD']=='POST'){
           require_once "../includes/database.php";
            $order_id=$_SESSION['o_id'];
            $payment=$_REQUEST['payment'];
            if($payment=="cash-on-delivery"){
                $sql="update order_details set pay_method=?,status=? where o_id=?";
                $query=$connect->prepare($sql);
                $query->bindValue(1,$payment);
                $query->bindValue(2,1,PDO::PARAM_INT);
                $query->bindValue(3,$order_id);
                if($query->execute()){
                    header("location:orderSuccess.php");
                }
            }

       }
    }
?>




<?php include_once "../includes/header.php"; ?>
<center>
    <div class="container">
        <div class="card" style="max-width: 500px;">
            <form action="" method="post">  
                <div class="card-header" >
                    <h3>Select A Payment Option</h3>
                    
                        <input type="radio" name="payment"  value="cash-on-delivery" id=""> Cash On Delivery
                        <button class="btn btn-block btn-success">Complete Order </button>
                    
                </div>
            </form>
        </div>
    </div>
</center>




<?php include_once "../includes/footer.php"; ?>


