<?php
require('config/connect.php');
session_start();

if (isset($_SESSION['idUsuario'])) {
    $id = $_SESSION['idUsuario'];
} else {
    header('Location: ../index.php?updateUser=false');
}

if (isset($_POST['username']) and $_POST['username'] != '') {
    $username = $_POST['username'];

    try {
        $smtm = $conn->prepare('UPDATE `users` SET `username` = :username WHERE id = :id');
        $smtm->bindParam('username', $username);
        $smtm->bindParam('id', $id);

        if ($smtm->execute()) {
            header('Location: ../profile-page.php');
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

if (isset($_POST['password'])  and $_POST['password'] != '') {
    $password = md5($_POST['password']);

    try {
        $smtm = $conn->prepare('UPDATE `users` SET `pass` = :pass WHERE id = :id');
        $smtm->bindParam('pass', $password);
        $smtm->bindParam('id', $id);

        if ($smtm->execute()) {
            header('Location: ../profile-page.php?passwordUpdate=true');
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}