<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warning</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="warning_message">
        <p class="warning">Warning</p>
        <?php echo 'Check your email or password'?>
        <?php  echo "<p>
                <a href='login.php'>Try to login again!</a>
            </p>";
            ?>

    </div>
</body>
</html>