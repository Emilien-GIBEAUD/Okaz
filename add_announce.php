<?php
require_once "./templates/header.php";
require_once "./libs/category.php";
require_once "./libs/pdo.php";
require_once "./libs/announce.php";

// Liste des catégories disponnibles
$categories = getCategories($pdo);

// var_dump($_SESSION["user"]["id"]);
// var_dump($user);
// var_dump($_SESSION["user"]["id"]);
// var_dump($_SESSION["user"]["username"]);
// var_dump($_POST["category"]);
// var_dump((int)$_POST["category"]+1);
// var_dump($_FILES["image"]);

// Vérification qu'un utilisateur est connecté
if (!isset($_SESSION["user"]["id"])) {
    header("Location: login.php");
} 

// Mise en BDD des données saisies
$errors = [];
$errorsImage = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $verif = verifyAnnounce($_POST);
    $verifImage = verifyImage($_FILES);
    if ($verif === true && $verifImage === true) {
        $rstAdd = addAnnounce($pdo, $_POST["title"], $_POST["price"], $_POST["description"], $_FILES["image"]["name"], $_SESSION["user"]["id"], (int)$_POST["category"]+1);
        header("Location: index.php");
    } else {
        $errors = $verif;
        $errorsImage = $verifImage;
    }
} 

?>

<h1>Ajouter une annonce</h1>
<div class="container col-10 col-md-8 col-lg-6 m-auto">
    <form action="" method="post" enctype="multipart/form-data">    <!--  -->
        <div class="mb-3">
            <label class="form-label" for="title">Titre</label>
            <input class="form-control" type="text" name="title" id="title">

            <?php if (isset($errors["title"])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errors["title"]?>
                </div>
            <?php } ?>

        </div>
        <div class="mb-3">
            <label class="form-label" for="price">Prix</label>
            <input class="form-control" type="number" name="price" id="price">

            <?php if (isset($errors["price"])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errors["price"]?>
                </div>
            <?php } ?>

        </div>
        <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="5"></textarea>

            <?php if (isset($errors["description"])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errors["description"]?>
                </div>
            <?php } ?>

        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Photo (jpg, jpeg ou png de 4 MB au maximum)</label>
            <input type="file" name="image" class="form-control" id="image">

            <?php if (isset($errorsImage["image"])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errorsImage["image"]?>
                </div>
            <?php } ?>

Image        </div>
        <div class="mb-3">
            <label class="form-label" for="category">Categorie</label>
            <select name="category" id="category" class="form-select">
                <?php foreach ($categories as $key => $category) { ?>
                    <option value="<?= $key ?>"><?= $category["name"] ?></option>
                <?php } ?>
            </select>
        </div>
        <input class="btn btn-primary" type="submit" value="Enregister">
    </form>
</div>

<?php
require_once "./templates/footer.php";
?>