<h1>Most common names:</h1>
<ol>
    <?php foreach($overview as $info): ?>
        <li>
            <a href="name.php?<?php echo http_build_query(['name' => $info['name']]);?>">
                <?php echo e($info['name']); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ol>