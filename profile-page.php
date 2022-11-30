<?php
ini_set('default_charset', 'utf-8');
require('./services/config/connect.php');
session_start();


?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Anfitras</title>

        <!-- Css -->
        <link rel="stylesheet" href="./resources/css/style.css">
    </head>

    <body>

        <nav class="nav justify-content-end navbar">
            <ul class="nav justify-content-end me-5">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <?php
                if (isset($_SESSION['idUsuario'])) {
                    $id = $_SESSION['idUsuario'];

                    if (isset($_SESSION['usertype']) and $_SESSION['usertype'] == '1') {



                ?>

                <li class="nav-item">
                    <a class="nav-link" href="admin-page.php">Admin</a>
                </li>

                <?php


                    }

                ?>
                <li class="nav-item">
                    <a class="nav-link active" href="profile-page.php">Perfil</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link logout" href="logout.php">Logout</a>
                </li>
                <?php
                } else {


                ?>

                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>

                <?php

                }
                ?>
            </ul>
        </nav>

        <?php
        try {
            $smtm = $conn->prepare('SELECT * FROM `users` WHERE id = :id');
            $smtm->bindParam(':id', $id);
            $smtm->execute();
            $res = $smtm->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if (isset($res)) {
            if (count($res) > 0) {
                foreach ($res as $row) {
                    $username = $row['username'];
                    $email = $row['email'];
                }

        ?>
        <div class="justify-content-center align-items-center d-flex flex-row">
            <div class="card text-center mt-5 profile-form">
                <div class="card-header">
                    <p class="title-card-user">
                        INFORMAÇÕES DO USUÁRIO
                    </p>
                </div>
                <div class="card-body">
                    <form action="./services/update-user-profile-service.php" method="post">
                        <div class="form-group my-2">
                            <label for="userName">Nome de usuário</label>
                            <input type="text" class="form-control form-control-sm form-text profile-form-input"
                                id="userName" name="username" placeholder="<?php echo $username ?>">
                        </div>
                        <div class="form-group my-2">
                            <label for="email">Seu email</label>
                            <input type="email" class="form-control form-control-sm form-text profile-form-input "
                                id="email" value="<?php echo $email ?>" disabled>
                        </div>
                        <div class="form-group my-2">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control form-control-sm form-text profile-form-input "
                                id="password" name="password">
                        </div>
                        <div class="form-group my-2">
                            <input type="submit"
                                class="btn-profile form-control form-control-sm form-textprofile-form-input btn mt-4"
                                value="Alterar">
                        </div>
                    </form>
                </div>

            </div>
        </div>


        <?php
            }
        }

        ?>

        <script src="./resources/js/jquery-3.6.1.min.js"></script>
        <script src="./resources/js/sweetalert2.all.min.js"></script>

        <script>
            function logout(href) {
                swal.fire({
                    title: `H4H4H4H4H4H4H`,
                    text: 'Nunca se esqueça, aqueles que se conectam com o anfitrião nunca mais voltam a ser os mesmos! Até mais H4H4H4H4H4H4H',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6D214F'
                }).then((result) => {
                    if (result.value) {
                        document.location.href = href;
                    }
                })
            }

            $('.logout').on('click', function (e) {
                e.preventDefault();
                const href = $(this).attr('href');

                Swal.fire({
                    title: 'Deseja se desconectar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3b8746',
                    cancelButtonColor: '#bd2630',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Não'
                }).then((result) => {
                    if (result.value) {
                        logout(href);
                    }
                })
            });

            function updatePassword() {
                swal.fire({
                    icon: 'Success',
                    title: `Senha alterada com sucesso`,
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6D214F'
                })
            }
        </script>

        <?php
        if (isset($_GET['passwordUpdate']) and $_GET['passwordUpdate'] == 'true') {
        ?>
        <script>
            updatePassword();
        </script>
        <?php
        }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>

    </body>

</html>