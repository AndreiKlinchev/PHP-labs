<?php
declare(strict_types=1);

/**
 * Connects validation and saving of facts.
 */
class FactManager
{
    /**
     * @var FormValidator
     */
    private FormValidator $validator;

    /**
     * @var FactRepository
     */
    private FactRepository $repository;

    /**
     * @param FormValidator  $validator  Validator object.
     * @param FactRepository $repository Repository object.
     */
    public function __construct(FormValidator $validator, FactRepository $repository)
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    /**
     * Validates and saves a fact.
     *
     * @param array<string, mixed> $data Submitted data.
     *
     * @return array<string, mixed>
     */
    public function save(array $data): array
    {
        $errors = $this->validator->validate($data);

        if ($errors !== []) {
            return [
                'success' => false,
                'errors' => $errors,
            ];
        }

        $fact = [
            'title' => trim((string) $data['title']),
            'category' => trim((string) $data['category']),
            'fact_date' => trim((string) $data['fact_date']),
            'author' => trim((string) $data['author']),
            'source' => trim((string) $data['source']),
            'description' => trim((string) $data['description']),
            'rating' => (int) $data['rating'],
            'is_true' => isset($data['is_true']) ? 1 : 0,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->repository->save($fact);

        return [
            'success' => true,
            'errors' => [],
        ];
    }
}
