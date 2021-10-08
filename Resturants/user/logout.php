<?php
    session_start();
    if(isset($_SESSION['user_id']) or isset($_SESSION['email']) or isset($_SESSION['user_type'])){
        session_unset();
        session_destroy();
        header("location:login.php");
    }
?>