<?php
require "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->execute([
        $_POST["username"],
        $_POST["email"],
        password_hash($_POST["password"], PASSWORD_DEFAULT)
    ]);
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <form method="post" class="form">
            <h2>Регистрация</h2>
            <input type="text" name="username" placeholder="Имя пользователя" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
