<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "teste";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Connection successfuly';
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
