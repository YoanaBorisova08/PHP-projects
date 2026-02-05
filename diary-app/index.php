<?php 

require __DIR__ . '/inc/functions.inc.php';
require __DIR__ . '/inc/db-connect.inc.php';

date_default_timezone_set('Europe/Sofia');

$perPage = 2;
$page = (int) ($_GET['page'] ?? 1);
if($page<0) $page=0;
$offset = ($page-1)*$perPage;

$stmtCount = $pdo->prepare('SELECT COUNT(*) AS `count` FROM `entries`');
$stmtCount->execute();
$count = $stmtCount->fetch(PDO::FETCH_ASSOC)['count'];

$numPages = ceil($count/$perPage);

$stmt = $pdo->prepare('SELECT * FROM `entries` ORDER BY `entries`.`date` DESC, `entries`.`title` DESC LIMIT :perPage OFFSET :offset');
$stmt->bindValue(':perPage', (int)$perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int)$offset,  PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll();
?>


<?php require __DIR__ . '/views/header.view.php';?>
  <h1 class="main-heading">Entries</h1>
    <?php foreach($results as $result): ?>
      <div class="card">
         <?php if(!empty($result['image'])):?>
        <div class="card__image__container">
          <img
            class="card__image"
            src="uploads/<?php echo e($result['image']);?>"
            />
        </div>
        <?php endif;?>
        <div class="card__desc__container">
          <?php
          $dateExploded = explode('-', $result['date']);
          $timestamp = mktime(12, 0, 0, $dateExploded[1], $dateExploded[2], $dateExploded[0]);
          
          ?>
          <div class="card__desc-time"><?php echo e(date('d/m/Y', $timestamp))  ?></div>
            <h2 class="card__heading"><?php echo e($result['title'])  ?></h2>
            <p class="card__paragraph">
              <?php echo nl2br(e($result['message'])) ?>
            </p>
        </div>
      </div>
    <?php endforeach;?>

    <?php if ($numPages>1): ?>
    <ul class="pagination">
      <?php if($page>1): ?>
      <li class="pagination__li">
        <a href="index.php?<?php echo http_build_query(['page' => $page-1]); ?>" class="pagination__link">⏴</a>
      </li>
      <?php endif; ?>
      <?php for($x=1; $x<=$numPages; $x++): ?>
        <li class="pagination__li">
          <a href="index.php?<?php echo http_build_query(['page' => $x]); ?>" class="pagination__link <?php if ($page===$x): ?>pagination__link--active<?php endif; ?>">
            <?php echo e($x); ?>
          </a>
        </li>
      <?php endfor; ?>
      <?php if($page<$numPages): ?>
        <li class="pagination__li">
          <a href="index.php?<?php echo http_build_query(['page' => $page+1]); ?>" class="pagination__link">⏵</a>
        </li>
      <?php endif; ?>
    </ul>
    <?php endif; ?>

<?php require __DIR__ . '/views/footer.view.php';?>