<?php

$config = require basePath('config/db.php');
$db = new Database($config);

$keywords = trim($_GET['keywords'] ?? '');
$location = trim($_GET['location'] ?? '');

$where = [];
$params = [];

if ($keywords !== '') {
	$where[] = '(title LIKE :kw OR description LIKE :kw OR tags LIKE :kw)';
	$params['kw'] = "%{$keywords}%";
}

if ($location !== '') {
	$where[] = '(city LIKE :loc OR state LIKE :loc OR address LIKE :loc)';
	$params['loc'] = "%{$location}%";
}

$sql = 'SELECT * FROM listings' . (count($where) ? ' WHERE ' . implode(' AND ', $where) : '') . ' ORDER BY id DESC';
$sth = $db->conn->prepare($sql);
$sth->execute($params);
$listings = $sth->fetchAll();

loadView("listings/index", [
	'listings' => $listings,
	'keywords' => $keywords,
	'location' => $location,
]);

?>