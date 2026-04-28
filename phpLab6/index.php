<?php
declare(strict_types=1);

$old = [
    'title' => '',
    'category' => '',
    'fact_date' => '',
    'author' => '',
    'source' => '',
    'description' => '',
    'rating' => '5',
    'is_true' => '',
];

$errors = [];

session_start();

if (isset($_SESSION['old']) && is_array($_SESSION['old'])) {
    $old = array_merge($old, $_SESSION['old']);
}

if (isset($_SESSION['errors']) && is_array($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
}

$successMessage = $_SESSION['success'] ?? '';

unset($_SESSION['old'], $_SESSION['errors'], $_SESSION['success']);

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
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лабораторная 6 - Каталог странных фактов</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Каталог странных фактов</h1>
    <p class="subtitle">Добавление нового факта через HTML-форму и обработку на PHP.</p>

    <div class="actions">
        <a href="list.php">Посмотреть все факты</a>
    </div>

    <?php if ($successMessage !== ''): ?>
        <div class="message success"><?= e($successMessage) ?></div>
    <?php endif; ?>

    <?php if ($errors !== []): ?>
        <div class="message error">
            <strong>Есть ошибки:</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="save.php" method="POST" class="fact-form">
        <label>
            Название факта
            <input type="text" name="title"
                minlength="3"
                maxlength="100"
                required
                value="<?= e((string) $old['title']) ?>"
            >
        </label>

        <label>
            Категория
            <select name="category" required>
                <option value="">Выберите категорию</option>
                <option value="animals" <?= $old['category'] === 'biology' ? 'selected' : '' ?>>Биология</option>
                <option value="space" <?= $old['category'] === 'space' ? 'selected' : '' ?>>Космос</option>
                <option value="history" <?= $old['category'] === 'history' ? 'selected' : '' ?>>История</option>
                <option value="human" <?= $old['category'] === 'human' ? 'selected' : '' ?>>Человек</option>
            </select>
        </label>

        <label>
            Дата факта
            <input
                type="date"
                name="fact_date"
                required
                value="<?= e((string) $old['fact_date']) ?>"
            >
        </label>

        <label>
            Автор / кто добавил
            <input
                type="text"
                name="author"
                minlength="2"
                maxlength="60"
                required
                value="<?= e((string) $old['author']) ?>"
            >
        </label>

        <label>
            Источник
            <input
                type="text"
                name="source"
                minlength="3"
                maxlength="120"
                required
                value="<?= e((string) $old['source']) ?>"
            >
        </label>

        <label>
            Описание факта
            <textarea
                name="description"
                rows="6"
                minlength="10"
                maxlength="500"
                required
            ><?= e((string) $old['description']) ?></textarea>
        </label>

        <label>
            Оценка странности (от 1 до 10)
            <input
                type="number"
                name="rating"
                min="1"
                max="10"
                required
                value="<?= e((string) $old['rating']) ?>"
            >
        </label>

        <label class="checkbox-label">
            <input
                type="checkbox"
                name="is_true"
                value="1"
                <?= $old['is_true'] === '1' ? 'checked' : '' ?>
            >
            Я подтверждаю, что факт похож на правдивый
        </label>

        <button type="submit">Сохранить факт</button>
    </form>
</div>
</body>
</html>
