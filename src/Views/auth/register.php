<?php

use Michel\Projeto\Models\User;

session_start();

if (isset($_SESSION['userid'])){
    header("Location: /dashboard", 200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {

        $user = new User($_POST['name'], $_POST['email'], $_POST['password']);

        if (!User::exists($_POST['email'], $_POST['password'])) {
            $user->save();

            session_start();
            $_SESSION['user']=$_POST['email'];
            $_SESSION['id']=session_id() . $_POST['email'];

            header("Location: /dashboard", true, 302);
            exit;
        } else {
            header("Location: /login", true, 302);
            exit;
        }
    }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastra-se</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>style.css">
</head>
<body>

    <div class="container">

    <a class="btn-back" href="/login"><button><img src="<?php echo IMG_PATH; ?>back-icon.png" alt="back button" width="39" height="39"></button></a>

    <form id="login-register" class="algn-justify-xy" action="/register" method="POST">
        <h1 class="title-h1">Registro de Usuário</h1>
        <input class="btn-input-characteristics" type="text" name="name" placeholder="Digite seu nome">
        <input class="btn-input-characteristics" type="email" name="email" placeholder="Digite seu email">
        <input class="btn-input-characteristics" type="password" name="password" placeholder="Digite sua senha">
        <button class="btn-input-characteristics">Registrar</button>
    </form>
    </div>

    
</body>
</html>