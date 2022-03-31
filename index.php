<?php
    session_start();

    require 'database.php';

    if(isset($_SESSION['user_id'])){
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($results) > 0) {
            $user = $results;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CUENTAS DE USUARIO</title>
    <link href="https://fonts.googleapis.com/css?family=Bebas Neue" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body background = image/fondo1.jpg>

    <header>
        <a href="/sign-in"> Homepage </a>
    </header>

    <?php if(!empty($user)): ?>
    
        <br>Welcome <?= $user['email'] ?>
        <br>You are Successfully Logged In
        <a href="logout.php"> Logout</a>
    
    <?php else: ?>

    <h1> Please Login or SignUp </h1>
    
    <a href="login.php"> Login </a> or 
    <a href="signup.php"> SignUp </a> 

    <?php endif; ?>
</body>
</html>