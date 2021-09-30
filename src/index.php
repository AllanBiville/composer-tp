<?php
require_once '../vendor/autoload.php';

use UserManager;
use conf;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

$logger = new Logger('main');
$logger->pushHandler(new StreamHandler(__DIR__ . '/../log/app.log', Logger::INFO));
$logger->info('First Message');
$logger->debug('Second Message');
print("1) OK <br/>");
$loader = new FilesystemLoader('../templates');
print("2) OK <br/>");
$twig = new Environment($loader, ['cache' => '../cache']);
print("3) OK <br/>");
try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $userManager = new UserManager($db);
    echo $twig->render('base.html.twig', ['title' => 'Liste des utilisateurs', 'Users' => $userManager-getAll()]);
} catch (\Throwable $th) {
    //throw $th;
}


?>
