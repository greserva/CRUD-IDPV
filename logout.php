<?php
require __DIR__ . "/includes.php";
session_start();
session_unset();
session_destroy();
header('Location: '. SITE_URL . 'login.php');

if($_POST['logout'] == 1)
{
    require __DIR__ . "/includes.php";
    session_start();
    session_unset();
    session_destroy();
    header('Location: '. SITE_URL . 'login.php');
    echo json_encode(['msg' => "Deslogado"]);
}
?>