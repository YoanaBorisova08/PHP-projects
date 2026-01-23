<?php
include './inc/functions.inc.php';
include './inc/images.inc.php';

?>
<?php include './views/header.php'; ?>

<div class="gallery-container">
<?php foreach($imageTitles as $src => $title):?>
    <a href="image.php?<?php echo http_build_query(['image' => $src])?>" class="gallery-item">
        <h3><?php echo e($title) ?></h3>
        <img src="./images/<?php echo rawurldecode($src) ?>" alt="<?php echo $title ?>"\>
    </a>
<?php endforeach ?>
</div>


<?php include './views/footer.php'; ?>
