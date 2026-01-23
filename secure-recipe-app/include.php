<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./simple.css" />
    <title>Document</title>
</head>
<body>
<?php
function e($value) {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$pages = [
        'citrus_salmon' => 'Citrus Symphony Salmon',
        'mediterranian_pasta' => 'Mediterranean Marvel Pasta',
        'sunset_risotto' => 'Sunset Risotto',
        'tropical_tacos' => 'Tropical Tango Tacos',
    ];
?>

<form method="GET" action="include.php">
    <select name="page">
        <option value="">Please select a recipe</option>
            <?php foreach($pages as $p => $p_name): ?>
                <option value=<?php echo e($p) ?>
                <?php if(!empty($_GET['page']) && $_GET['page'] == $p) echo 'selected';?>
                ><?php echo e($p_name)?></option>
            <?php endforeach ?>
    </select>
    <input type="submit" value="Submit" />
</form>

<?php
    if(!empty($_GET['page'])){
        $page = $_GET['page'];
        if(!empty($pages[$page]))
            echo file_get_contents("pages/{$_GET['page']}.html");
    }
?>

</body>
</html>
