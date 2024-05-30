<?php
$host = 'localhost'; // Seu host
$db = 'users.db'; // Seu banco de dados
$user = 'usuario'; // Seu usuário do banco de dados
$pass = '666476'; // Sua senha do banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: registro.php?error=E-mail inválido");
        exit;
    }

    if (strlen($password) < 6) {
        header("Location: registro.php?error=Senha deve ter pelo menos 6 caracteres");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        header("Location: registro.php?error=E-mail já registrado");
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
    $stmt->execute(['email' => $email, 'password' => $passwordHash]);

    header("Location: main.html");
    exit;
} else {
    header("Location: registro.php");
    exit;
}
?>
