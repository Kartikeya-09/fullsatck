<?php
require_once __DIR__ . '/../models/ListingModel.php';

function indexListings() {
    $allListings = ListingModel::findAll();
    include __DIR__ . '/../views/listings/index.php';
}

function renderNewListingForm() {
    include __DIR__ . '/../views/listings/new.php';
}

function addNewListing() {
    $data = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'image' => $_POST['image'],
        'price' => $_POST['price'],
        'category' => $_POST['category']
    ];
    ListingModel::create($data);
    header("Location: /listings");
}

function renderEditListingForm() {
    $id = $_GET['id'];
    $listing = ListingModel::findById($id);
    include __DIR__ . '/../views/listings/edit.php';
}

function editListing() {
    $id = $_POST['id'];
    $data = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'image' => $_POST['image'],
        'price' => $_POST['price'],
        'category' => $_POST['category']
    ];
    ListingModel::update($id, $data);
    header("Location: /listings");
}

function deleteListing() {
    $id = $_POST['id'];
    ListingModel::delete($id);
    header("Location: /listings");
}

function showIndividualListing() {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        http_response_code(400);
        echo "Bad Request: Missing listing ID.";
        return;
    }

    $listing = ListingModel::findById($id);
    if (!$listing) {
        http_response_code(404);
        echo "Listing not found.";
        return;
    }

    include __DIR__ . '/../views/listings/show.php';
}
