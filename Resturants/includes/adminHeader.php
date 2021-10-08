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
			<a class="navbar-brand" href="../includes/index.php"><img src="../images/a2zshop.png" style="max-width: 200px;" alt="A2zshop"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		
			<div class="collapse navbar-collapse" id="navbarContent">
				<span class="mr-auto"></span>
				<ul class="navbar-nav ">
					
					<?php if(session_id()==""){
						session_start();	
					}?>
					<?php if(!isset($_SESSION['admin_id'] ) or $_SESSION['type']!="admin"){?>
        				<li class="nav-item active">
						<a class="nav-link nav-pill" href="../admin/login.php">Login </span></a>
						</li>
					<?php }else { ?>
						<li class="nav-item active">
						<a class="nav-link nav-pill" href="../admin/dashboard.php">Dashboard </span></a>
						</li>
						<li class="nav-item active">
						<a class="nav-link nav-pill" href="../admin/addProduct.php">Your Product </span></a>
					</li>
						<li class="nav-item active">
						<a class="nav-link nav-pill" href="../admin/logout.php">Logout </span></a>
						</li>

					<?php }?>
		
					
				</ul>
				
			</div>
		</nav>
		