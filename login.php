<?php

session_start();
if (isset($_SESSION['id'])) {

  header('Location: index.php');
  }

include'lib/Login.php';
$msg = '';

if (isset($_POST['btn'])) {
    $login = new Login();
    $msg = $login->adminLoginCheck($_POST);
    
}




 ?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 50px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
<body>
<div class="login-form">
    <form action="" method="post">
        <h2 class="text-center">Log in</h2> 
        <h3><?php echo $msg; ?></h3>      
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Email" name="email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block" name="btn">Log in</button>
        </div>        
    </form>
    <p class="text-center">Don't have account ? <a href="register.php">Create an Account</a></p>
</div>
</body>
</html>                                		                            