<?php require __DIR__.'/vendor/autoload.php'; ?>
<?php
use Dotenv;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();
define('SITE_URL', $_ENV['APP_URL']);
?>
