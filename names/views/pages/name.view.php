<?php if(!empty($nameInfo)):?>
    <h1>Statistics for the name <?php echo e($name);?></h1>
    <table>
        <thead>
            <tr>
                <th scope="="col">Year</th>
                <th scope="="col">Number of Babies born</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($nameInfo as $nameYear): ?>
                <tr>
                    <td><?php echo e($nameYear['year']); ?></td>
                    <td><?php echo e($nameYear['count']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <h1>No information about the name <?php echo e($name); ?>!</h1>
<?php endif; ?>
