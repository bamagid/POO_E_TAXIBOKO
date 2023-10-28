<?php
$host = 'localhost:3307';
$dbname = 'e_taxiboko';
$username = 'root';
$password = 'Magid';

try {
    global $bdd;
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>