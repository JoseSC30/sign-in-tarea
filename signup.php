<?php
    require 'database.php';

    $message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        $message = 'Successfuly created new user';
    } else {
        $message = 'Sorry there must have been an issue creating your account';
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Bebas Neue" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body background = image/fondo1.jpg>

    <header>
        <a href="/sign-in"> Homepage </a>
    </header>

    <?php if(!empty($message)): ?>
        <p><?= $message ?> </p>
    <?php endif; ?>

    <h1>SignUp</h1>

    <form action= "signup.php" method= "post">
        <input type="text" name="email" placeholder="Enter your mail">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="password" name="confirm_password" placeholder="Confirm your password">
        <input type="submit" value="Send"> 
    </form>

</body>
</html>