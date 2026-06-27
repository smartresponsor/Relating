<?php

declare(strict_types=1);

namespace App\Debug;

final readonly class DebugRelatingObjectStore
{
    public function __construct(
        private string $filePath,
    ) {
    }

    public function remember(string $bucket, string $id, object $object): void
    {
        $data = $this->read();
        $data[$bucket] ??= [];
        $data[$bucket][$id] = base64_encode(serialize($object));
        $this->write($data);
    }

    public function one(string $bucket, string $id): ?object
    {
        $data = $this->read();

        if (!isset($data[$bucket][$id]) || !is_string($data[$bucket][$id])) {
            return null;
        }

        $object = unserialize(base64_decode($data[$bucket][$id], true) ?: '', ['allowed_classes' => true]);

        return is_object($object) ? $object : null;
    }

    public function all(string $bucket): array
    {
        $data = $this->read();
        $objects = [];

        foreach (($data[$bucket] ?? []) as $serialized) {
            if (!is_string($serialized)) {
                continue;
            }

            $object = unserialize(base64_decode($serialized, true) ?: '', ['allowed_classes' => true]);

            if (is_object($object)) {
                $objects[] = $object;
            }
        }

        return $objects;
    }

    private function read(): array
    {
        if (!is_file($this->filePath)) {
            return [];
        }

        $content = file_get_contents($this->filePath);
        $decoded = json_decode(is_string($content) ? $content : '', true);

        return is_array($decoded) ? $decoded : [];
    }

    private function write(array $data): void
    {
        $directory = dirname($this->filePath);

        if (!is_dir($directory)) {
            mkdir($directory, 0775, true);
        }

        $encoded = json_encode($data, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
        $handle = fopen($this->filePath, 'wb');
        fwrite($handle, $encoded);
        fclose($handle);
    }
}
