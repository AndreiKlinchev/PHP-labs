<?php
declare(strict_types=1);

interface IValidator
{
    /**
     * @param array<string, mixed> $data
     *
     * @return array<int, string>
     */
    public function validate(array $data): array;

    public function isValidDate(string $date): bool;

    public function isValidTitle(string $title): bool;

    /**
     * @param array<int, string> $allowedCategories
     */
    public function isValidCategory(string $category, array $allowedCategories): bool;

    public function isValidFactDate(string $factDate): bool;

    public function isValidAuthor(string $author): bool;

    public function isValidSource(string $source): bool;

    public function isValidDescription(string $description): bool;

    public function isValidRating(string $rating): bool;
}
