<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./Assets/css/override-bootstrap.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Okaz</title>
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img width="120" src="./Assets/img/logo-okaz.png" alt="Logo de Okaz">
                </a>
            </div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2">Accueil</a></li>
                <li><a href="annonces.php" class="nav-link px-2">Annonces</a></li>
            </ul>

            <div class="col-md-3 text-end">
                <?php if (isset($_SESSION["user"])) { ?>
                    <span>Bonjour <?= $_SESSION["user"]["username"]?></span>
                    <a class="btn btn-primary" href="logout.php">Déconnexion</a>
                <?php  }else { ?>
                    <a class="btn btn-outline-primary m-2" href="login.php">Connexion</a>
                    <a class="btn btn-primary" href="subscribe.php">Inscription</a>
                <?php } ?>
            </div>
        </header>

        <main>
