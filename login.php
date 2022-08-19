<?php
session_start();
if(!isset($_SESSION['authenticated'])){
    header('location: book.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="continar_form">
    <form method="post" action="login_backend.php">
    <label for="">Email</form>
    <input type="email" name="email"  required placeholder="Type your email here...">
    <br>
    <br>

    <label for="">Password</form>
    <input type="password" name="password" required placeholder="Type your password here...">
    <br>
    <br>

    <button class="submit" type="submit" name="login">Login</button>
    </form>
    </div>
</body>
</html>

