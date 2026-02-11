<?php
try{
$pdo = new PDO('mysql:host=localhost;dbname=cities;charset=utf8mb4',
 'cities', '4*2x4zYS[EZgq5E)', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
}
catch (PDOException $e){
    echo "A problem occured with the database connection...";
    die();
}