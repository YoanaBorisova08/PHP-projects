<?php

use App\Weather\RemoteWeatherFetcher;

require __DIR__ . '/inc/all.inc.php';

if(!empty($_GET['city'])){
  $city = (string) ($_GET['city'] ?? "");
  $fetcher = new RemoteWeatherFetcher($city);
  $info = $fetcher->fetch($city);
  if(empty($info)){
    echo "Weather could not be fetched.";
    die();
  }
  require __DIR__ . "/views/index.view.php";
}

