<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/simple.css" />
    <link rel="stylesheet" href="./styles/custom.css" />
    <title>Culinary Cove <?php if(!empty($pageTitle)):?>&bull; <?php echo $pageTitle?><?php endif?></title>
</head>
<body>
  <?php 
  if (empty($headerImg)){
    $headerImg = 'images/pexels-engin-akyurt-1435904.jpg';
  } ?>
  <header class="header-with-background" style="background-image: url(<?php echo $headerImg; ?>); ">
    <h1>Culinary Cove</h1>
    <p>Your sanctuary for exceptional flavors</p>
    <nav>
      <?php 
      if (empty($pageKey)){
        $pageKey='';
      } ?>
      <a 
      <?php if($pageKey === 'ourmission'):?>
        class="active"
        <?php endif; ?>
        href="our-mission.php">Our mission</a>
      <a 
      <?php if($pageKey === 'ingredients'):?>
        class="active"
        <?php endif; ?>
        href="ingredients.php">Ingredients</a>
      <a 
      <?php if($pageKey === 'menu'):?>
        class="active"
        <?php endif; ?>
        href="menu.php">Menu</a>
    </nav>
  </header>

  <main>
