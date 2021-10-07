<?php
include "../vendor/autoload.php";

use Biviall\ComposerTp\Manager\UserManager;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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

        if ($userManager->update($user)) {
            print("<div class='alert alert-success' role='alert'>
            <h4 class='alert-heading'>Super !</h4>
            <p>Aucune erreur. Redirection vers l'accueil du site web dans <b>3 secondes.</b></p>
            <hr>
            <p class='mb-0'>Vous pouvez retourner à l'accueil du site web via ce lien : <a href='index.php' class='alert-link'><i class='fas fa-link'></i> index.php</a></p>
            </div>");
            print("<meta http-equiv='refresh' content='3;URL=index.php'>");
        } else {
            print("<div class='alert alert-danger' role='alert'>
            <h4 class='alert-heading'>Erreur web !</h4>
            <p>Malheuresement il y a une erreur, l'utilisateur n'a pas été mis à jour.</p>
            <hr>
            <p class='mb-0'>Vous pouvez retourner à l'accueil du site web via ce lien : <a href='index.php' class='alert-link'><i class='fas fa-link'></i> index.php</a></p>
            </div>");
        }

    } catch (PDOException $e) {
        print('<br/>Erreur de connexion : ' . $e->getMessage());
    }
}
echo $twig->render('update_user.html.twig', [
    'title' => 'Modifier utilisateur',
    'id' => $_GET['id'],
]);
