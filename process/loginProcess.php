<?php
require('../assets/config/connect.php');

if (isset($_POST['email']) and $_POST['email'] != '') {

    $email = $_POST['email'];
    $pass = $_POST['password'];

    try {
        $smtm = $conn->prepare('SELECT * FROM `users` WHERE `email` = :email AND `pass` = :pass');
        $smtm->bindParam('email', $email);
        $smtm->bindParam('password', md5($password));
        $smtm->execute();

        $res = $smtm->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    if (count($res) > 0) {
        foreach ($res as $row) {
            $id = $row['id'];
        }
        if(!isset($_SESSION))
			session_start();
			$_SESSION["id_usuario"] = $id;
			header("Location:../index.php");
    } else {
      header("Location:../login.php");

    }

}
