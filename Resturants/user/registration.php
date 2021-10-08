<?php session_start(); 
	require_once "../includes/database.php";
	// Its check the method through which the form is submitted
	//
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$name=$_REQUEST['fullname'];
		$email=$_REQUEST['email'];//
		$mobile=$_REQUEST['mobile'];
        $password=$_REQUEST['password'];
        $u_type=$_REQUEST['type'];
		$query=$connect->prepare("select email from userData where email= ? ");//? placeholder
		$query->bindValue(1,$email);
		$query->execute();
		if($query->rowCount()>0){
		echo "email already exist";
			
		}
		else{
			$sql="insert into userData (name,email,mobile,password,user_type)values(:name,:email,:mobile,:password,:u_type)";
	
			$statement = $connect->prepare($sql);
			//name placeholder
			if ($statement->execute([':name' => $name, ':email' => $email,':mobile'=>$mobile,':password'=>$password,':u_type'=>$u_type])) {
			header('location:login.php');
			//echo  'data inserted successfully';
			}
		  }
		  }
	
?>
<?php include_once "../includes/header.php"; ?>

		<center>	
			<div class="card bg-light reg-card" style="max-width: 500px;">
				<h4 class="card-title text-center">Create Account</h4>
				<p class="card-subtitle text-center">Get Started With Your Free Account !</p>
				<div>
					<a href="#" class="btn btn-block btn-primary wi"> <i class="fab fa-twitter"></i> Sign up Via Twitter</a>
					<a href="#" class="btn btn-block facebook text-white wi "> <i class="fab fa-facebook-f"></i> Sign up Via Facebook</a>
					</div>
					<div>
						<p style="text-align: center;padding-top: 10px;">OR</p>
					</div>
					<form action="" method="post" onsubmit="return valid()" name="registrationForm">
						<div class="form-group input-group wi">
							<div class="input-group-addon">
								<span class="input-group-text"> <i class="fa fa-user"></i> </span>
							</div>
							<input name="fullname" autocomplete="" class="form-control" placeholder="Full name" type="text">
						</div>
						<div class="form-group input-group wi">
							<div class="input-group-addon">
								<span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
							</div>
							<input name="email" autocomplete="" class="form-control" placeholder="Email Address" type="text">
						</div>
						<div class="form-group input-group wi">
							<div class="input-group-addon">
								<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
							</div>
							<input name="mobile" autocomplete="" class="form-control" placeholder="Mobile Number" type="text">
						</div>
						<div class="form-group input-group wi">
							<div class="input-group-addon">
								<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
							</div>
							<input name="password" autocomplete="" class="form-control" placeholder="Password" type="password">
						</div>
						<div class="form-group input-group wi">
							<div class="input-group-addon">
								<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
							</div>
							<input name="conPass" class="form-control" placeholder="Confirm Password" type="password">
                        </div>
                        <input type="hidden" name="type" value="user">
						<div class="form-group">
							<button class="btn btn-block btn-outline-info butt"> Create Account</button>
						</div>
						
					</form>
					<a href="login.php"> You have an Account ! Click Me</a>

			</div>
	   </center>
		



	<?php include_once "../includes/footer.php"; ?>