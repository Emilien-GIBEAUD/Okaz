<?php
require_once "./templates/header.php";
require_once "./libs/pdo.php";
require_once "./libs/user.php";

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $verif = verifyUser($_POST);
    if ($verif === true) {
        $rstAdd = addUser($pdo, $_POST["username"], $_POST["email"], $_POST["password"]);
    } else {
        $errors = $verif;
    }
}

?>

<h1>Inscription</h1>
<div class="container col-7 col-sm-6 col-md-4 col-lg-3 m-auto">
    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label" for="username">Non d'utilisateur</label>
            <input class="form-control" type="text" name="username" id="username">

            <?php if (isset($errors["username"])) { ?>
                <div class="alert alert-danger" role="alert">
                <?= $errors["username"]?>
                </div>
            <?php } ?>

        </div>
        <div class="mb-3">
            <label class="form-label" for="email">Adresse email</label>
            <input class="form-control" type="email" name="email" id="email">

            <?php if (isset($errors["email"])) { ?>
                <div class="alert alert-danger" role="alert">
                <?= $errors["email"]?>
                </div>
            <?php } ?>

        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Mot de passe</label>
            <input class="form-control" type="password" name="password" id="password">

            <?php if (isset($errors["password"])) { ?>
                <div class="alert alert-danger" role="alert">
                <?= $errors["password"]?>
                </div>
            <?php } ?>

        </div>
        <input class="btn btn-primary" type="submit" value="Enregister" name="add_user">
    </form>
</div>

<?php
require_once "./templates/footer.php";
?>