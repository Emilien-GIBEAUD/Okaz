<?php
require_once "./templates/header.php";
require_once "./libs/category.php";

$categories = getCategories();
?>

<h1>Ajouter une annonce</h1>
<div class="container col-10 col-md-8 col-lg-6 m-auto">
    <form action="" method="post">
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
            <label for="imageInput" class="form-label">Photo</label>
            <input type="file" class="form-control" id="imageInput">
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