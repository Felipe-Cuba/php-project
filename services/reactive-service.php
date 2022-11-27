<?php
require('config/connect.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $id;
    echo gettype($id);
    try {
        $smtm = $conn->prepare('UPDATE `users` SET active=1 WHERE id = :id');
        $smtm->bindParam(':id', $id);
        $smtm->execute();

        header('Location: ../admin-page.php');
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}