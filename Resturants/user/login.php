<?php
require_once "../includes/database.php";

    if(isset($_COOKIE['email'])){
        session_start();
        $_SESSION['email']=$_COOKIE['email'];
        
    }
    
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $u_type=$_REQUEST['type'];
        $remember = $_POST['remember'];
        $query="SELECT * FROM userData WHERE email=? and password=? and user_type=?";// ? placeholder
        $run=$connect->prepare($query);
        $run->bindValue(1,$email);
        $run->bindValue(2,$password);
        $run->bindValue(3,$u_type);
        $run->execute();
        $results=$run->fetch(PDO::FETCH_OBJ); //mysqli_fetch_assoc
        $i=0;
    
       

        if($run->rowCount() > 0){
    //after the login the users credentials will be store within the  cookie using setcookie function
            if(isset($remember)){
                    setcookie("email", $email, time()+(60*60*24)*2);
                    setcookie("password",$password, time()+(60*60*24)*2);
            }
            //and within the session also for server side verification
            session_start();
            $_SESSION['email']=$email;
            $_SESSION['user_id']= $results->id;
            $_SESSION['user_type']=$u_type; 
            header("location: ../includes/index.php");
        }
        else{
            echo "Invalid User ID or Password";
        }
    }
?>






<?php include_once "../includes/header.php"; ?>

        <center>
            <div class="card log-card" style="max-width: 500px;">
                <div class="card-header">
                    <h3 class="card-title text-center">Login Form</h3>
                    <p class="card-subtitle"></p>
                    <a href="" class="btn btn-block btn-primary "><i class="fab fa-twitter"></i> Login with Twitter</a>
                    <a href="" class="btn btn-block text-white facebook"><i class="fab fa-facebook-f"></i> Login with Facebook</a>

                    <p class="text-center" style="padding-top: 10px;">OR</p>
                
                    <form action="" onsubmit="return validL()" method="post" name="loginForm">
                        <div class="form-group input-group wi">
                            <div class="input-group-addon">
                                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                            </div>
                            <input name="email" autocomplete="" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" class="form-control" placeholder="Enter Your Registered Email Address !" type="text">
                        </div>
                        <div class="form-group input-group wi">
                            <div class="input-group-addon">
                                <span class="input-group-text "> <i class="fa fa-lock"></i> </span>
                            </div>
                            <input name="pass" class="form-control" autocomplete="off" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" placeholder="Enter Your Password !" type="password">
                        </div>
                        <input type="hidden" name="type" value="user">
                        <div class="form-group">
                            <label for="remember">Remember Me</label>
                            <input class="form-control" type="checkbox"  name="remember" id="" 
                            <?php if(isset($_COOKIE["email"])) { ?> checked
                `           <?php } ?>
                            
                            >
                        </div>
                        <div class="form-group">
                            <button class="btn btn-block btn-outline-info butt"> Login</button>
                        </div>
                    </form>
                    <a href="registration.php"  class="card-link text-danger"> You are New ! Click Me  </a>
                    
                </div>

            </div>	
        
        

    </center>



<?php include_once "../includes/footer.php"; ?>