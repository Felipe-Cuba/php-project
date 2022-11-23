<?php
$host = "localhost";
$user = "root";
$pass = "root";
$dbname = "cultista_arrependido";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'Connection successfuly';
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
