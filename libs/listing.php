<?php

function getListings(PDO $pdo): array {
    $sql = "SELECT id, title, description, price, image
            FROM listing";

    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchall(PDO::FETCH_ASSOC);
}

function getListingById(PDO $pdo, int $id): array|bool {
    $sql = "SELECT id, title, description, price, image
            FROM listing
            WHERE id = :id";

    $query = $pdo->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}