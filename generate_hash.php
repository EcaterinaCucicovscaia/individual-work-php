<?php
// Задаём пароль, который хотим хэшировать
$password = '11111'; // <-- замените на ваш пароль

// Генерируем безопасный хэш
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Хэш для пароля '$password': $hash";
