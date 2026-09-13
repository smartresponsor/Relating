<?php

declare(strict_types=1);

namespace App\Controller;

use App\ValueObject\RelatingActionResult;

final class BusinessResultPayload
{
    /**
     * @return array<string, mixed>
     */
    public static function from(RelatingActionResult $result): array
    {
        return [
            'component' => 'Relating',
            'business_action' => $result->businessAction,
            'subject_reference' => $result->subjectReference,
            'payload' => $result->payload,
        ];
    }
}
