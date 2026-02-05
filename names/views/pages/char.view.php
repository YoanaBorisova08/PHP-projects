<ul>
<?php foreach($names as $name): ?>
    <li>
        <a href="name.php?<?php echo http_build_query(['name' => $name]); ?>">
        <?php echo e($name); ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>

<?php for($x=1; $x<($pagination['count']/$pagination['perPage'] + 1); $x++):?>
    <a class="button" href="char.php?<?php echo http_build_query(['char' => $char, 'page' => $x]) ?>">
        <?php if ($x === $pagination['page']): ?>   
            <strong><?php echo e($x);?></strong>
        <?php else:?>
            <?php echo e($x);?>
        <?php endif;?>
    </a>
<?php endfor; ?>
