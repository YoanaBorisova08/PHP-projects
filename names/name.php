<?php
require __DIR__ . '/inc/all.inc.php';

if(!empty($_GET['name'])){
    $name = ucfirst(strtolower($_GET['name']));
    $nameInfo = fetch_info_by_name($name);
}else{
    header("Location: index.php");
    die();
}

render('name.view', [
    'name' => $name,
    'char' => $name[0],
    'nameInfo' => $nameInfo
]);