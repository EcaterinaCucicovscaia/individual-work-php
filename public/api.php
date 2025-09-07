<?php
session_start();
require_once __DIR__ . '/../app/db.php';

header("Content-Type: application/json");

$action = $_GET['action'] ?? '';

switch ($action) {
    case "book":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $room_id = (int)($_POST['room_id'] ?? 0);
            $checkin = $_POST['checkin'] ?? '';
            $checkout = $_POST['checkout'] ?? '';

            $stmt = $pdo->prepare("INSERT INTO bookings (room_id, name, phone, checkin, checkout, created_at) 
                                   VALUES (?,?,?,?,?,NOW())");
            $stmt->execute([$room_id, $name, $phone, $checkin, $checkout]);

            echo json_encode(["status" => "ok"]);
        }
        break;

    case "list_bookings":
        // доступ только для админа
        if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            http_response_code(403);
            echo json_encode(["error" => "Access denied"]);
            exit;
        }

        // фильтры поиска
        $where = [];
        $params = [];

        if (!empty($_GET['name'])) {
            $where[] = "name LIKE ?";
            $params[] = "%" . $_GET['name'] . "%";
        }

        if (!empty($_GET['date_from'])) {
            $where[] = "checkin >= ?";
            $params[] = $_GET['date_from'];
        }

        if (!empty($_GET['date_to'])) {
            $where[] = "checkout <= ?";
            $params[] = $_GET['date_to'];
        }

        $sql = "SELECT id, room_id, name, phone, checkin, checkout, created_at 
                FROM bookings";

        if ($where) {
            $sql .= " WHERE " . implode(" AND ", $where);
        }

        $sql .= " ORDER BY created_at DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(["status" => "ok", "bookings" => $rows]);
        break;

    default:
        echo json_encode(["error" => "Unknown action"]);
}
?>