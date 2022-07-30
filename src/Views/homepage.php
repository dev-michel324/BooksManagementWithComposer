<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>style.css">
</head>
<body>

    <?php 
        session_start();
        if (isset($_SESSION['userid'])){
            echo '<form action="/logout" method="POST">'.
                '<button class="btn-input-characteristics btn-logout">Sair</button>'.
                '</form>';
        }
    ?>

<div class="container">

    <h1 class="title-h1">Home Page</h1>

    <div class="btns-logreg-home algn-center-horizontal">
        <a href="/login"><button class="btn-input-characteristics">Entrar</button></a>
        <a href="/register"><button class="btn-input-characteristics">Registrar</button></a>
    </div>

    <section>

    <h1 class="title-h1">Livros</h1>

    <?php include __DIR__ . "/book/listBooks.php" ?>

    </section>

    </div>
</body>
</html>