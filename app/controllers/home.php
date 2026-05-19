<?php

$config = require basePath('config/db.php');
$db = new Database($config);

// Fetch latest 3 listings from the database for display on the home page
$listings = $db->query("SELECT * FROM listings ORDER BY id DESC LIMIT 3")->fetchAll();

// Demo purpose only -> Adds dummy data for testing
if (count($listings) === 0) {
    require basePath('seed.php');
}

loadView("home", [
    "listings" => $listings
]);

?>