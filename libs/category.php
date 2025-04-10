<?php

// Renvoie un tableau contenant toutes les catégories
function getCategories(PDO $pdo): array {
    $sql = "SELECT id, name, icon
            FROM category";

    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchall(PDO::FETCH_ASSOC);
}

// Renvoie l'id à partir du nom d'une catégorie
function getCategoriesIdByName(PDO $pdo, string $name): int {
    $sql = "SELECT id
            FROM category
            WHERE name = :name";

    $query = $pdo->prepare($sql);
    $query->execute(["name" => $name]);
    $id = $query->fetchColumn();
    return $id;
}