<?php session_start(); ?>
<?php
    if(!isset($_SESSION['o_id']) or !isset($_SESSION['user_id']) or !isset($_SESSION['email']) or $_SESSION['user_type'] != "user" ){
        header('location:../includes/index.php');

    }else{
        require_once "../includes/database.php";
        $order_id=$_SESSION['o_id'];
        $sql="select p_id from order_details where o_id=:o_id and status=:status";
        $query=$connect->prepare($sql);
        $query->execute([':o_id'=>$order_id,":status"=>1]);
        if($query->rowCount()==1){
            echo "Yupp  !<br>";
            echo "Your order is Confirmed<br>";
            echo "Your Order Id is ".$order_id."<br>";

        }else{
            header('location:../includes/index.php');
        }
    }
    unset($_SESSION['o_id']);
?>