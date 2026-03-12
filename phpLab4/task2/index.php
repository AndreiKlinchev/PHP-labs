<?php
// Задаем путь к папке с изображениями
$dir = './image/';

$files = scandir($dir);

if ($files === false) { return; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turka Site</title>

    <style>
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
    header, footer { background: #333; color: #fff; padding: 15px; text-align: center; }
    nav { background: #555; padding: 10px; text-align: center; }
    nav a { color: #fff; margin: 0 15px; text-decoration: none; font-weight: bold; }
    
    .content { padding: 20px; }
    
    /* Сетка для галереи */
    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
    }
    .gallery img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border: 2px solid #ccc;
        border-radius: 5px;
    }
</style>

</head>
<body>
    <div class="content">
        <h1>Турецкая галерея</h1>
        <br />
        <div class="gallery">
            <?php foreach ($files as $im) :?>
                <?php if (($im != ".") && ($im != "..")): ?>
                <?php $path = $dir . $im; ?>         
                <img src="<?= $path ?>" alt="turca">
                <?php endif?>

            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>