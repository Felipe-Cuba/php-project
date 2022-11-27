<?php
session_start();
require('config/connect.php');

if (isset($_POST['username']) and $_POST['username'] != '') {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['pass']);

    try {
        $smtm = $conn->prepare('SELECT * FROM `users` WHERE `email` = :email');
        $smtm->bindParam('email', $email);
        $smtm->execute();
        $res = $smtm->fetchAll();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    if (count($res) > 0) {
        header('Location:../register.php?failedRegister=true');
    } else {
        try {
            $stmt = $conn->prepare('INSERT INTO users (`id`, `email`, `username`, `pass`, `active`, `usertype`) 
            values (NULL, :email, :username, :pass, 1, 2)');
            $stmt->bindParam('email', $email);
            $stmt->bindParam('username', $username);
            $stmt->bindParam('pass', $password);
            if ($stmt->execute()) {
                header('Location:../login.php');
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}