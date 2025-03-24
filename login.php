<?php
require_once "./templates/header.php";
?>

<h1>Connexion</h1>
<div class="container col-7 col-sm-6 col-md-4 col-lg-3 m-auto">
    <form method="post">

        <div class="form-floating">
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
        <button class="btn btn-primary w-100 py-2" type="submit">Connexion</button>
    </form>
</div>

<?php
require_once "./templates/footer.php";
?>