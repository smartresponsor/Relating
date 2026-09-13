<?php

declare(strict_types=1);

namespace App\Handler;

use App\Message\ScoreLeadMessage;
use App\Service\LeadScorerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class ScoreLeadMessageHandler
{
    public function __construct(private LeadScorerInterface $scorer)
    {
    }

    public function __invoke(ScoreLeadMessage $message): void
    {
        $this->scorer->scoreLeadReference(
            $message->targetReference,
            BusinessMessagePayload::array($message->payload, 'context'),
        );
    }
}
