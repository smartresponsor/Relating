<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use App\Relating\ValueObject\RelationRelatingActionResult;

final class RelationBusinessResultPayload
{
    /**
     * @return array<string, mixed>
     */
    public static function from(RelationRelatingActionResult $result): array
    {
        return [
            'component' => 'Relating',
            'business_action' => $result->businessAction,
            'subject_reference' => $result->subjectReference,
            'payload' => $result->payload,
        ];
    }
}
