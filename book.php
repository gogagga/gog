<?php
session_start();
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST["object_id"], $_POST["date"])) {
        die("Ошибка: недостаточно данных для бронирования");
    }

    $user_id = $_SESSION["user_id"];
    $object_id = $_POST["object_id"];
    $date = $_POST["date"];

    $stmt = $pdo->prepare("INSERT INTO bookings (user_id, object_id, date) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $object_id, $date]);

    echo "Бронирование успешно создано!";
}
?>
<br><a href="index.php">На главную</a>
