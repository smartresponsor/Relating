<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;

final readonly class BusinessRequestPayload
{
    /**
     * @param array<string, mixed> $data
     */
    private function __construct(private array $data)
    {
    }

    public static function from(Request $request): self
    {
        $content = trim($request->getContent());

        if ($content === '') {
            return new self([]);
        }

        $decoded = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        if (!is_array($decoded)) {
            throw new \InvalidArgumentException('Business request payload must be a JSON object.');
        }

        return new self($decoded);
    }

    public function requiredString(string $key): string
    {
        $value = $this->optionalString($key);

        if ($value === null) {
            throw new \InvalidArgumentException(sprintf('Missing required business field: %s.', $key));
        }

        return $value;
    }

    public function optionalString(string $key): ?string
    {
        if (!array_key_exists($key, $this->data) || $this->data[$key] === null) {
            return null;
        }

        $value = is_scalar($this->data[$key]) ? trim((string) $this->data[$key]) : '';

        return $value === '' ? null : $value;
    }

    public function requiredInt(string $key): int
    {
        $value = $this->optionalInt($key);

        if ($value === null) {
            throw new \InvalidArgumentException(sprintf('Missing required business field: %s.', $key));
        }

        return $value;
    }

    public function optionalInt(string $key): ?int
    {
        if (!array_key_exists($key, $this->data) || $this->data[$key] === null || $this->data[$key] === '') {
            return null;
        }

        if (!is_numeric($this->data[$key])) {
            throw new \InvalidArgumentException(sprintf('Business field must be numeric: %s.', $key));
        }

        return (int) $this->data[$key];
    }

    /**
     * @return array<string, mixed>
     */
    public function array(string $key): array
    {
        $value = $this->data[$key] ?? [];

        if ($value === null) {
            return [];
        }

        if (!is_array($value)) {
            throw new \InvalidArgumentException(sprintf('Business field must be an object/array: %s.', $key));
        }

        return $value;
    }

    public function optionalDateTime(string $key): ?DateTimeImmutable
    {
        $value = $this->optionalString($key);

        return $value === null ? null : new DateTimeImmutable($value);
    }
}
