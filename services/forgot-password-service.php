<?php
require('config/connect.php');

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
        if(!isset($_SESSION)){
            session_start();
			$_SESSION["id_usuario"] = $id;
			header("Location:../forgot-password.php?exists=true");
            echo "DEU CERTO!";
        }
    } else {
      header("Location:../login.php");
    }

}