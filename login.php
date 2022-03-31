<?php
    
    session_start();

    if(isset($_SESSION['user_id'])) {
        header('Location: /sign-in');
    }

    require 'database.php';

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
        $records->bindParam(':email', $_POST['email']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
            $_SESSION['user_id'] = $results['id'];
            header('Location: /sign-in');
        } else {
            $message = 'Sorry, Those credentials do not match';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Bebas Neue" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body background = image/fondo1.jpg>

    <header>
        <a href="/sign-in"> Homepage </a>
    </header>

    <h1> Login </h1>

    <?php if(!empty($message)): ?>
        <p><?= $message ?> </p>
    <?php endif; ?>

    <form action= "login.php" method= "post">
        <input type="text" name="email" placeholder="Enter your mail">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="submit" value="Send"> 
    </form>
</body>
</html>