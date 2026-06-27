<?php

declare(strict_types=1);

namespace App\Relating\MessageHandler;

use App\Relating\Message\RecalculateRelationshipHealthMessage;
use App\Relating\Service\RelationshipHealthScorerInterface;
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
