<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Message\RelationScoreLeadMessage;
use App\Relating\Service\RelationLeadScorerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationScoreLeadMessageHandler
{
    public function __construct(private RelationLeadScorerInterface $scorer)
    {
    }

    public function __invoke(RelationScoreLeadMessage $message): void
    {
        $this->scorer->scoreLeadReference(
            $message->targetReference,
            RelationBusinessMessagePayload::array($message->payload, 'context'),
        );
    }
}
