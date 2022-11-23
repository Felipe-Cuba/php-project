<?php
require('config/connect.php');
session_start();

if (isset($_POST['pass']) && isset($_SESSION['id_usuario'])) {
    $id = $_SESSION['id_usuario'];
    $pass = md5($_POST['pass']);
    $confirmpass = md5($_POST['confirmpass']);

    if ($pass == $confirmpass) {
        try {
            $smtm = $conn->prepare('UPDATE `users` SET `pass` = :pass WHERE `id` = :id');
            $smtm->bindParam('pass', $pass);
            $smtm->bindParam('id', $id);

            if ($smtm->execute()) {
                header("Location:../login.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        header("Location:../forgot-password.php");
    }


}