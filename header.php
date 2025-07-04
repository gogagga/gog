<nav class="navbar">
    <div class="logo">
        <a href="index.php">BookingSystem</a>
    </div>
    <div class="menu">
        <?php if (isset($_SESSION["user_id"])): ?>
            <span>Здравствуйте, <?= htmlspecialchars($_SESSION["username"]) ?>!</span>
            <a href="logout.php">Выход</a>
        <?php else: ?>
            <a href="register.php">Регистрация</a>
            <a href="login.php">Вход</a>
        <?php endif; ?>
    </div>
</nav>
