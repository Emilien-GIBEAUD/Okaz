<div class="col-md-4 my-2 d-flex">
        <div class="card w-100">
            <?php if ($listing["image"] !== ""): ?>
                <img src="./uploads/listing/<?= $listing["image"]?>" class="card-img-top h-100" alt="<?= $listing["title"]?>">
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title"><?= $listing["title"]?></h5>
                <p class="card-text"><?= $listing["price"]?> €</p>
            <a href="annonce.php?id=<?= $listing["id"] ?>" class="btn btn-primary w-100 stretched-link">Voir l'annonce</a>
        </div>
    </div>
</div>
