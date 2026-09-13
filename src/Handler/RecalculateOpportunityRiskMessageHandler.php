<?php

declare(strict_types=1);

namespace App\Handler;

use App\Message\RecalculateOpportunityRiskMessage;
use App\Service\OpportunityRiskScorerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RecalculateOpportunityRiskMessageHandler
{
    public function __construct(private OpportunityRiskScorerInterface $scorer)
    {
    }

    public function __invoke(RecalculateOpportunityRiskMessage $message): void
    {
        $this->scorer->scoreOpportunityRisk(
            $message->targetReference,
            BusinessMessagePayload::array($message->payload, 'context'),
        );
    }
}
