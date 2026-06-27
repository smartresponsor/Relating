<?php

declare(strict_types=1);

namespace App\Exception;

final class RelatingApplicationException extends \RuntimeException
{
    public static function missingReference(string $label, string $reference): self
    {
        return new self($label . ' was not found for reference: ' . $reference);
    }
}
