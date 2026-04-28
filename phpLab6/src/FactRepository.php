<?php
declare(strict_types=1);

/**
 * Works with file storage for facts.
 */
class FactRepository
{
    /**
     * @var string
     */
    private string $filePath;

    /**
     * @param string $filePath Path to JSON file.
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Returns all saved facts.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getAll(): array
    {
        if (!file_exists($this->filePath)) {
            return [];
        }

        $content = file_get_contents($this->filePath);
        if ($content === false || trim($content) === '') {
            return [];
        }

        $data = json_decode($content, true);

        return is_array($data) ? $data : [];
    }

    /**
     * Saves one fact into the JSON file.
     *
     * @param array<string, mixed> $fact One fact.
     *
     * @return void
     */
    public function save(array $fact): void
    {
        $facts = $this->getAll();
        $facts[] = $fact;

        $directory = dirname($this->filePath);
        if (!is_dir($directory)) 
        {
            mkdir($directory, 0777, true);
        }

        file_put_contents($this->filePath, json_encode($facts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
