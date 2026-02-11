<?php

require __DIR__ . '/inc/all.inc.php';

$id = (int) ($_GET['id'] ?? 0);

$worldCityRepopsitory = new WorldCityRepository($pdo);
$city = $worldCityRepopsitory->fetchById($id);
if(empty($city)){
    header('Location: index.php');
    die();
}

render('city.view', [
    'city' => $city
]);