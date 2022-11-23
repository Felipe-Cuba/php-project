<?php
require('config/connect.php');

if (isset($_POST['email']) and $_POST['email'] != '') {

    $email = $_POST['email'];
    $pass = md5($_POST['pass']);

    try {
        $smtm = $conn->prepare('SELECT * FROM `users` WHERE `email` = :email AND `pass` = :pass');
        $smtm->bindParam('email', $email);
        $smtm->bindParam('pass', $pass);
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
			header("Location:../loading-page.php?login=true");
            echo "DEU CERTO!";
        }
    } else {
      header("Location:../loading-page.php?login=false");
    }

}
