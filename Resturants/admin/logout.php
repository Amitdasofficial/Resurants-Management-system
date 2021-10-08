<?php
    session_start();
    if(isset($_SESSION['admin_id']) and isset($_SESSION['type'])){
        session_unset();
        session_destroy();
        header("location:login.php");
    }
?>