<?php 
    try{
        $connect= new PDO('mysql:host=localhost;dbname=restaurant','root','');
                      
    }catch(PDOexception $e){
        echo "connection failed".$e->getMessage();
    }
?>