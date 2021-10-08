<?php 
    //login form for Admin 
    //this page redirect to Add Product 

    require_once "../includes/database.php";
    //If Cookie set previously
    


    // Fetching Data and Match data
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $type=$_POST['type'];
        //$remember=$_POST['rem'];
        
        
        $sql="select *from admin where email=? and password=? and user_type=?";
        $query=$connect->prepare($sql);
        $query->bindValue(1,$email);
        $query->bindValue(2,$pass);
        $query->bindValue(3,$type);
        $query->execute();
        $result=$query->fetch(PDO::FETCH_OBJ);
        if($query->rowCount()>0){
            /*if(isset($remember)){
                setcookie("email", $email, time()+(60*60*24)*2);
                setcookie("password",$password, time()+(60*60*24)*2);
                setcookie("type",$type, time()+(60*60*24)*2);
            }*/

            session_start();
            $_SESSION['email']=$email;
            $_SESSION['admin_id']=$result->id;
            $_SESSION['type']=$type;

            header("location: addProduct.php");
        }


    }


?>
<?php include_once "../includes/adminHeader.php"?>

<center>
            <div class="card log-card" style="max-width: 500px;margin-top:20px;">
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
                        <input type="hidden" name="type" value="admin">
                    <!---    <div class="form-group">
                            <label for="remember">Remember Me</label>
                            <input class="form-control" type="checkbox"  name="rem" id="" 
                            
                            >
                        </div> --->
                        <div class="form-group">
                            <button class="btn btn-block btn-outline-info butt"> Login</button>
                        </div>
                    </form>
                    <a href="/bootstrap/registration.php"  class="card-link text-danger"> You are New ! Click Me  </a>
                    
                </div>

            </div>	
        
        

    </center>










<?php include_once "../includes/footer.php"?>
