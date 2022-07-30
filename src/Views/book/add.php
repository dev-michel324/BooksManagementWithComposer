<?php
use Michel\Projeto\Models\Book;
use Michel\Projeto\Models\Model;
use Michel\Projeto\App\Http\AuthMiddleware;

AuthMiddleware::authenticated();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['title'], $_POST['year'], $_POST['author'], $_SESSION['userid'])) {
        $book = new Book($_POST['title'], $_POST['year'], $_POST['author'], $_SESSION['userid']);
        if (!Book::exists($_POST['title'], $_POST['author'])){
            $book->save();
            header("Location: /dashboard", true, 302);
            exit();
        }
        header("Location: /books/bookexists", true, 302);
        exit();
    }
    header("Location: /books/add", true, 200);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar livro</title>
    <link rel="stylesheet" href="/<?php echo CSS_PATH; ?>style.css">
</head>
<body>

    <div class="container">

    <a class="btn-back" href="/dashboard"><button><img src="/<?php echo IMG_PATH; ?>back-icon.png" alt="back button" width="39" height="39"></button></a>

        <div class="register-form">
            
            <form action="/books/add" class="algn-justify-xy" method="POST">
            <h1 class="title-h1">Registro de Livros</h1>
                <input class="btn-input-characteristics" type="text" name="title" placeholder="Titulo do Livro" required>
                <input class="btn-input-characteristics" type="text" name="author" placeholder="Autor do Livro" required>
                <input class="btn-input-characteristics" type="number" name="year" placeholder="Ano de lançamento" required>
                <button class="btn-input-characteristics algn-center-horizontal">Salvar</button>
            </form>
        </div>
    
    </div>
    
</body>
</html>