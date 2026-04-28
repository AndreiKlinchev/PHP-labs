<?php
declare(strict_types=1);

/**
 * Validates form data for the strange facts catalog.
 */
class FormValidator implements IValidator
{
    /**
     * Validates the submitted form data.
     *
     * @param array<string, mixed> $data Submitted form data.
     *
     * @return array<int, string>
     */
    public function validate(array $data): array
    {
        $errors = [];

        $title = trim((string) ($data['title'] ?? ''));
        $category = trim((string) ($data['category'] ?? ''));
        $factDate = trim((string) ($data['fact_date'] ?? ''));
        $author = trim((string) ($data['author'] ?? ''));
        $source = trim((string) ($data['source'] ?? ''));
        $description = trim((string) ($data['description'] ?? ''));
        $rating = (string) ($data['rating'] ?? '');

        $allowedCategories = ['biology', 'space', 'history', 'human'];

        if (!$this->isValidTitle($title)) {
            $errors[] = 'Название факта должно содержать минимум 3 символа.';
        }

        if (!$this->isValidCategory($category, $allowedCategories)) {
            $errors[] = 'Нужно выбрать категорию.';
        }

        if (!$this->isValidFactDate($factDate)) {
            $errors[] = 'Дата факта заполнена неверно.';
        }

        if (!$this->isValidAuthor($author)) {
            $errors[] = 'Имя автора должно содержать минимум 2 символа.';
        }

        if (!$this->isValidSource($source)) {
            $errors[] = 'Источник должен содержать минимум 3 символа.';
        }

        if (!$this->isValidDescription($description)) {
            $errors[] = 'Описание должно содержать минимум 10 символов.';
        }

        if (!$this->isValidRating($rating)) {
            $errors[] = 'Оценка странности должна быть числом от 1 до 10.';
        }

        return $errors;
    }

    public function isValidDate(string $date): bool
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d', $date);

        return $dateTime !== false && $dateTime->format('Y-m-d') === $date;
    }

    public function isValidTitle(string $title): bool
    {
        return $title !== '' && $this->stringLength($title) >= 3;
    }

    public function isValidCategory(string $category, array $allowedCategories): bool
    {
        return in_array($category, $allowedCategories, true);
    }

    public function isValidFactDate(string $factDate): bool
    {
        return $this->isValidDate($factDate);
    }

    public function isValidAuthor(string $author): bool
    {
        return $author !== '' && $this->stringLength($author) >= 2;
    }

    public function isValidSource(string $source): bool
    {
        return $source !== '' && $this->stringLength($source) >= 3;
    }

    public function isValidDescription(string $description): bool
    {
        return $description !== '' && $this->stringLength($description) >= 10;
    }

    public function isValidRating(string $rating): bool
    {
        return filter_var($rating, FILTER_VALIDATE_INT) !== false
            && (int) $rating >= 1
            && (int) $rating <= 10;
    }

    /**
     * Returns string length with fallback when mbstring is unavailable.
     *
     * @param string $value Input string.
     *
     * @return int
     */
    private function stringLength(string $value): int
    {
        if (function_exists('mb_strlen')) {
            return mb_strlen($value);
        }

        return strlen($value);
    }
}
