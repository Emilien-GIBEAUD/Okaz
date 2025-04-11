<?php
require_once "./templates/header.php";
require_once "./libs/listing.php";
require_once "./libs/pdo.php";
require_once "./libs/category.php";

// Gestion des filtres
$filters = [];
if(isset($_GET["search"]) && $_GET["search"] !== "") {
    $filters["search"] = $_GET["search"];
}
if(isset($_GET["min_price"]) && $_GET["min_price"] !== "") {
    $filters["min_price"] = $_GET["min_price"];
}
if(isset($_GET["max_price"]) && $_GET["max_price"] !== "") {
    $filters["max_price"] = $_GET["max_price"];
}
if(isset($_GET["category"])) {
    $filters["category"] = $_GET["category"];
}

$listings = getListings($pdo, $filters);

// Liste des catégories disponnibles
$categories = getCategories($pdo);

?>

<div class="row">
    <h1>Les annonces</h1>
</div>

<div class="row">
    <div class="col-md-3">
        <form action="" method="get">
            <h2>Filtres</h2>
            <div class="p-2 border-bottom">
                <input type="text" name="search" class="form-control" placeholder="Rechercher" 
                value="<?php 
                    if(isset($_GET["search"])){
                        echo htmlspecialchars($_GET["search"]);
                    } ?>" >
            </div>
            <div class="p-2 border-bottom">
                <label for="price">Prix : </label>
                <div class="input-group p-1">
                    <input type="number" name="min_price" class="form-control" placeholder="mini" 
                    value="<?php 
                    if(isset($_GET["min_price"])){
                        echo htmlspecialchars($_GET["min_price"]);
                    } ?>" >
                    <span class="input-group-text">€</span>
                </div>
                <div class="input-group p-1">
                    <input type="number" name="max_price" class="form-control" placeholder="maxi" 
                    value="<?php 
                    if(isset($_GET["max_price"])){
                        echo htmlspecialchars($_GET["max_price"]);
                    } ?>" >
                    <span class="input-group-text">€</span>
                </div>
            </div>
            <div class="p-2 border-bottom">
                <label class="form-label" for="category">Catégorie :</label>
                <select name="category" id="category" class="form-select">
                    <option value>- catégorie -</option>    
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category["id"]?>" 
                            <?php if (isset($category["id"]) && $category["id"] == $_GET["category"]) {
                                    echo 'selected="selected"';
                                } ?>>
                            <?= $category["name"] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mt-2">
                <button class="btn btn-primary w-100" type="submit">Filtrer</button>
            </div>
        </form>
    </div>

    <div class="col-md-9">
        <div class="row">
            <?php
            foreach ($listings as $key => $listing) {
                require "./templates/listing_part.php";
            }
            ?>
        </div>
    </div>
</div>


<?php
require_once "./templates/footer.php";
?>