<?php
session_start();
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$host = $_ENV['DB_HOST'];
$db   = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASSWORD'];
$port=$_ENV['DB_PORT'];

try {

  $conn = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);

  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo "<script>alert('Database connection failed!'); window.location.href='index.php';</script>";
    // $__SESSION['error']="Connection failed. Please try again later.";
    // $__SESSION['error_admin']=$e->getMessage();
    // header("Location: connfailed.php"); 
    exit();
}


?>