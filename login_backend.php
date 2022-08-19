<?php
session_start();

$connection = new mysqli('localhost:3307', 'root', 'root', 'book_store');
if(isset($_POST['login'])){
      $email = $_POST['email'];
      $password = $_POST['password'];
       
      $validation_flag = false;

      if(strlen($email) < 10){
		$validation_flag = true;
        header('location: message.php');
       
		
	}

    if(strlen($password) < 6){
		$validation_flag = true;
		header('location: message.php');
	}

      if(!$validation_flag){
        $password = md5($password);
        $query = "SELECT * FROM user WHERE email='$email' AND password='$password'";
        
        $result = $connection->query($query);

        $user = $result->fetch_assoc();

        if($user){
            $_SESSION['auth'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email'=> $user['email'],
                'password' => $user['password']
                
            ];
            $_SESSION['authenticated'] = true;

            header('location: book.php');

        }else{
            header('location: user_access.php');
        }
    }
    
}

 if(isset($_GET['logout'])){
	session_destroy();
	header('location: login.php');
 }