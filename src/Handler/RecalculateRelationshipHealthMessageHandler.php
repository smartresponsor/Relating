<?php

declare(strict_types=1);

namespace App\Handler;

use App\Message\RecalculateRelationshipHealthMessage;
use App\Service\RelationshipHealthScorerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RecalculateRelationshipHealthMessageHandler
{
    public function __construct(private RelationshipHealthScorerInterface $scorer)
    {
    }

    public function __invoke(RecalculateRelationshipHealthMessage $message): void
    {
        $this->scorer->scoreRelationshipHealth($message->targetReference);
    }
}
