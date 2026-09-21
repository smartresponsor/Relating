<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Message\RelationRecalculateRelationshipHealthMessage;
use App\Relating\Service\RelationshipHealthScorerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationRecalculateRelationshipHealthMessageHandler
{
    public function __construct(private RelationshipHealthScorerInterface $scorer)
    {
    }

    public function __invoke(RelationRecalculateRelationshipHealthMessage $message): void
    {
        $this->scorer->scoreRelationshipHealth($message->targetReference);
    }
}
