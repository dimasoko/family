<?php
// Настройки подключения
$host = '127.0.1.15'; // Используем IP, чтобы VPN не мешал
$db   = 'my_family_space'; // Имя базы, которую мы создали
$user = 'root'; // Стандартный логин в Open Server
$pass = ''; // Стандартный пароль (пустой)
$charset = 'utf8mb4';

// Настройка DSN (Data Source Name)
$dsn = "mysql:host=$host;port=3306;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Показывать ошибки
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Получать данные как ассоциативный массив
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Создаем подключение
    $pdo = new PDO($dsn, $user, $pass, $options);
    // Раскомментируй строку ниже, если хочешь проверить подключение на экране
    // echo "Подключение к БД успешно!"; 
} catch (\PDOException $e) {
    // Если ошибка - показываем её
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>
