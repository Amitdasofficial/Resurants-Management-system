<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	  	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Restaurant Website</title>
		<link rel="stylesheet" type="text/css" href="../css/glyphicon.css">
	  	<link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css"> 
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="index.php"><img src="../images/a2zshop.png" style="max-width: 200px;" alt="A2zshop"></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
			
				<div class="collapse navbar-collapse" id="navbarContent">
					<span class="mr-auto"></span>
					<ul class="navbar-nav ">
						<li class="nav-item active">
							<a class="nav-link nav-pills" href="../includes/index.php">Home </span></a>
						</li>
						<?php if(session_id()==""){
							session_start();	
						}?>
						<?php if(!isset($_SESSION['user_id']) or !isset($_SESSION['email']) or $_SESSION['user_type'] != "user" ){?>
							<li class="nav-item active">
							<a class="nav-link nav-pills" href="../user/login.php">Login </span></a>
							</li>
						<?php }else { ?>
							<li class="nav-item active">
							<a class="nav-link nav-pills-pill" href="../user/yourAccount.php">Your Account </span></a>
							</li>
							<li class="nav-item active">
							<a class="nav-link nav-pills" href="../user/logout.php">Logout </span></a>
							</li>

						<?php }?>
			
						
					</ul>
					<form class="form-inline my-2 my-lg-0">
						<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
					</form>
				</div>
			</div>
		</nav>
		<br>
		