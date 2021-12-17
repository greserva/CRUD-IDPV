<?php require dirname(__DIR__) . "/includes.php"; ?>
<?php
    session_start();
    if(!isset($_SESSION['logado'])){
      header('Location: '. SITE_URL . 'login.php');
    }
?>
<?php error_reporting(E_ERROR | E_WARNING | E_PARSE); ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="../assets/js/timer.js"></script>
    <title>CRUD-IDPV</title>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="nav">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CRUD</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= SITE_URL . 'index.php' ?>">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ações
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= SITE_URL . 'pages/cargo.php' ?>">Cargo</a></li>
            <li><a class="dropdown-item" href="<?= SITE_URL . 'pages/usuario.php' ?>">Usuário</a></li>
            <li><a class="dropdown-item" href="<?= SITE_URL . 'pages/departamento.php' ?>">Departamento</a></li>
            <li><a class="dropdown-item" href="<?= SITE_URL . 'pages/centro-de-custo.php' ?>">Centro de Custo</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= SITE_URL . '/logout.php' ?>">Logout</a>
        </li>
        <li class="nav-item">
          <div id="contador"><h6>Sessão expira em <span id="time">60:00</span> minutos</h6></div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<body>