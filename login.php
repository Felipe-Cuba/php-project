<!doctype html>
<html lang="pt-br">

    <head>
        <title>Entrar</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

        <!-- Css -->
        <link rel="stylesheet" href="./resources/css/style.css">

        <!-- Scripts -->
        <script type="text/javascript" src="./resources/js/index.js"></script>

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

                            <form method="post" action="./services/login-service.php">
                                <h4 class="card-title title-form">
                                    SE CONECTE AO ANFITRIÃO
                                </h4>
                                <div class="hide" id="alertForm">
                                    <div class="alert alert-danger" role="alert">
                                        Email ou senha incorretos!
                                        Verefique os dois e tente novamente
                                    </div>
                                </div>
                                <div class="form-group my-2">
                                    <label for="emailAddress">Endereço de email</label>
                                    <input type="email" class="form-control form-control-sm form-text input-text" id="emailAddress"
                                        name="email" required autofocus >

                                </div>

                                <div class="form-group my-2">
                                    <label for="password">Senha</label>
                                    <input type="password" class="form-control form-control-sm form-text input-text" id="password"
                                        name="pass" required>
                                    <a href="forgot-password.php" class="form-links">Esqueceu a senha?</a>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-forms my-2"
                                        type="button">Conectar</button>
                                </div>

                                <div class="singup">
                                    Não tem uma conta? <a href="register.php" class="form-links">Clique aqui</a>
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

        <?php

            if (isset($_GET['loginFailed']) and $_GET['loginFailed'] == 'true') {
                echo "<script type='text/javascript'> showAlert() </script>";
            }

            ?>
    </body>

</html>