<?php
    session_start();
    require_once "../includes/database.php";
    if(!isset($_SESSION['admin_id'] ) and $_SESSION['type']!="admin" and !isset($_GET['id'])) {
        header("location:login.php");
    }else{
        $id=$_GET['id'];
        $sql="delete from product where p_id=?";
        $query=$connect->prepare($sql);
        $query->bindValue(1,$id);
        if($query->execute()){
            
            header("location:dashboard.php");
        }


    }
?>