<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>

<body>

    <?php
    session_start();
    require('../assets/config/connect.php');

    if (isset($_POST['username']) and $_POST['username'] != '') {

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        try {
            $stmt = $conn->prepare('INSERT INTO users (`id`, `email`, `username`, `pass`, `active`) values (NULL, :email, :username, :pass, 1)');
            $stmt->bindParam('email', $email);
            $stmt->bindParam('username', $username);
            $stmt->bindParam('pass', $password);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        header('Location:../login.php');
    } else {
        echo "<div class='erro'><a href='../register.php'><h2>Voce deve preencher todos os campos!!!</h2></a></div>";
    }
    ?>
</body>

</html>