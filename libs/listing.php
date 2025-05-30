<?php

function getListings(PDO $pdo, array $filters = [], int|null $nbAnnounces=null): array {
    $relevance = "";
    $conditions = [];
    $orderBy = "listing.id DESC";
    if(isset($filters["search"])){
        $match = "MATCH(title) AGAINST (:search)";
        $conditions[] = $match;
        $relevance = ", $match AS relevance";
        $orderBy = "relevance DESC";
    }
    if(isset($filters["min_price"])){
        $conditions[] = "price >= :min_price";
    }
    if(isset($filters["max_price"])){
        $conditions[] = "price <= :max_price";
    }
    if(isset($filters["category"]) && $filters["category"]){
        $conditions[] = "category_id = :category";
    }

    $nbAnnouncesMax="";
    if ($nbAnnounces) {
        $nbAnnouncesMax = " LIMIT $nbAnnounces";
    }

    $where = $conditions ? " WHERE " . implode(" AND ", $conditions) : "";
    // condition ternaire, équivalent de :
    // if (!empty($conditions)) {
    //     $where = "WHERE " . implode(" AND ", $conditions);
    // } else {
    //     $where = "";
    // }

    $sql = "SELECT id, title, description, price, image
            $relevance 
            FROM listing
            $where 
            ORDER BY $orderBy
            $nbAnnouncesMax";

    $query = $pdo->prepare($sql);
    if (isset($filters["search"])) {
        $query->bindValue(":search", "%{$filters["search"]}%");
    }
    if (isset($filters["min_price"])) {
        $query->bindValue(":min_price", $filters["min_price"], PDO::PARAM_INT);
    }
    if (isset($filters["max_price"])) {
        $query->bindValue(":max_price", $filters["max_price"], PDO::PARAM_INT);
    }
    if (isset($filters["category"]) && $filters["category"]) {
        $query->bindValue(":category", $filters["category"], PDO::PARAM_INT);
    }
    $query->execute();
    return $query->fetchall(PDO::FETCH_ASSOC);
}

function getListingById(PDO $pdo, int $id): array|bool {
    $sql = "SELECT id, title, description, price, image, user_id, created_at
            FROM listing
            WHERE id = :id";

    $query = $pdo->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}