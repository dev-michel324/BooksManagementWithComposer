<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Usuario</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>style.css">
</head>
<body>
    <form action="/logout" method="POST">
        <button class="btn-input-characteristics btn-logout">Sair</button>
    </form>

    <div class="container">
        <h1 class="title-h1">Olá, <?php echo $_SESSION['user']; ?></h1>

        <section>
            <h1 class="title-h1">Todos os Livros</h1>

            <?php include __DIR__ . "/book/listBooks.php"; ?>
        </section>

        <section>
            <h1 class="title-h1">Livros Emprestados</h1>

            <?php include __DIR__ . "/lending/listLendings.php"; ?>
        </section>

    </div>

        <a href="/books/add" class="actions-books" id="add-book"><button class="btn-input-characteristics">Adicionar Livro</button></a>
        <a href="/lending/add" class="actions-books" id="get-lending"><button class="btn-input-characteristics">Pegar Emprestado</button></a>

    </body>
</html>