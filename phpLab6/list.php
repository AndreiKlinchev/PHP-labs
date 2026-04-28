<?php
declare(strict_types=1);

require_once __DIR__ . '/src/FactRepository.php';

$repository = new FactRepository(__DIR__ . '/data/facts.json');
$facts = $repository->getAll();

$sort = $_GET['sort'] ?? 'created_at';
$allowedSorts = ['title', 'category', 'fact_date', 'author', 'rating', 'created_at'];

if (!in_array($sort, $allowedSorts, true)) {
    $sort = 'created_at';
}

usort($facts, static function (array $first, array $second) use ($sort): int {
    return strcmp((string) $first[$sort], (string) $second[$sort]);
});

/**
 * Safely escapes output for HTML.
 *
 * @param string $value Text for escaping.
 *
 * @return string
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/**
 * Returns a readable category name.
 *
 * @param string $category Category code.
 *
 * @return string
 */
function categoryLabel(string $category): string
{
    $labels = [
        'animals' => 'Животные',
        'space' => 'Космос',
        'history' => 'История',
        'human' => 'Человек',
    ];

    return $labels[$category] ?? 'Неизвестно';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список фактов</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container wide">
    <h1>Сохранённые факты</h1>
    
    <div class="actions">
        <a href="index.php">Добавить новый факт</a>
    </div>

    <div class="sort-links">
        <a href="list.php?sort=created_at">Сортировать по дате добавления</a>
        <a href="list.php?sort=title">По названию</a>
        <a href="list.php?sort=category">По категории</a>
        <a href="list.php?sort=fact_date">По дате факта</a>
        <a href="list.php?sort=rating">По оценке</a>
    </div>

    <?php if ($facts === []): ?>
        <div class="message">Пока что записей нет.</div>
    <?php else: ?>
        <table>
            <thead>
            <tr>
                <th>Название</th>
                <th>Категория</th>
                <th>Дата факта</th>
                <th>Автор</th>
                <th>Источник</th>
                <th>Описание</th>
                <th>Оценка</th>
                <th>Правдивый</th>
                <th>Добавлен</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($facts as $fact): ?>
                <tr>
                    <td><?= e((string) $fact['title']) ?></td>
                    <td><?= e(categoryLabel((string) $fact['category'])) ?></td>
                    <td><?= e((string) $fact['fact_date']) ?></td>
                    <td><?= e((string) $fact['author']) ?></td>
                    <td><?= e((string) $fact['source']) ?></td>
                    <td><?= e((string) $fact['description']) ?></td>
                    <td><?= e((string) $fact['rating']) ?></td>
                    <td><?= !empty($fact['is_true']) ? 'Да' : 'Нет' ?></td>
                    <td><?= e((string) $fact['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
