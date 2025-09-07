<?php
session_start();

// доступ только для админа
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// собираем URL для API с фильтрами
$query = http_build_query([
    "action" => "list_bookings",
    "name" => $_GET['name'] ?? null,
    "date_from" => $_GET['date_from'] ?? null,
    "date_to" => $_GET['date_to'] ?? null
]);

$apiUrl = "http://localhost/mini-hotel/public/api.php?$query";

// передаём cookie для авторизации
$opts = [
    "http" => [
        "header" => "Cookie: " . session_name() . "=" . session_id() . "\r\n"
    ]
];
$context = stream_context_create($opts);
$response = file_get_contents($apiUrl, false, $context);
$data = json_decode($response, true);
$bookings = $data['bookings'] ?? [];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Админ-панель</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f4f4f4; }
        form { margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Админ-панель — список броней</h1>
    <p><a href="logout.php">Выйти</a></p>

    <!-- Форма поиска -->
    <form method="get" action="admin.php">
        <input type="text" name="name" placeholder="Имя клиента" value="<?= htmlspecialchars($_GET['name'] ?? '') ?>">
        <input type="date" name="date_from" value="<?= htmlspecialchars($_GET['date_from'] ?? '') ?>">
        <input type="date" name="date_to" value="<?= htmlspecialchars($_GET['date_to'] ?? '') ?>">
        <button type="submit">Поиск</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>ID комнаты</th>
            <th>Имя клиента</th>
            <th>Телефон</th>
            <th>Дата заезда</th>
            <th>Дата выезда</th>
            <th>Дата бронирования</th>
        </tr>
        <?php foreach ($bookings as $b): ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= $b['room_id'] ?></td>
            <td><?= htmlspecialchars($b['name']) ?></td>
            <td><?= htmlspecialchars($b['phone']) ?></td>
            <td><?= $b['checkin'] ?></td>
            <td><?= $b['checkout'] ?></td>
            <td><?= $b['created_at'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
