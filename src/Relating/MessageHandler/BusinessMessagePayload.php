<?php

declare(strict_types=1);

namespace App\Relating\MessageHandler;

final class BusinessMessagePayload
{
    /**
     * @param array<string, mixed> $payload
     */
    public static function string(array $payload, string $key, ?string $default = null): string
    {
        $value = $payload[$key] ?? $default;

        if (!is_string($value) || trim($value) === '') {
            throw new \InvalidArgumentException(sprintf('Message payload key "%s" must be a non-empty string.', $key));
        }

        return $value;
    }

    /**
     * @param array<string, mixed> $payload
     */
    public static function nullableString(array $payload, string $key): ?string
    {
        $value = $payload[$key] ?? null;

        if ($value === null || $value === '') {
            return null;
        }

        if (!is_string($value)) {
            throw new \InvalidArgumentException(sprintf('Message payload key "%s" must be a string or null.', $key));
        }

        return $value;
    }

    /**
     * @param array<string, mixed> $payload
     */
    public static function integer(array $payload, string $key, int $default = 0): int
    {
        $value = $payload[$key] ?? $default;

        if (!is_int($value)) {
            throw new \InvalidArgumentException(sprintf('Message payload key "%s" must be an integer.', $key));
        }

        return $value;
    }

    /**
     * @param array<string, mixed> $payload
     * @return array<string, mixed>
     */
    public static function array(array $payload, string $key, array $default = []): array
    {
        $value = $payload[$key] ?? $default;

        if (!is_array($value)) {
            throw new \InvalidArgumentException(sprintf('Message payload key "%s" must be an array.', $key));
        }

        return $value;
    }
}
