<?php

use Michel\Projeto\App\Application;
use Michel\Projeto\App\Http\AuthMiddleware;
use Michel\Projeto\Models\User;

session_start();

if (isset($_SESSION['userid'])){
    header("Location: /dashboard", 200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_unset();
    session_destroy();
    if (isset($_POST['email'], $_POST['password'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (User::exists($email, $password)) {
            session_start();
            $_SESSION['user'] = $email;
            $_SESSION['userid'] = User::getIdUser($email);
            $_SESSION['id'] = session_id() . $email;
            header("Location: /dashboard");
            exit;
        } else {
            header("Location: /login", 302);
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
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>style.css">
</head>
<body>

    <div class="container">

    <a class="btn-back" href="/"><button><img src="<?php echo IMG_PATH; ?>back-icon.png" alt="back button" width="39" height="39"></button></a>

            <form id="login-register" class="algn-justify-xy" action="/login" method="POST">
                <h1 class="title-h1">Login</h1>    
                <input class="btn-input-characteristics" type="email" name="email" placeholder="Digite seu usuário">
                <input class="btn-input-characteristics" type="password" name="password" placeholder="Digite sua senha">
                <button class="btn-input-characteristics" >Entrar</button>
                <a href="/register"><p>Registre-se</p></a>
            </form>

    </div>
</body>
</html>