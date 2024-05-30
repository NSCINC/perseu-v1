<?php
$host = 'localhost'; // Seu host
$db = 'nome_do_banco'; // Seu banco de dados
$user = 'usuario'; // Seu usuário do banco de dados
$pass = 'senha'; // Sua senha do banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}

$email = 'usuario@example.com';
$password = password_hash('senha123', PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
$stmt->execute(['email' => $email, 'password' => $password]);

echo "Usuário criado com sucesso!";
?>
