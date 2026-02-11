<h1>List of cities:</h1>

<ul>
    <?php foreach($entries as $entry): ?>
        <li>
            <a href="city.php?<?php echo http_build_query(['id' => $entry->id]); ?>">
            <?php  echo e($entry->getCityWithCountry());  ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<?php if ( $pagination['page'] > 1): ?>
    <a href="index.php?<?php echo http_build_query(['page' => $pagination['page'] - 1]) ?>">Prev</a>
<?php endif; ?>
<?php if ($pagination['perPage'] * $pagination['page'] < $pagination['count']): ?>
    <a href="index.php?<?php echo http_build_query(['page' => $pagination['page'] + 1]) ?>">Next</a>
<?php endif; ?>