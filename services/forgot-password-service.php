<?php
require('config/connect.php');
session_start();

if (isset($_POST['email'])) {
    $email = $_POST['email'];

    try {
        $smtm = $conn->prepare('SELECT * FROM `users` WHERE `email` = :email');
        $smtm->bindParam('email', $email);
        $smtm->execute();
        $res = $smtm->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    if (count($res) > 0) {
        foreach ($res as $row) {
            $id = $row['id'];
        }

        $_SESSION['idUsuario'] = $id;
        header("Location:../forgot-password.php?exists=true");
    } else {
        header("Location:../login.php");
    }
}