<?php require __DIR__.'/vendor/autoload.php' ?>
<?php 
    session_start();
    if(isset($_SESSION['logado'])){
        header("location:index.php");
    }
    use App\Model\UsuarioDAO;
    $usuario = new UsuarioDAO();
    unset($error_vazio);
    unset($error_login);
    unset($error_senha);
    if(!empty($_POST['log']) && $_POST['log'] == 1):
        if(!empty($_POST['email']) && !empty($_POST['senha'])){
            $login = $usuario->login($_POST['email']);
            $verify = password_verify($_POST['senha'], $login[0]['senha']);
            if(empty($login)){
                $error_login = true;
            }
            else if(!$verify){
                $error_senha = true;
            }
            else if($verify){
                $_SESSION['logado'] = true;
                header("Location: index.php");
            }
        }else{
            $error_vazio = true;
        }
    endif;

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Login</title>
</head>
<body>

    <?php if(isset($error_vazio)): ?>
        <div class="alert alert-danger" role="alert">
            Campos Vazios!
        </div>
    <?php endif; ?>
    <?php if(isset($error_login)): ?>
        <div class="alert alert-danger" role="alert">
            Usuario não encontrado!
        </div>
    <?php endif; ?>
    <?php if(isset($error_senha)): ?>
        <div class="alert alert-danger" role="alert">
            Senha incorreta!
        </div>
    <?php endif; ?>
    <div class="container">
        <form method="post">
            <h1 class="display-5">Login</h1>
            <input type="hidden" name="log" value="1">
            <div class="mb-3">
                <label for="login" class="form-label">Email</label>
                <i class="bi bi-at"></i><input type="text" class="form-control" required name="email" placeholder="Email">
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <i class="bi bi-door-open-fill"></i><input type="password" class="form-control" required name="senha" placeholder="Senha">
            </div>
            <button type="submit" class="btn btn-primary login">Login</button>
        </form>
    </div>
</body>
</html>