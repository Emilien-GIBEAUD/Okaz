<?php

// Ajout d'une annonce
function addAnnounce(PDO $pdo, string $title, int $price, string $description, string $image, int $user_id, int $category_id):bool {
    //gestion de l'image (https://www.w3schools.com/php/php_file_upload.asp)
    $target_dir = "./uploads/listing/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // => pour conserver les extensions en majuscules
    if ($_FILES["image"]["name"] ==="") {
        // Si aucune image n'est saisie
        $image = "";
    } else {
        // Vérification qu'il s'agit bien d'une vrai image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }
        // // Check if file already exists  => géré par l'uid a priori
        // if (file_exists($target_file)) {
        //     echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }
        // Vérification de la taille du fichier (4000 KB max)
        if ($_FILES["image"]["size"] > 4000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Vérification du type d'image
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG") {
            echo "Sorry, only jpg, jpeg & png files are allowed.";
            $uploadOk = 0;
        }
        // Envoie du fichier si tout est ok
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            $image = uniqid($_FILES["image"]["name"] . "_", true) . "." . $imageFileType;
            $target_file_uid = $target_dir . $image;
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_uid)) {
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Mise en BDD
    if ($uploadOk == 1) {
        $query = $pdo->prepare("INSERT INTO listing(title, price, description, image, user_id, category_id) VALUES (:title, :price, :description, :image, :user_id, :category_id)");
        $query->bindValue(":title", $title);
        $query->bindValue(":price", $price, PDO::PARAM_INT);    // Gérer l'absence de prix saisi
        $query->bindValue(":description", $description);
        $query->bindValue(":image", $image);
        $query->bindValue(":user_id", $user_id, PDO::PARAM_INT);   // à gérer
        $query->bindValue(":category_id", $category_id, PDO::PARAM_INT);   // à gérer
        return $query->execute();
    }    
}


// Vérification des données saisies
