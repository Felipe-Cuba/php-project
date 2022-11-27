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
        <title>Document</title>

        <!-- Css -->
        <link rel="stylesheet" href="./resources/css/style.css">
    </head>

    <body class="form-body">

        <nav class="nav justify-content-end navbar">
            <ul class="nav justify-content-end me-5">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>

                <?php
                if (isset($_SESSION['idUsuario'])) {
                    if (isset($_SESSION['usertype']) and $_SESSION['usertype'] == '1') {



                ?>

                <li class="nav-item">
                    <a class="nav-link" href="admin-page.php">Admin</a>
                </li>

                <?php


                    }

                ?>
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
        <div class="align-items-center justify-content-center">
            <div class="text-center">
                <img src="./resources/imgs/anfitras.webp" width="800vw" class="rounded" alt="...">
            </div>

            <div class="text-center text-index">
                <h1>ANFITRIÃO</h1>
            </div>
        </div>




        <script src="./resources/js/jquery-3.6.1.min.js"></script>
        <script src="./resources/js/sweetalert2.all.min.js"></script>

        <script>
            function login(nome) {
                swal.fire({
                    icon: 'Success',
                    title: `Bem vindo ${nome}`,
                    text: 'O Anfitrião lhe da as boas vindas! H4H4H4H4H4H4H4H4',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#6D214F'
                });
            }

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
        </script>

        <?php
        if (isset($_SESSION['idUsuario']) and isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $parts = explode(' ', $username);
            $firstname = $parts[0];
        ?>
        <script>login('<?php echo $firstname ?>')</script>
        <?php

            $_SESSION['username'] = null;
        }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>

    </body>

</html>