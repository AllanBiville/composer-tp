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
        $user = new User(["email" => $_POST['email'], "password" => $_POST['password'], "role" => $_POST['role']]);
        $userManager->add($user);
        header("location:index.php");
    } catch (PDOException $e) {
        print('<br/>Erreur de connexion : ' . $e->getMessage());
    }
}
echo $twig->render('add_user.html.twig', [
    'title' => 'Ajouter utilisateur', 
    'users' => $users,
    
]);
?>

            
