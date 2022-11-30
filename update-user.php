<?php
require('./services/config/connect.php');
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $smtm = $conn->prepare('SELECT * FROM `users` WHERE id = :id');
        $smtm->bindParam('id', $id);
        $smtm->execute();

        $res = $smtm->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    foreach ($res as $row) {
        $usertype = $row['usertype'];
        $username = $row['username'];
        $email = $row['email'];
    }
}

?>
<!doctype html>
<html lang="pt-br">

    <head>
        <title>Alterar Usuário</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

        <!-- Css -->
        <link rel="stylesheet" href="./resources/css/style.css">

    </head>

    <body class="form-body">
        <main>
            <div class="global-container vh-100 justify-content-center align-items-center">
                <div class="card login-form">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="./resources/imgs/anfitras.webp" alt="" height="150">
                            <h3 class="card-title title-form">
                                H4H4H4H4H4H4
                            </h3>
                        </div>
                        <div class="card-text mb-4 mt-4">

                            <form method="post" action="./services/update-user-service.php?id=<?php echo $id ?>" onsubmit="return submitForm(this)">
                                <h4 class="card-title title-form">
                                    H4H4H4H4H4H4H4H4H4H4H4H4
                                </h4>

                                <div hidden class="form-group my-2">
                                    <label for="emailAddress">Nome de usuário</label>
                                    <input type="email" class="form-control form-control-sm form-text input-text" id="emailAddress"
                                        name="id" value="<?php echo $id ?>" required autofocus disabled>
                                </div>

                                <div class="form-group my-2">
                                    <label for="emailAddress">Nome de usuário</label>
                                    <input type="text" class="form-control form-control-sm form-text input-text" id="emailAddress"
                                        name="username" value="<?php echo $username ?>" required autofocus>
                                </div>

                                <div class="form-group my-2">
                                    <label for="emailAddress">Endereço de email</label>
                                    <input type="email" class="form-control form-control-sm form-text input-text" id="emailAddress"
                                        name="email" value="<?php echo $email ?>" required autofocus disabled>
                                </div>

                                <?php
                                if ($usertype == '2') {
                                ?>

                                <div class="d-grid gap-2">
                                    <a href="services/transform-to-admin-service.php?id=<?php echo $id ?>"
                                        class="btn btn-primary btn-forms button-admin my-2" type="button">Tornar administrador</a>
                                </div>
                                <?php
                                }
                                ?>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-forms button-edit my-2"
                                        type="button">Alterar</button>
                                </div>

                                <div class="d-grid gap-2">
                                    <a href="admin-page.php" class="btn btn-primary btn-forms my-2"
                                        type="button">Voltar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
            </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
            integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
            </script>

        <script src="./resources/js/jquery-3.6.1.min.js"></script>
        <script src="./resources/js/sweetalert2.all.min.js"></script>

        <script>
            $('.button-admin').on('click', function (e) {
                e.preventDefault();
                const href = $(this).attr('href');

                Swal.fire({
                    title: 'Atenção!!',
                    text: 'Tem certeza que deseja tornar esse usuário um administrador? Ele terá acesso total ao sistema. Essa ação é irreversível, deseja continuar?',
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
            });
        </script>
    </body>

</html>