<?php
session_start();
require "config.php";
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <h1>Категории</h1>
        <div class="cards">
            <?php foreach ($categories as $cat): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($cat["name"]) ?></h3>
                    <a href="category.php?id=<?= $cat["id"] ?>">Смотреть</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
