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

    <script type="text/javascript">
        function sucesso() {
            setTimeout(() => {
                document.querySelector("body").setAttribute("class", "success");
                setTimeout("window.location='index.php'", 500);
            }, 1500);


        }
        function falha() {
            setTimeout(() => {
                document.querySelector("body").setAttribute("class", "failed");
                setTimeout("window.location='login.php'", 500);
            }, 1500);
        }
    </script>

</head>

<body>

    <main>
        <div class="text-center loading">
            <div class="spinner-border text-light" style="width: 10rem; height: 10rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <?php
        if (isset($_GET['login'])) {
            $login = $_GET['login'];

            if ($login == 'true') {
                echo "<script type='text/javascript'> sucesso() </script>";
            } else {
                echo "<script type='text/javascript'> falha() </script>";
            }
        }
        ?>
    </main>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
</body>

</html>