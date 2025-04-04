<?php
require_once "./templates/header.php";
require_once "./libs/pdo.php";
require_once "./libs/user.php";

$error = null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = verifyUserLoginPsw($pdo, $_POST["email"], $_POST["password"]);
    if ($user) {
        session_regenerate_id(true);
        $_SESSION["user"] = [
            "id" => $user["id"],
            "username" => $user["username"]
        ];
        header("Location: index.php");
    } else {
        $error = "Email et/ou mot de passe erroné !";
    }
}

?>

<h1>Connexion</h1>
<div class="container col-7 col-sm-6 col-md-4 col-lg-3 m-auto">
    <form method="post">

        <div class="form-floating mb-3">
            <input name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Adresse email</label>
        </div>
        <div class="form-floating">
            <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Mot de passe</label>
        </div>

        <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Se souvenir de moi
            </label>
        </div>
        
        <?php if (isset($error)) { ?>
                <div class="alert alert-danger" role="alert">
                <?= $error?>
                </div>
            <?php } ?>


        <button class="btn btn-primary w-100 py-2" type="submit">Connexion</button>
    </form>
</div>

<?php
require_once "./templates/footer.php";
?>