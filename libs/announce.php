<?php

// Ajout d'une annonce avec ou sans image
function addAnnounce(PDO $pdo, string $title, int $price, string $description, string $image, int $user_id, int $category_id):bool {
    // gestion de l'image (https://www.w3schools.com/php/php_file_upload.asp)
    if ($_FILES["image"]["name"] ==="") {
        // Si aucune image n'est saisie
        $image = "";
    } else {
        $target_dir = "./uploads/listing/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $image = uniqid($_FILES["image"]["name"] . "_", true) . "." . $imageFileType;
        $target_file_uid = $target_dir . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_uid);
    }

    // Mise en BDD
    $query = $pdo->prepare("INSERT INTO listing(title, price, description, image, user_id, category_id) VALUES (:title, :price, :description, :image, :user_id, :category_id)");
    $query->bindValue(":title", $title);
    $query->bindValue(":price", $price, PDO::PARAM_INT);    // Gérer l'absence de prix saisi
    $query->bindValue(":description", $description);
    $query->bindValue(":image", $image);
    $query->bindValue(":user_id", $user_id, PDO::PARAM_INT);   // à gérer
    $query->bindValue(":category_id", $category_id, PDO::PARAM_INT);   // à gérer
    return $query->execute();
}

// Vérification des données saisies
function verifyAnnounce($announce):array|bool{
    $errors = [];
    if (isset($announce["title"])) {
        // Vérification que le champ titre n'est pas vide
        if ($announce["title"] === ""){
            $errors["title"] = "Le champ titre est obligatoire !";
        }
    } else {
        // Si le champ titre a été supprimé
        $errors["title"] = "Le champ titre n'a pas été envoyé !";
    }

    if (isset($announce["price"])) {
        // Vérification que le champ prix n'est pas vide
        if ($announce["price"] === ""){
            $errors["price"] = "Le champ prix est obligatoire !";
        }
    } else {
        // Si le champ prix a été supprimé
        $errors["price"] = "Le champ prix n'a pas été envoyé !";
    }

    if (isset($announce["description"])) {
        // Vérification que le champ description n'est pas vide
        if ($announce["description"] === ""){
            $errors["description"] = "Le champ description est obligatoire !";
        }
    } else {
        // Si le champ description a été supprimé
        $errors["description"] = "Le champ description n'a pas été envoyé !";
    }

    if (count($errors)) {
        return $errors;
    } else {
        return true;
    }
}

function verifyImage($image):array|bool{
    // Si aucune image n'est saisie
    if ($_FILES["image"]["name"] ==="") {
        return true;
    }

    $errorsImage = [];
    $uploadOk = 1;
    // Vérification qu'il s'agit bien d'une vrai image
    $check = getimagesize($image["image"]["tmp_name"]);
    if ($check === false) {
        $errorsImage["image"] = "Ce fichier n'est pas une image.";
        $uploadOk = 0;
    }
    // Vérification de la taille du fichier (en B)
    $maxSize = 4000000;
    if ($_FILES["image"]["size"] > $maxSize && $uploadOk === 1) {
        $errorsImage["image"] = "Le fichier image doit avoir un taille inférieur à " . $maxSize/1000000 . " MB.";
        $uploadOk = 0;
    }
    // Vérification du type d'image
    $target_dir = "./uploads/listing/";
    $target_file = $target_dir . basename($image["image"]["name"]);
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $uploadOk === 1) {
        $errorsImage["image"] = "Seul les fichiers jpg, jpeg et png sont autorisés.";
    }
    if (count($errorsImage)) {
        return $errorsImage;
    } else {
        return true;
    }
}