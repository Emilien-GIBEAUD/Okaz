<?php
require_once "./templates/header.php";
require_once "./libs/category.php";
require_once "./libs/pdo.php";
require_once "./libs/announce.php";

// Liste des catégories disponnibles
$categories = getCategories();

// var_dump($_SESSION["user"]["id"]);
// var_dump($_SESSION["user"]["username"]);
// var_dump($_POST["title"]);
var_dump($_FILES["image"]);
// Mise en BDD des données saisies
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $rstAdd = addAnnounce($pdo, $_POST["title"], $_POST["price"], $_POST["description"], $_FILES["image"]["name"], $_SESSION["user"]["id"], 1);
    // var_dump($rstAdd);
}

?>

<h1>Ajouter une annonce</h1>
<div class="container col-10 col-md-8 col-lg-6 m-auto">
    <form action="" method="post" enctype="multipart/form-data">    <!--  -->
        <div class="mb-3">
            <label class="form-label" for="title">Titre</label>
            <input class="form-control" type="text" name="title" id="title">
        </div>
        <div class="mb-3">
            <label class="form-label" for="price">Prix</label>
            <input class="form-control" type="number" name="price" id="price">
        </div>
        <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Photo (jpg, jpeg ou png de 4 MB au maximum)</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
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