<?php
session_start();
require_once __DIR__ . '/../app/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header("Location: admin.php");
        exit;
    } else {
        $error = "Неверный логин или пароль!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Вход</title></head>
<body>
    <h1>Вход для администратора</h1>
    <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="username" placeholder="Логин" required><br>
        <input type="password" name="password" placeholder="Пароль" required><br>
        <button type="submit">Войти</button>
    </form>
</body>
</html>
