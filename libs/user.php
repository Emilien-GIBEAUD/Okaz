<?php

function addUser(PDO $pdo, string $username, string $email, string $password):bool {
    $query = $pdo->prepare("INSERT INTO user(username, email, password) VALUES (:username, :email, :password)");

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query->bindValue(":username", $username);
    $query->bindValue(":email", $email);
    $query->bindValue(":password", $password);
    return $query->execute();
}

// Vérification lors de l'inscription
function verifyUser($user):array|bool{
    $errors = [];
    if (isset($user["username"])) {
        // Vérification que le champ utilisateur n'est pas vide
        if ($user["username"] === ""){
            $errors["username"] = "Le champ nom d'utilisateur est obligatoire !";
        }
    } else {
        // Si le champ utilisateur a été supprimé
        $errors["username"] = "Le champ nom d'utilisateur n'as pas été envoyé !";
    }

    if (isset($user["email"])) {
        if ($user["email"] === ""){
            $errors["email"] = "Le champ adresse email est obligatoire !";
        } else {
            // Vérification que l'email est valide'
            if (!filter_var($user["email"], FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Le format de l'email n'est pas valide !";
            }
        }
    } else {
        $errors["username"] = "Le champ adresse email n'as pas été envoyé !";
    }

    if (isset($user["password"])) {
        if ($user["password"] === ""){
            $errors["password"] = "Le champ mot de passe est obligatoire !";
        } else {
            // Vérification que le mot de passe est assez fort
            // $nbchar dont 1 majuscule, 1 minuscule, 1 chiffre et 1 catactère spécial
            $nbchar = 4;    // Nombre de caractères requis.
            $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{'. preg_quote($nbchar) .',}$/';
            if (!preg_match($regex, $user["password"])) {
                $errors["password"] = "Le mot de passe doit contenir au moins ". $nbchar ." caractères dont au moins 1 majuscule, 1 minuscule, 1 chiffre et 1 catactère spécial !";
            }
        }
    } else {
        $errors["username"] = "Le champ mot de passe n'as pas été envoyé !";
    }
    if (count($errors)) {
        return $errors;
    } else {
        return true;
    }
}

// Vérification lors de la connexion d'un utilisateur
function verifyUserLoginPsw(PDO $pdo, string $email, string $password):bool|array {
    $query = $pdo->prepare("SELECT id, username, email, password FROM user WHERE email = :email");
    $query->bindValue(":email", $email);
    $query->execute();
    $user = $query-> fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        return $user;
    } else {
        return false;
    }
}
