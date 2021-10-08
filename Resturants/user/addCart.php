<?php session_start(); ?>
<?php require_once "../includes/database.php";?>
<?php
    if(!isset($_GET['id'])){
        header('location:../includes/index.php');
    }elseif(!isset($_SESSION['user_id']) or !isset($_SESSION['email']) or $_SESSION['user_type'] != "user" ){
        header('location:login.php');

    }else{
        $u_id=$_SESSION['user_id'];
        $p_id=$_GET['id'];
        
        $q0="select*from order_details where p_id=:p_id and u_id=:u_id and status=:st";
        $chkOrder=$connect->prepare($q0);
        $chkOrder->execute([':p_id'=>$p_id,':u_id'=>$u_id,':st'=>0]); 
        if($chkOrder->rowCount()>0){
            header('location:yourCart.php');
        }else{
            $pro=$connect->prepare("select price from product where p_id=:p_id");
            $pro->execute([':p_id'=>$p_id]);
            $data=$pro->fetch(PDO::FETCH_OBJ);
            $amount=$data->price;
            $sql="insert into order_details (p_id,u_id,o_qty,amount) values(:p_id,:u_id,:o_qty,:amount)";
            $add=$connect->prepare($sql);
            $add->execute([':p_id'=>$p_id,':u_id'=>$u_id,':o_qty'=>1,':amount'=>$amount]);
            header("location:../includes/index.php");
        }
        



        
        
        
        
    }
?>