<?php
require('config/connect.php');
session_start();

if (isset($_POST['pass']) and isset($_SESSION['idUsuario'])) {
    $id = $_SESSION['idUsuario'];
    $pass = md5($_POST['pass']);
    $confirmpass = md5($_POST['confirmpass']);
    
    if ($pass == $confirmpass) {
        try {
            $smtm = $conn->prepare('UPDATE `users` SET `pass` = :pass WHERE `id` = :id');
            $smtm->bindParam('pass', $pass);
            $smtm->bindParam('id', $id);

            if ($smtm->execute()) {
                session_destroy();
                header("Location:../login.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        header("Location:../forgot-password.php");
    }


}