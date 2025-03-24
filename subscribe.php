<?php
require_once "./templates/header.php";
?>

<h1>Inscription</h1>
<div class="container col-7 col-sm-6 col-md-4 col-lg-3 m-auto">
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label" for="username">Non d'utilisateur</label>
            <input class="form-control" type="text" name="username" id="username">
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">Adresse email</label>
            <input class="form-control" type="email" name="email" id="email">
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Mot de passe</label>
            <input class="form-control" type="password" name="password" id="password">
        </div>
        <input class="btn btn-primary" type="submit" value="Enregister">
    </form>
</div>

<?php
require_once "./templates/footer.php";
?>