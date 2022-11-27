<?php
ini_set('default_charset', 'utf-8');
require('./services/config/connect.php');
session_start();

$smtm = $conn->prepare('SELECT * FROM `users`');
$smtm->execute();
$res = $smtm->fetchAll();
?>

<!doctype html>
<html lang="pt-br">

    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

        <!-- Css -->
        <link rel="stylesheet" href="./resources/css/style.css">

        <!-- Fontawesome Icons -->
        <script src="https://kit.fontawesome.com/4ccb67a440.js" crossorigin="anonymous"></script>

        <!-- SweetAlert Script -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>

    <body>

        <nav class="nav justify-content-end navbar">
            <ul class="nav   me-5">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <?php
                if (isset($_SESSION['idUsuario'])) {
                    if (isset($_SESSION['usertype']) and $_SESSION['usertype'] == '1') {



                ?>

                <li class="nav-item">
                    <a class="nav-link active" href="admin-page.php">Admin</a>
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

        <div class="container">
            <div class="row">
                <table id="usertable" class="table table-striped table-light justify-content-center align-items-center"
                    style="width:100%">
                    <thead class="justify-content-center align-items-center">
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Tipo de usuário</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    if (count($res) > 0) {
                    ?>
                    <tbody class="">
                        <?php
                        foreach ($res as $row) {
                        ?>
                        <tr class="">
                            <td>
                                <?php echo $row['id']; ?>
                            </td>
                            <td>
                                <?php echo $row['username']; ?>
                            </td>
                            <td>
                                <?php echo $row['email']; ?>
                            </td>
                            <td>
                                <?php echo $row['active'] == '1' ? 'Ativo' : 'Desativado'; ?>
                            </td>
                            <td>
                                <?php echo $row['usertype'] == '1' ? 'Administrador' : 'Comum'; ?>
                            </td>
                            <td><a href="./update-user.php?id=<?php echo $row['id'] ?>"
                                    class="btn btn-primary">Editar</a>
                            </td>
                            <?php
                            if ($row['active'] == '1') {


                            ?>
                            <td>
                                <a href="./services/delete-service.php?id=<?php echo $row['id'] ?>"
                                    class="btn btn-danger">Deletar</a>
                            </td>
                            <?php
                            } else {
                            ?>
                            <td>
                                <a href="./services/reactive-service.php?id=<?php echo $row['id'] ?>"
                                    class="btn btn-success">Reativar</a>
                            </td>
                            <?php
                            }
                            ?>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <?php

                    }
                    ?>
                </table>
            </div>
        </div>




        <script src="./resources/js/jquery-3.6.1.min.js"></script>
        <script src="./resources/js/sweetalert2.all.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#usertable').DataTable();
            });
            $('.btn-danger').on('click', function (e) {
                e.preventDefault();
                const href = $(this).attr('href');

                Swal.fire({
                    title: 'Atenção!!',
                    text: 'Essa ação desativará um usuário, isso fará com que ele não consiga acessar o site novamente. Deseja continuar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3b8746',
                    cancelButtonColor: '#bd2630',
                    confirmButtonText: 'Continuar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        document.location.href = href;
                    }
                })
            })

            $('.btn-success').on('click', function (e) {
                e.preventDefault();
                const href = $(this).attr('href');

                Swal.fire({
                    title: 'Atenção!!',
                    text: 'Essa ação reativará um usuário, isso fará com que ele consiga acessar o site novamente. Deseja continuar?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3b8746',
                    cancelButtonColor: '#bd2630',
                    confirmButtonText: 'Continuar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        document.location.href = href;
                    }
                })
            })

            $('.btn-primary').on('click', function (e) {
                e.preventDefault();
                const href = $(this).attr('href');

                Swal.fire({
                    title: 'Atenção!!',
                    text: 'Deseja editar esse usuário?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3b8746',
                    cancelButtonColor: '#bd2630',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        document.location.href = href;
                    }
                })
            });

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


        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
            </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
            integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
            </script>
    </body>

</html>