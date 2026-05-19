<?php

$config = require basePath('config/db.php');
$db = new Database($config);

$id = $_GET['id'] ?? null;

if (!$id || !ctype_digit((string)$id)) {
    loadView('error/404');
    return;
}

$sth = $db->conn->prepare('SELECT * FROM listings WHERE id = :id LIMIT 1');
$sth->execute(['id' => $id]);
$listing = $sth->fetch();

if (!$listing) {
    loadView('error/404');
    return;
}

loadView('listings/show', [
    'listing' => $listing
]);

?>