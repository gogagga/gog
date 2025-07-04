<?php
require "config.php";

$category_id = $_GET["id"] ?? 0;

$stmt = $pdo->prepare("SELECT * FROM objects WHERE category_id = ?");
$stmt->execute([$category_id]);
$objects = $stmt->fetchAll();

$stmt2 = $pdo->prepare("SELECT name FROM categories WHERE id = ?");
$stmt2->execute([$category_id]);
$category_name = $stmt2->fetchColumn();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($category_name) ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include "header.php"; ?>
    <div class="container">
        <h1><?= htmlspecialchars($category_name) ?></h1>
        <div class="cards">
            <?php foreach ($objects as $obj): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($obj["name"]) ?></h3>
                    <p><?= htmlspecialchars($obj["description"]) ?></p>
                    <p>Цена: <?= $obj["price"] ?> ₽</p>
                    <a href="object.php?id=<?= $obj["id"] ?>">Подробнее</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
