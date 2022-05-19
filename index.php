<?php
include('settings.php');
include('bot_lib.php');


login($connect);


?>









<!doctype html>
<html lang="en">
  <head>
  	<title>Galaktika bot</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
   

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Sign In</h3>
			   <form action="index.php" class="login-form" method="POST">
		      		<div class="form-group">
		      			<input type="text" name="username" class="form-control rounded-left" placeholder="Username" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" name="pass" class="form-control rounded-left" placeholder="Password" required>
	            </div>
	            <div class="form-group">
	            	<button type="submit" name="submit_log" class="form-control btn btn-primary rounded submit px-3">Login</button>
	            </div>

	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	</body>
</html>

