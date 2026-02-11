<h1>Admin: Manage pages</h1>
<table style="min-width: 100%;">
    <thead>
        <th>ID</th>
        <th>Title</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach($entries as $entry):?>
        <tr>
            <td><?php echo e($entry->id);?></td>
            <td><?php echo e($entry->title);?></td>
            <td>
                <a href="index.php?<?php echo http_build_query(['route' => 'admin/pages/edit', 'id' => $entry->id]); ?>">Edit</a>
                <form method="POST" action="index.php?<?php echo http_build_query(['route' => 'admin/pages/delete']) ?>">
                    <input type="hidden" name=id value="<?php echo e($entry->id); ?>"/>
                    <input type="submit" value="Delete!" class="btn-link"/>
                </form>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<a href="index.php?route=admin/pages/create">Create page</a>