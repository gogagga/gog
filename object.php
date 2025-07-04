<?php
session_start();
require "config.php";

$object_id = (int)$_GET["id"];
$stmt = $pdo->prepare("SELECT * FROM objects WHERE id = ?");
$stmt->execute([$object_id]);
$object = $stmt->fetch();

if (!$object) {
    die("Объект не найден");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($object["name"]) ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php include "header.php"; ?>

<div class="product-container">
    <h1><?= htmlspecialchars($object["name"]) ?></h1>
    <p><?= htmlspecialchars($object["description"]) ?></p>
    <p class="price"><?= $object["price"] ?> ₽</p>
    <button class="btn-book" id="openBookingModal">Забронировать</button>
</div>
<div id="bookingModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Бронирование <?= htmlspecialchars($object["name"]) ?></h2>
        <form action="book.php" method="post">
            <input type="hidden" name="object_id" value="<?= $object["id"] ?>">
            
            <label for="date">Выберите дату:</label>
            <input type="date" name="date" id="date" required>
            
            <label for="duration">Количество часов:</label>
            <input type="number" name="duration" id="duration" min="1" max="24" value="1">
            
            <button type="submit" class="btn-confirm">Подтвердить бронирование</button>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>

<script>
    document.getElementById("openBookingModal").onclick = function() {
        document.getElementById("bookingModal").style.display = "block";
    }

    document.querySelector(".close").onclick = function() {
        document.getElementById("bookingModal").style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById("bookingModal")) {
            document.getElementById("bookingModal").style.display = "none";
        }
    }
</script>
</body>
</html>
