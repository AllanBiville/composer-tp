<?php
include "../vendor/autoload.php";

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Biviall\ComposerTp\Entities\User;
use Biviall\ComposerTp\Manager\UserManager;

$loader = new FilesystemLoader('../templates');
$twig = new Environment($loader, ['cache' => '../cache']);

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['role'])) {
    try {
        include "conf.php";
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $userManager = new UserManager($db);
        $user = $userManager->getOne($_GET['id']);
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user->setRole($_POST['role']);
        $userManager->update($user);

        header("location:index.php");
    } catch (PDOException $e) {
        print('<br/>Erreur de connexion : ' . $e->getMessage());
    }
}
echo $twig->render('update_user.html.twig', [
    'title' => 'Supprimer utilisateur',  
    'id' => $_GET['id'],
]);
?>

