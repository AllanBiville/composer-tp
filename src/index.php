<?php
include "../vendor/autoload.php";

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Biviall\ComposerTp\Manager\UserManager;

$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader, ['cache' => '../cache']);

try {
    include "conf.php";
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $userManager = new UserManager($db);
    $users = $userManager->getAll();



} catch (PDOException $e) {
    print('<br/>Erreur de connexion : ' . $e->getMessage());
}
echo $twig->render('index.html.twig', [
    'title' => 'Liste des utilisateurs', 
    'users' => $users,
]);
?>

