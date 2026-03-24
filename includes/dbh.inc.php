<?php

// loading variables from .env
$env = parse_ini_file(__DIR__ ."/.env");

$host = $env["DB_HOST"];
$dbname = $env["DB_NAME"];
$dbuser = $env["DB_USER"];
$dbpass = $env["DB_PASS"];

$dsn = "mysql:host=$host;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $dbuser, $dbpass);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}