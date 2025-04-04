<?php
require_once "./templates/header.php";
require_once "./libs/listing.php";
require_once "./libs/pdo.php";

$listings = getListings($pdo);

?>

<div class="row">
    <h1>Les annonces</h1>
</div>

<div class="row">
    <div class="col-md-3">
        <form action="" method="get"></form>
        <h2>Filtres</h2>
        <div class="p-2 border-bottom">
            <input type="text" name="search" class="form-control" placeholder="Rechercher">
        </div>
        <div class="p-2 border-bottom">
            <label for="price">Prix : </label>
            <div class="input-group p-1">
                <input type="number" name="min_price" class="form-control" placeholder="Prix minimum">
                <span class="input-group-text">€</span>
            </div>
            <div class="input-group p-1">
                <input type="number" name="max_price" class="form-control" placeholder="Prix maximum">
                <span class="input-group-text">€</span>
            </div>
        </div>
        <div class="mt-2">
            <button class="btn btn-primary w-100">Filtrer</button>
        </div>
    </div>

    <div class="col-md-9">
        <div class="row">
            <?php
            foreach (array_reverse($listings) as $key => $listing) {
                require "./templates/listing_part.php";
            }
            ?>
        </div>
    </div>
</div>


<?php
require_once "./templates/footer.php";
?>