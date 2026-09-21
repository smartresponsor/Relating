<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Message\RelationRecalculateOpportunityRiskMessage;
use App\Relating\Service\RelationOpportunityRiskScorerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationRecalculateOpportunityRiskMessageHandler
{
    public function __construct(private RelationOpportunityRiskScorerInterface $scorer)
    {
    }

    public function __invoke(RelationRecalculateOpportunityRiskMessage $message): void
    {
        $this->scorer->scoreOpportunityRisk(
            $message->targetReference,
            RelationBusinessMessagePayload::array($message->payload, 'context'),
        );
    }
}
