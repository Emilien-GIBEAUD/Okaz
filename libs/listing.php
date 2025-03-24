<?php

function getListings(): array {
    return [
        ["title" => "test1", "price" => 30, "image" => "rocket-league.jpg", "description" => "super jeux de PS4"],
        ["title" => "test2", "price" => 40, "image" => "rocket-league.jpg", "description" => "test description 2"],
        ["title" => "test3", "price" => 35, "image" => "rocket-league.jpg", "description" => "test description 3"],
        ["title" => "test4", "price" => 15, "image" => "rocket-league.jpg", "description" => "test description 4"],
    ];
}

function getListingById(int $id): array {
    $listings = getListings();
    return $listings[$id];
}