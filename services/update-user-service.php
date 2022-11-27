<?php
require('config/connect.php');

if (isset($_POST['username']) and $_POST['username'] != '') {
    $username = $_POST['username'];
    $id = $_GET['id'];
    try {

        $smtm = $conn->prepare('SELECT * FROM `users` WHERE id = :id');
        $smtm->bindParam('id', $id);
        $smtm->execute();

        $res = $smtm->fetchAll();

        if (count($res) > 0) {
            try {
                $smtm_update = $conn->prepare('UPDATE `users` SET username = :username WHERE id = :id');
                $smtm_update->bindParam('username', $username);
                $smtm_update->bindParam('id', $id);
                $smtm_update->execute();

                header('Location: ../admin-page.php');
            } catch (PDOException $e) {

                echo 'Erro: ' . $e->getMessage();

            }


        }

    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}