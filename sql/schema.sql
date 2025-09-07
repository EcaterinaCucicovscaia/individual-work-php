-- ========================================
-- Mini-Hotel: База данных
-- ========================================

-- Создание базы (если ещё не создана)
CREATE DATABASE IF NOT EXISTS mini_hotel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mini_hotel;

-- ========================================
-- Таблица пользователей
-- ========================================
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user'
);

-- Добавляем администратора
INSERT INTO users (username, password, role) 
VALUES ('admin', MD5('admin123'), 'admin');

-- ========================================
-- Таблица броней
-- ========================================
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    checkin DATE NOT NULL,
    checkout DATE NOT NULL,
    created_at DATETIME NOT NULL
);

-- Пример начальных броней (для теста)
INSERT INTO bookings (room_id, name, phone, checkin, checkout, created_at)
VALUES
(101, 'Иван Иванов', '+37361234567', '2025-09-10', '2025-09-15', NOW()),
(102, 'Мария Петрова', '+37369876543', '2025-09-12', '2025-09-14', NOW()),
(103, 'Алексей Смирнов', '+37362223344', '2025-09-15', '2025-09-18', NOW());
