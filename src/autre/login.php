<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://kit.fontawesome.com/2696450378.js" crossorigin="anonymous"></script>
    <title>POO - Login / CRUD</title>
</head>
<body>
<?php
include "UserManager.php";
?>
<h2>Connectez-vous</h2>
            <form  class="form-signin" method="POST">
                <input type="text" name="email"     id="email" class="form-control form-group" placeholder="### Email" autofocus>
                <input type="password" name="password" id="password" class="form-control form-group" placeholder="### Password">
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Se connecter</button>
                <a href="register.php" class="btn btn-lg btn-secondary btn-block btn-signin">S'inscrire</a>
            </form>


            </body>
</html>
