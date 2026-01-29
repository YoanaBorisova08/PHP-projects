<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./styles/simple.css" />
    <title>Document</title>
</head>
<body>
    <header><h1>Automatic Image List</h1></header>
    <main><pre><?php 

        function e($value){
            return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
        $handle = opendir(__DIR__ . '/images');
        $images = [];
        $allowedPhotoExtensions = [
            'jpg',
            'jpeg',
            'png'
        ];
        $allowedTextExtensions = [
            'txt'
        ];
        while (($currentFile = readdir($handle)) !== false) {
            if ($currentFile === '.' || $currentFile === '..') {
                continue;
            }
            $fileInfo = pathinfo($currentFile);
            $photoName = $fileInfo['filename'];
            $extension = $fileInfo['extension'];

            if(!isset($images[$photoName])){
                $images[$photoName] = [
                    "extension" => "",
                    "title" => "",
                    "content" => ""
                ];
            }

            if (in_array($extension, $allowedPhotoExtensions)) {
                $images[$photoName]["extension"] = $extension;
            }
            else if (in_array($extension, $allowedTextExtensions)) {
                $content = file_get_contents(__DIR__ . '/images/' . $fileInfo['basename']);
                [$title, $content] = explode("\n", $content, 2);
                $images[$photoName]["title"]  = $title;
                $images[$photoName]["content"]  = explode("\n", $content);

            }
        }
        closedir($handle);
    ?></pre>

        <?php foreach($images AS $image => $imgInfo): ?>
            <figure>
            <img src="images/<?php echo rawurlencode("{$image}.{$imgInfo['extension']}"); ?>" alt="<?php echo $image;?>" />
            <?php if(!empty($imgInfo['title'])):?>
                <figcaption>
                <h2><?php echo e($imgInfo['title']); ?></h2>
                <?php foreach($imgInfo['content'] as $p): ?>
                    <p><?php echo e($p); ?></p>
                <?php endforeach; ?>
                </figcaption>
            <?php endif; ?>
            </figure>
        <?php endforeach; ?>

    </main>
</body>
</html>