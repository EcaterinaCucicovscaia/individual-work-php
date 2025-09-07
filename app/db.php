<?php
$host = "localhost";
$db   = "mini_hotel";
$user = "root";     // стандартный XAMPP
$pass = "";         // пароль пустой по умолчанию

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе: " . $e->getMessage());
}
