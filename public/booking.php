<?php
require_once __DIR__ . '/../app/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO bookings (room_id, name, phone, checkin, checkout, created_at) VALUES (?,?,?,?,?,NOW())");
    $stmt->execute([$_POST['room_id'], $_POST['name'], $_POST['phone'], $_POST['checkin'], $_POST['checkout']]);
    echo "<p>Бронь успешно создана!</p>";
}
?>
 <form method="post">
            Имя: <input type="text" name="name" required><br>
            Телефон: <input type="text" name="phone" required><br>
            ID комнаты: <input type="number" name="room_id" required><br>
            Заезд: <input type="date" name="checkin" required><br>
            Выезд: <input type="date" name="checkout" required><br>
            <button type="submit">Забронировать</button>
        </form>
