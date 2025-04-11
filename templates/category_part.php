<div class="col d-flex align-items-start">
    <div class="icon-square text-body-emphasis bg-body-secondary d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3">
        <i class="bi-<?= $category["icon"]?>"></i>
    </div>
    <div>
        <h3 class="fs-2 text-body-emphasis"><?= $category["name"]?></h3>
        <a href="annonces.php?search=&min_price=&max_price=&category=<?= $category["id"]; ?>" class="btn btn-primary">
            Voir la catégorie
        </a>
    </div>
</div>
