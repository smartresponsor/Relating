<?php

declare(strict_types=1);

namespace App\View;

abstract readonly class AbstractArrayView implements RelatingViewInterface, RelatingViewSchemaInterface
{
    /**
     * @param array<string, mixed> $data
     */
    public function __construct(private array $data)
    {
        $this->assertPayloadHasNoEntityLeakage($data);
    }

    public function surface(): string
    {
        return static::surfaceName();
    }

    /**
     * @return array<string, mixed>
     */
    public function payload(): array
    {
        return $this->data;
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->payload();
    }

    /**
     * @return list<string>
     */
    public static function expectedKeys(): array
    {
        return [];
    }

    protected static function surfaceName(): string
    {
        return 'relating.view';
    }

    /**
     * @param array<string, mixed> $payload
     */
    private function assertPayloadHasNoEntityLeakage(array $payload): void
    {
        foreach ($payload as $value) {
            if (is_array($value)) {
                $this->assertPayloadHasNoEntityLeakage($value);
                continue;
            }

            if (is_object($value)) {
                throw new \InvalidArgumentException('Relating view payload must not expose Doctrine entities or arbitrary objects.');
            }
        }
    }
}
