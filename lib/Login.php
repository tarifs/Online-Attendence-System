<?php 
include 'Db.php';

/**
 * summary
 */
class Login
{
    /**
     * summary
     */
    public function adminLoginCheck($data)
    {
    	$email = $data['email'];
    	$password = md5($data['password']);

    	$sql = "SELECT * FROM users WHERE email = '$email' AND password ='$password'";

    	if (mysqli_query(Db::dbConnection(),$sql)) {

    		$result = mysqli_query(Db::dbConnection(),$sql);
    		$use = mysqli_fetch_assoc($result);

    		if ($use) {
    			 session_start();
                $_SESSION['id']=$use['id'];

    			header('Location: index.php');
    			
    		}else {
    			$msg = "<div class='alert alert-danger'>Please Input Valid Email & Password</div>";
    			return $msg;
    		}
    		
    	}else{
    		die('Connection Error'.mysqli_error(Db::dbConnection()));
    	}


        
    }


    public function logout()
    {
    	unset($_SESSION['id']);
    	header('Location: login.php');
    	
    }


    public function register($data)
    {
    	$name = $data['name'];
    	$email = $data['email'];
    	$password = md5($data['password']);


    	$sql = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";

    	if (mysqli_query(Db::dbConnection(),$sql)) {

    		$msg = "<div class='alert alert-success'>Registration Successfully done</div>";
    			return $msg;
    		
    	}else{
    		die('Connection Error'.mysqli_error(Db::dbConnection()));
    	}
    }
}





 ?>