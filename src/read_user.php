<?php
include "../vendor/autoload.php";

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Biviall\ComposerTp\Entities\User;
use Biviall\ComposerTp\Manager\UserManager;

$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader, ['cache' => '../cache']);

if (isset($_GET['id'])) {
    try {
        include "conf.php";
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $userManager = new UserManager($db);
        $user = $userManager->getOne($_GET['id']);
    } catch (PDOException $e) {
        print('<br/>Erreur de connexion : ' . $e->getMessage());
    }
}
echo $twig->render('read_user.html.twig', [
    'title' => 'Voir utilisateur', 
    'user' => $user,
]);
?>
