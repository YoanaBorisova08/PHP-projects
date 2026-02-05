<?php

require __DIR__ . '/inc/all.inc.php';
$char = (string) ($_GET['char'] ?? '');
if(strlen($char)>1){
    $char = $char[0];
}
$char = strtoupper($char);
$alphabet = gen_alphabet();

if(strlen($char)===0 || !in_array($char, $alphabet)){
    header("Location: index.php");
    die();
}


$perPage = 15;

$page = (int) ($_GET['page'] ?? 1);
$count = count_names_by_inital($char);

$names = fetch_names_by_initial($char, $page);

render('char.view', [
    'char' => $char,
    'names' => $names,
    'pagination' => [
        'page' => $page,
        'count' =>$count,
        'perPage' => $perPage
    ]
]);