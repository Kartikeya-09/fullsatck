<?php
require_once __DIR__ . '/../models/ListingModel.php';

function showCategoryListings() {
    $category = urldecode(basename($_SERVER['REQUEST_URI'])); // Extract category from the URL
    $allListings = ListingModel::findAllByCategory($category);
    include __DIR__ . '/../views/listings/index.php';
}
