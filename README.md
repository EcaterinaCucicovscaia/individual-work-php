

# Mini-Hotel — Веб-приложение для мини-отеля

## 📌 Описание

**Mini-Hotel** — это веб-приложение, предназначенное для управления бронированием номеров в мини-отеле. Проект включает в себя как общедоступные страницы для посетителей, так и защищённую админ-панель для управления данными.

## 🛠️ Технологии

- **PHP**: Серверная логика и обработка данных.
- **MySQL**: Хранение данных о бронированиях и пользователях.
- **HTML/CSS**: Структура и стилизация страниц.
- **JavaScript (необязательно)**: Для динамических элементов на клиентской стороне.

## 🚀 Запуск проекта

1. **Клонировать репозиторий**:

   ```bash
   git clone https://github.com/yourusername/mini-hotel.git
   cd mini-hotel
Настроить сервер:

Установите XAMPP или MAMP для локального сервера.

Поместите проект в директорию вашего веб-сервера (например, htdocs для XAMPP).

Настроить базу данных:

Создайте базу данных в MySQL, например, mini_hotel.

Импортируйте структуру базы данных из файла sql/schema.sql.

Настроить подключение к базе данных:

Отредактируйте файл app/db.php, указав правильные параметры подключения к вашей базе данных.

Запуск приложения:

Откройте браузер и перейдите по адресу: http://localhost/mini-hotel/public/.

📄 Структура проекта

<img width="636" height="405" alt="image" src="https://github.com/user-attachments/assets/19da561c-6f5f-4b50-8e73-a3bdb14fca2a" />


     
🧩 Функциональные возможности
Для всех пользователей
Главная страница: Динамическое отображение информации о номерах, ресторане и мероприятиях.

Форма бронирования: Возможность забронировать номер, указав имя, телефон и даты пребывания.

Форма отзывов: Оставить отзыв о пребывании в отеле.

REST API: Получение списка бронирований в формате JSON.

Для администратора
Вход в админ-панель: Защищённый доступ с использованием пароля.

Управление бронированиями: Просмотр, добавление, редактирование и удаление бронирований.

Управление пользователями: Создание новых учётных записей с ролью администратора.

🛡️ Требования безопасности
Валидация данных: Все данные, введённые пользователем, проходят валидацию для предотвращения внедрения вредоносного кода.

Аутентификация: Доступ к защищённым частям приложения осуществляется через аутентификацию.

Хэширование паролей: Пароли хранятся в базе данных с использованием безопасных хэш-функций.

Сессии: Используются сессии для управления доступом и предотвращения обхода аутентификации.

📸 Скриншоты
<img width="1918" height="982" alt="image" src="https://github.com/user-attachments/assets/7093fca0-78e8-41d4-a744-b4761ca13989" />

<img width="1918" height="592" alt="image" src="https://github.com/user-attachments/assets/87969c14-2414-4f84-889d-020b43779219" />

<img width="1918" height="685" alt="image" src="https://github.com/user-attachments/assets/ce22cb02-65b5-4d2c-b7ca-465186b1b3ec" />


📄 Примеры кода
Форма бронирования (booking.php)


<form method="post">
    <input type="text" name="name" placeholder="Имя" required>
    <input type="text" name="phone" placeholder="Телефон" required>
    <input type="number" name="room_id" placeholder="Номер комнаты" required>
    <input type="date" name="checkin" required>
    <input type="date" name="checkout" required>
    <button type="submit">Забронировать</button>
</form>

Проверка администратора (login.php)


$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    header("Location: admin.php");
    exit;
}

Получение списка бронирований через API (api.php)


$stmt = $pdo->query("SELECT id, room_id, name, phone, checkin, checkout, created_at FROM bookings ORDER BY created_at DESC");
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($bookings, JSON_UNESCAPED_UNICODE);


Целью данной индивидуальной работы являлась разработка веб-приложения для мини-отеля, включающего:

Динамическое отображение контента на страницах.

Формы для сбора данных и поиска в базе данных.

Реализацию REST API для взаимодействия с данными.

Защищённую админ-панель с возможностью управления данными.
