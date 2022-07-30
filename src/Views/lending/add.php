<?php
    use Michel\Projeto\App\Http\AuthMiddleware;
    use Michel\Projeto\Models\Lendings;
    use Michel\Projeto\Models\Book;

    AuthMiddleware::authenticated();

    if ($_SERVER['REQUEST_METHOD'] === "POST"){
        if(isset($_POST['title'], $_POST['author'])){
            $idBook = Book::getIdFromBook($_POST['title'], $_POST['author']);
            if (!$idBook){
                header("Location: /lending/add");
                exit;
            }
            $lending = new Lendings($_SESSION['userid'], $idBook);
            if(!Lendings::existsLending($idBook)){
                $lending->save();
                header("Location: /dashboard");
                exit;
            }
        }
        header("Location: /lending");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimos</title>
    <link rel="stylesheet" href="/<?php echo CSS_PATH; ?>style.css">
</head>
<body>
<div class="container">

<a class="btn-back" href="/dashboard"><button><img src="/<?php echo IMG_PATH; ?>back-icon.png" alt="back button" width="39" height="39"></button></a>

    <div class="register-form">
        
        <form action="/lending/add" class="algn-justify-xy" method="POST">
        <h1 class="title-h1">Pegar Livro</h1>
            <input class="btn-input-characteristics" type="text" name="title" placeholder="Titulo do Livro" required>
            <input class="btn-input-characteristics" type="text" name="author" placeholder="Autor do Livro" required>
            <button class="btn-input-characteristics algn-center-horizontal">Salvar</button>
        </form>
    </div>

</div>

</body>
</html>