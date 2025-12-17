<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        header('Location: index.php#auth?error=empty');
        exit;
    }
    
    $stmt = $pdo->prepare("SELECT id, email, password, full_name FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_name'] = $user['full_name'];
        
        header('Location: account.php');
        exit;
    } else {
        header('Location: index.php#auth?error=invalid');
        exit;
    }
} else {
    header('Location: index.php');
    exit;
}
?>
